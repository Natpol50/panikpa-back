<?php


namespace App\Config;

/**
 * ConfigObject - Provides access to configuration variables
 * 
 * This class is used to provide access to the configuration variables
 * It should only be instantiated by the ConfigManager class
 */

class ConfigObject
{
    private $accessibleVariables;
    
    /**
     * Constructor
     * 
     * @param array $accessibleVariables Variables this instance can access
     */
    public function __construct(array $accessibleVariables)
    {
        $this->accessibleVariables = $accessibleVariables;
    }
    
    /**
     * Get a configuration value
     * 
     * @param string $key Configuration key
     * @param mixed $default Default value if key doesn't exist
     * @return mixed Configuration value or default
     */
    public function get(string $key, $default = null)
    {
        return $this->accessibleVariables[$key] ?? $default;
    }
    
    /**
     * Check if a configuration key exists
     * 
     * @param string $key Configuration key
     * @return bool True if the key exists
     */
    public function has(string $key): bool
    {
        return isset($this->accessibleVariables[$key]);
    }
    
    /**
     * Get all accessible configuration as an array
     * 
     * @return array All accessible configuration
     */
    public function all(): array
    {
        return $this->accessibleVariables;
    }
}