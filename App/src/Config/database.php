<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/configManager.php';

/**
 * Database - Singleton database connection class using ConfigManager
 * 
 * Provides secure access to a PDO database connection using
 * environment variables loaded via ConfigManager
 */
class Database
{
    // The shared instance
    private static $instance = null;
    
    // The PDO object
    private $pdo;
    
    /**
     * Private constructor - loads database configuration via ConfigManager
     */
    public function __construct() 
    {
        // Get configuration using reflection-based security
        $configManager = \App\Config\ConfigManager::getInstance();
        $config = $configManager->getConfigFor($this);
        
        // Get database connection parameters from environment variables
        $host = $config->get('DB_HOST');
        $port = $config->get('DB_PORT');
        $dbname = $config->get('DB_NAME');
        $user = $config->get('DB_USER');
        $password = $config->get('DB_PASSWD');
        
        // Create the PDO object
        try {
            $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
            ];
            $this->pdo = new PDO($dsn, $user, $password, $options);
        } catch (PDOException $e) {
            die("Connection error: " . $e->getMessage());
        }
    }
    

    private function __clone() {} // Prevent cloning of the instance
    
    public function __wakeup() { // Prevent unserializing of the instance
        throw new \Exception("Cannot unserialize singleton");
    }
    
    /**
     * Returns a single database connection
     * If it doesn't exist, creates it, otherwise returns the existing one
     * 
     * @return PDO The database connection
     */
    public static function getInstance() 
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->getPdo();
    }
    
    /**
     * Get the PDO connection
     * 
     * @return PDO The database connection
     */
    public function getPdo()
    {
        return $this->pdo;
    }
}