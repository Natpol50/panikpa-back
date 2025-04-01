<?php

namespace App\Services;

use PDO;
use PDOException;
use App\Config\ConfigManager;
use App\Config\ConfigInterface;
use App\Exceptions\DatabaseException;

/**
 * Database - Database connection and query service
 * 
 * This class manages database connections and provides methods
 * for executing queries and transactions.
 */
class Database
{
    private static ?Database $instance = null;
    private ?PDO $connection = null;
    
    /**
     * Create a new database connection using configuration
     * 
     * @param ConfigInterface|null $config Configuration with database credentials
     */
    public function __construct(?ConfigInterface $config = null)
    {
        if ($config === null) {
            // Try to get config from ConfigManager if no config provided
            try {
                $configManager = ConfigManager::getInstance();
                $config = $configManager->getConfigFor($this);
            } catch (\Exception $e) {
                // If we can't get a config, we'll initialize with null connection
                // The connection will be established on first use if needed
                return;
            }
        }
        
        $this->initConnection($config);
    }
    
    /**
     * Initialize database connection
     * 
     * @param ConfigInterface $config Configuration with database credentials
     * @throws DatabaseException If connection fails
     */
    private function initConnection(ConfigInterface $config): void
    {
        $host = $config->get('DB_HOST');
        $port = $config->get('DB_PORT');
        $dbname = $config->get('DB_NAME');
        $user = $config->get('DB_USER');
        $password = $config->get('DB_PASSWORD');
        
        try {
            $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
            ];
            
            $this->connection = new PDO($dsn, $user, $password, $options);
        } catch (PDOException $e) {
            throw new DatabaseException("Database connection failed: " . $e->getMessage());
        }
    }
    
    /**
     * Get the singleton instance of PDO connection
     * 
     * @param ConfigInterface|null $config Optional configuration
     * @return PDO The singleton PDO connection instance
     * @throws DatabaseException If connection fails
     */
    public static function getInstance(?ConfigInterface $config = null): PDO
    {
        if (self::$instance === null) {
            self::$instance = new self($config);
        }
        
        return self::$instance->getConnection();
    }
    
    /**
     * Get the PDO connection instance
     * 
     * @return PDO The database connection
     * @throws DatabaseException If no connection has been established
     */
    public function getConnection(): PDO
    {
        if ($this->connection === null) {
            throw new DatabaseException("No database connection has been established");
        }
        
        return $this->connection;
    }
    
    /**
     * Execute a query with parameters
     * 
     * @param string $query SQL query with placeholders
     * @param array $params Parameters for the query
     * @return \PDOStatement The executed statement
     * @throws DatabaseException If query execution fails
     */
    public function executeQuery(string $query, array $params = []): \PDOStatement
    {
        try {
            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            throw new DatabaseException("Query execution failed: " . $e->getMessage(), $query);
        }
    }
    
    /**
     * Execute a query and fetch all results
     * 
     * @param string $query SQL query with placeholders
     * @param array $params Parameters for the query
     * @param int $fetchMode PDO fetch mode
     * @return array The query results
     * @throws DatabaseException If query execution fails
     */
    public function fetchAll(string $query, array $params = [], int $fetchMode = PDO::FETCH_ASSOC): array
    {
        try {
            $stmt = $this->executeQuery($query, $params);
            return $stmt->fetchAll($fetchMode);
        } catch (PDOException $e) {
            throw new DatabaseException("Query execution failed: " . $e->getMessage(), $query);
        }
    }
    
    /**
     * Execute a query and fetch a single row
     * 
     * @param string $query SQL query with placeholders
     * @param array $params Parameters for the query
     * @param int $fetchMode PDO fetch mode
     * @return array|false The query result or false if no rows
     * @throws DatabaseException If query execution fails
     */
    public function fetch(string $query, array $params = [], int $fetchMode = PDO::FETCH_ASSOC)
    {
        try {
            $stmt = $this->executeQuery($query, $params);
            return $stmt->fetch($fetchMode);
        } catch (PDOException $e) {
            throw new DatabaseException("Query execution failed: " . $e->getMessage(), $query);
        }
    }
    
    /**
     * Begin a database transaction
     * 
     * @return bool True on success
     * @throws DatabaseException If transaction start fails
     */
    public function beginTransaction(): bool
    {
        try {
            return $this->getConnection()->beginTransaction();
        } catch (PDOException $e) {
            throw new DatabaseException("Failed to start transaction: " . $e->getMessage());
        }
    }
    
    /**
     * Commit a database transaction
     * 
     * @return bool True on success
     * @throws DatabaseException If commit fails
     */
    public function commit(): bool
    {
        try {
            return $this->getConnection()->commit();
        } catch (PDOException $e) {
            throw new DatabaseException("Failed to commit transaction: " . $e->getMessage());
        }
    }
    
    /**
     * Rollback a database transaction
     * 
     * @return bool True on success
     * @throws DatabaseException If rollback fails
     */
    public function rollback(): bool
    {
        try {
            return $this->getConnection()->rollBack();
        } catch (PDOException $e) {
            throw new DatabaseException("Failed to rollback transaction: " . $e->getMessage());
        }
    }
}