<?php

namespace App\Exceptions;

/**
 * DatabaseException - Specific exception for database errors
 *
 * This exception should be thrown when database operations fail,
 * such as connection issues, query errors, or data integrity problems.
 */
class DatabaseException extends ApplicationException
{
    /**
     * The SQL query that caused the exception (if applicable)
     *
     * @var string|null
     */
    protected ?string $query = null;
   
    /**
     * Create a new database exception instance
     *
     * @param string $message Exception message
     * @param string|null $query The SQL query that caused the exception (if applicable)
     * @param int $code Exception code
     * @param \Throwable|null $previous Previous exception
     */
    public function __construct(
        string $message = "Database error occurred",
        ?string $query = null,
        int $code = 0,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->query = $query;
    }
   
    /**
     * Get the SQL query that caused the exception (if applicable)
     *
     * @return string|null The SQL query or null if not available
     */
    public function getQuery(): ?string
    {
        return $this->query;
    }
   
    /**
     * Get a sanitized version of the query for logging (removes sensitive data)
     *
     * @return string|null The sanitized query or null if not available
     */
    public function getSanitizedQuery(): ?string
    {
        if ($this->query === null) {
            return null;
        }
       
        // Basic sanitization to remove potential password data
        // This is a simple approach - you might want to improve it
        $sanitized = preg_replace(
            '/password\s*=\s*[\'"][^\'"]*[\'"]|passwd\s*=\s*[\'"][^\'"]*[\'"]|pwd\s*=\s*[\'"][^\'"]*[\'"]/',
            '******',
            $this->query
        );
       
        return $sanitized;
    }
}