<?php

namespace App\Core;

/**
 * RequestObject Class
 * 
 * Minimalist, contains only user information
 * and route parameters. Other request related data can be accessed
 * via standard PHP superglobals.
 * 
 * Made to be created and then passed to provide the necessary context to the controllers
 */
class RequestObject
{

    
    /**
     * User related information
     */
    public $userId = null;
    public $userName = null;
    public $userFirstName = null;
    public $userRole = null;
    public $permissionInteger = 0;      // 0 means no permissions at all, hence the non null value.
    public $profilePictureUrl = null;
    
    /**
     * Constructor
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
        $this->profilePictureUrl = $params['profilePictureUrl'] ?? ($GLOBALS['static_url'] . "/pp/default.webp");
    }
    

    /**
     * Set all user information at once
     * 
     * @param array $userInfo
     * @return self
     */
    public function setUserInfo(array $userInfo): static
    {
        if (isset($userInfo['id'])) $this->userId = $userInfo['id'];
        if (isset($userInfo['username'])) $this->userName = $userInfo['username'];
        if (isset($userInfo['fullname'])) $this->userFirstName = $userInfo['fullname'];
        if (isset($userInfo['role'])) $this->userRole = $userInfo['role'];
        if (isset($userInfo['permission_level'])) $this->permissionInteger = $userInfo['permission_level'];
        if (isset($userInfo['profile_picture'])) $this->profilePictureUrl = $userInfo['profile_picture'];

        return $this;
    }
}