<?php

class CacheService extends CacheConfig
{
    private array $cache = []; // What to save or read
    private CacheModel $cacheModel;

    // Cache expiration constant for clarity
    private const INFINITE_TTL = 0;

    public function __construct()
    {
        $this->cacheModel = new CacheModel();
        $this->loadCache(); // Recover what is stocked inside the file
    }

    // Set of function to create a cache and exploit it

    // Get the data from the file containing the cache's data
    private function loadCache(): void
    {
        if (file_exists($this->cacheFile)) {
            $data = file_get_contents($this->cacheFile);
            $this->cache = json_decode($data, true) ?? [];
        }
    }

    // Save the data of the cache in a file
    private function saveCache(): void
    {
        file_put_contents($this->cacheFile, json_encode($this->cache, JSON_PRETTY_PRINT));
    }

    // Add a value to the cache with optional expiration (ttl = 0 means infinite TTL)
    public function set(string $key, mixed $value, int $ttl = self::INFINITE_TTL): void
    {
        $this->cache[$key] = [
            "value" => $value,
            "expires_at" => ($ttl > 0) ? time() + $ttl : null
        ];
        $this->saveCache();
    }

    // Retrieve a value from the cache
    public function get(string $key): mixed
    {
        if (!isset($this->cache[$key])) {
            return null;
        }

        // Check if the cache has expired
        if ($this->isExpired($key)) {
            $this->delete($key);
            return null;
        }

        return $this->cache[$key]["value"];
    }

    // Delete an entry from the cache
    public function delete(string $key): void
    {
        unset($this->cache[$key]);
        $this->saveCache();
    }

    // Check if a key exists and is valid (not expired)
    public function has(string $key): bool
    {
        return isset($this->cache[$key]) && !$this->isExpired($key);
    }

    // Clear the cache and the file
    public function clear(): void
    {
        $this->cache = [];
        $this->saveCache();
    }

    // Helper method to check expiration
    private function isExpired(string $key): bool
    {
        return $this->cache[$key]["expires_at"] !== null && $this->cache[$key]["expires_at"] < time();
    }

    // Check if a role has permission (used by AuthMiddleware)
    public function checkRolePermission(string $role_id, string $permissionToCheck): bool
    {
        $rolePermissions = $this->cacheModel->getRolePermission($role_id);

        return $rolePermissions && isset($rolePermissions[$permissionToCheck]) && $rolePermissions[$permissionToCheck] === 1;
    }

    public function getRolePermission($role_id){
        return $this->cacheModel->getRolePermission($role_id);
    }

}