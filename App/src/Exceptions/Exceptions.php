<?php

namespace App\Exceptions;

/**
 * Base exception class for the application
 */
class ApplicationException extends \Exception {}

/**
 * Database-related exceptions
 */
class DatabaseException extends ApplicationException {}

/**
 * Authentication exceptions
 */
class AuthenticationException extends ApplicationException {}

/**
 * Authorization exceptions
 */
class AuthorizationException extends ApplicationException {}

/**
 * Not Found exceptions
 */
class NotFoundException extends ApplicationException {}

/**
 * Model-related exceptions
 */
class ModelException extends ApplicationException {}

/**
 * Validation exceptions
 */
class ValidationException extends ApplicationException 
{
    /**
     * Validation errors
     * 
     * @var array
     */
    protected array $errors = [];
    
    /**
     * Create a new validation exception instance
     * 
     * @param string $message Exception message
     * @param array $errors Validation errors
     * @param int $code Exception code
     * @param \Throwable|null $previous Previous exception
     */
    public function __construct(
        string $message = "Validation failed", 
        array $errors = [], 
        int $code = 0, 
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }
    
    /**
     * Get validation errors
     * 
     * @return array Validation errors
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}

/**
 * Configuration exceptions
 */
class ConfigurationException extends ApplicationException {}

/**
 * File system exceptions
 */
class FileSystemException extends ApplicationException {}

/**
 * Template exceptions
 */
class TemplateException extends ApplicationException {}