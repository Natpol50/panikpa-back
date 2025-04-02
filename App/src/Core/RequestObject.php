<?php

namespace App\Core;

use App\Services\CacheService;

/**
 * RequestObject - Container for request information
 * 
 * Contains information about the current request, including user data,
 * permissions, and route parameters.
 */
class RequestObject
{
    /**
     * User information
     */
    public ?int $userId = null;
    public ?string $userName = null;
    public ?string $userFirstName = null;
    public ?int $userRole = null;
    public int $permissionInteger = 0;
    public ?string $profilePictureUrl = null;
    public ?string $userSType = null;
    private CacheService $cache;
    
    /**
     * Create a new RequestObject instance
     * 
     * @param array $params Optional parameters to initialize the object
     */
    public function __construct(array $params = [])
    {
        $this->userId = $params['userId'] ?? null;
        $this->userName = $params['userName'] ?? null;
        $this->userFirstName = $params['userFirstName'] ?? null;
        $this->userRole = $params['userRole'] ?? null;
        $this->permissionInteger = $params['permissionInteger'] ?? 0;
        $this->profilePictureUrl = $params['profilePictureUrl'] ?? '/assets/img/default-avatar.png';
        $this->userSType = $params['userSearchType'] ?? null;
        $this->cache = new CacheService();
    }
    
    /**
     * Check if the user is authenticated
     * 
     * @return bool True if user is authenticated
     */
    public function isAuthenticated(): bool
    {
        return $this->userId !== null;
    }
    
    /**
     * Check if the user has a specific permission using CacheService
     * 
     * @param string $permissionKey Permission key to check
     * @return bool True if user has the permission
     */
    public function hasPermission(string $permissionKey): bool
    {
        return $this->cache->checkRolePermission($this->userRole, $permissionKey);
    }
    
    /**
     * Check if user has a specific role
     * 
     * @param int $role Role ID to check
     * @return bool True if user has the role
     */
    public function hasRole(int $role): bool
    {
        return $this->userRole === $role;
    }
    
    /**
     * Get user's display name (firstName if available, or userName)
     * 
     * @return string User's display name
     */
    public function getDisplayName(): string
    {
        return $this->userFirstName ?? $this->userName ?? 'Guest';
    }
}