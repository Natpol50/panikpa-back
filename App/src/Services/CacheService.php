<?php

namespace App\Services;

use App\Models\CacheModel;

/**
 * CacheService - File-based cache system
 * 
 * This service provides a simple file-based caching mechanism for
 * storing and retrieving data, primarily used for permissions.
 */
class CacheService
{
    private array $cache = [];
    private string $cacheFile = '';
    private CacheModel $cacheModel;
    
    // Cache expiration constant for clarity
    private const INFINITE_TTL = 0;
    
    /**
     * Create a new CacheService instance
     * 
     * @param string $cacheFile Optional path to the cache file
     */
    public function __construct(string $cacheFile = '')
    {
        $this->cacheFile = $cacheFile ?: dirname(__DIR__, 2) . '/var/cache/app_cache.json';
        $this->cacheModel = new CacheModel();
        $this->loadCache();
    }
    
    /**
     * Load cache data from file
     */
    private function loadCache(): void
    {
        if (file_exists($this->cacheFile)) {
            $data = file_get_contents($this->cacheFile);
            $this->cache = json_decode($data, true) ?? [];
        } else {
            // Ensure cache directory exists
            $cacheDir = dirname($this->cacheFile);
            if (!is_dir($cacheDir)) {
                mkdir($cacheDir, 0775, true);
            }
        }
    }
    
    /**
     * Save cache data to file
     */
    private function saveCache(): void
    {
        file_put_contents($this->cacheFile, json_encode($this->cache, JSON_PRETTY_PRINT));
    }
    
    /**
     * Store a value in the cache
     * 
     * @param string $key Cache key
     * @param mixed $value Value to cache
     * @param int $ttl Time to live in seconds (0 for infinite)
     */
    public function set(string $key, mixed $value, int $ttl = self::INFINITE_TTL): void
    {
        $this->cache[$key] = [
            "value" => $value,
            "expires_at" => ($ttl > 0) ? time() + $ttl : null
        ];
        
        $this->saveCache();
    }
    
    /**
     * Retrieve a value from the cache
     * 
     * @param string $key Cache key
     * @param mixed $default Default value if key doesn't exist or is expired
     * @return mixed Cached value or default
     */
    public function get(string $key, mixed $default = null): mixed
    {
        if (!isset($this->cache[$key])) {
            return $default;
        }
        
        // Check if the cache has expired
        if ($this->isExpired($key)) {
            $this->delete($key);
            return $default;
        }
        
        return $this->cache[$key]["value"];
    }
    
    /**
     * Delete a key from the cache
     * 
     * @param string $key Cache key
     */
    public function delete(string $key): void
    {
        unset($this->cache[$key]);
        $this->saveCache();
    }
    
    /**
     * Check if a key exists and is valid
     * 
     * @param string $key Cache key
     * @return bool True if key exists and is not expired
     */
    public function has(string $key): bool
    {
        return isset($this->cache[$key]) && !$this->isExpired($key);
    }
    
    /**
     * Clear the entire cache
     */
    public function clear(): void
    {
        $this->cache = [];
        $this->saveCache();
    }
    
    /**
     * Check if a cached item has expired
     * 
     * @param string $key Cache key
     * @return bool True if expired
     */
    private function isExpired(string $key): bool
    {
        return $this->cache[$key]["expires_at"] !== null && 
               $this->cache[$key]["expires_at"] < time();
    }
    
    /**
     * Get role permissions from database or cache
     * 
     * @param int $roleId Role ID
     * @return array Role permissions
     */
    public function getRolePermission(int $roleId): array
    {
        $cacheKey = "role_permissions_$roleId";
        
        // Try to get from cache first
        $permissions = $this->get($cacheKey);
        
        if ($permissions === null) {
            // Not in cache, fetch from database
            $permissions = $this->cacheModel->getRolePermission($roleId);
            
            // Store in cache for 1 hour (3600 seconds)
            if ($permissions) {
                $this->set($cacheKey, $permissions, 3600);
            }
        }
        
        return $permissions ?: [];
    }
    
    /**
     * Check if a role has a specific permission
     * 
     * @param int $roleId Role ID
     * @param string $permissionName Permission name/key
     * @return bool True if role has permission
     */
    public function checkRolePermission(int $roleId, string $permissionName): bool
    {
        $permissions = $this->getRolePermission($roleId);
        
        return isset($permissions[$permissionName]) && 
               $permissions[$permissionName] === 1;
    }
}