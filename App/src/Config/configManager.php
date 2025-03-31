<?php

namespace App\Config;

require_once __DIR__ . '/configObject.php';
require_once __DIR__ . '/../../vendor/autoload.php';

/**
 * ConfigManager - Secure configuration management using Reflection API
 * 
 * This class provides controlled access to environment variables from .env files
 * using PHP's Reflection API to verify the requesting class.
 */
class ConfigManager
{
    private static $instance = null;
    private $allVariables = [];
    private $accessMap = [];
    
    // private $accessLog = [];
    
              
    private function __construct() //Private constructor to prevent direct instantiation
    {
        // Load environment variables using PHP dotenv
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
        
        // Store all variables in our private array
        foreach ($_ENV as $key => $value) {
            $this->allVariables[$key] = $value;
        }
        
        $this->initializeAccessMap();
    }
    
    /**
     * Define which classes can access which variables
     */
    private function initializeAccessMap()
    {
        // Define access permissions - which classes can access which env variables
        $this->accessMap = [
            'Database' => ['DB_HOST', 'DB_USER', 'DB_PASSWD', 'DB_NAME','DB_PORT'],  // Only useful one for now, others are not used and examples.
            'Tokenconfig' => ['JWT_SECRET', 'JWT_NAME']
        ];
    }
    

    

    private function __clone(): void {} // Prevent cloning of the instance by making it private
    

    public function __wakeup(): never // Prevent unserializing of the instance (recreating it from serialized data, AKA string)
    {
        throw new \Exception(message: "Cannot unserialize a singleton");
    }
    
    /**
     * Get the singleton instance
     * 
     * @return ConfigManager The singleton instance
     */
    public static function getInstance(): mixed
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Get configuration access for a specific object using Reflection
     * 
     * @param object $callingObject The object requesting configuration
     * @return ConfigObject A restricted configuration access object
     * @throws \Exception If the calling class is not authorized
     */
    public function getConfigFor(object $callingObject): Configobject
    {
        // Use Reflection to get the actual class of the calling object
        $reflection = new \ReflectionObject($callingObject);
        $className = $reflection->getName();
        
        // Check if this class is allowed in the access map
        if (!isset($this->accessMap[$className])) {
            throw new \Exception("Class '{$className}' is not authorized to access configuration");
        }
        
        // Get the allowed keys for this class
        $allowedKeys = $this->accessMap[$className];
        $accessibleVariables = [];
        
        // Filter the variables based on allowed keys
        foreach ($allowedKeys as $key) {
            if (isset($this->allVariables[$key])) {
                $accessibleVariables[$key] = $this->allVariables[$key];
            }
        }
        
        // Log this access attempt (optional, for auditing) [DISABLED FOR NOW]
        // $this->logAccess(className: $className, keys: $allowedKeys);
        
        // Return a ConfigAccess object with only the allowed variables
        return new ConfigObject(accessibleVariables: $accessibleVariables);
    }

    /**
     * Remove a class from the access map, could be useful as a security measure, could also maybe create a new bug
     * 
     * @param string $className The class name to remove
     * @return bool True if removal was successful
     */
    public function revokeClassAccess(string $className): bool
    {
        if (isset($this->accessMap[$className])) {
            unset($this->accessMap[$className]);
            return true;
        }
        return false;
    }
    
    /*
    Log access attempts for auditing purposes [DISABLED FOR NOW]
    
    @param string $className Class that attempted access
    @param array $keys Keys that were accessed


    private function logAccess(string $className, array $keys): void
    {
        $this->accessLog[] = [
            'timestamp' => date('Y-m-d H:i:s'),
            'class' => $className,
            'keys' => $keys,
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
        ];
        
    }
    */
}

