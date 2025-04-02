<?php

namespace App\Services;

use App\Exceptions\FileSystemException;

/**
 * FileService - Handles file operations
 * 
 * This service provides methods for file operations like uploading,
 * validating, and managing files.
 */
class FileService
{
    /**
     * Validate file upload
     * 
     * @param array $file File data from $_FILES
     * @param array $allowedMimeTypes Allowed MIME types
     * @param int $maxFileSize Maximum file size in bytes
     * @return bool True if valid
     * @throws FileSystemException If validation fails
     */
    public function validateFileUpload(array $file, array $allowedMimeTypes, int $maxFileSize = 5242880): bool
    {
        // Check if file was uploaded
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            switch ($file['error']) {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new FileSystemException('File is too large');
                case UPLOAD_ERR_PARTIAL:
                    throw new FileSystemException('File was only partially uploaded');
                case UPLOAD_ERR_NO_FILE:
                    throw new FileSystemException('No file was uploaded');
                case UPLOAD_ERR_NO_TMP_DIR:
                    throw new FileSystemException('Missing temporary folder');
                case UPLOAD_ERR_CANT_WRITE:
                    throw new FileSystemException('Failed to write file to disk');
                case UPLOAD_ERR_EXTENSION:
                    throw new FileSystemException('A PHP extension stopped the file upload');
                default:
                    throw new FileSystemException('Unknown upload error');
            }
        }
        
        // Check file size
        if ($file['size'] > $maxFileSize) {
            throw new FileSystemException('File is too large (maximum ' . ($maxFileSize / 1024 / 1024) . 'MB)');
        }
        
        // Check file type
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file['tmp_name']);
        
        if (!in_array($mimeType, $allowedMimeTypes)) {
            throw new FileSystemException('Invalid file type. Allowed types: ' . implode(', ', $allowedMimeTypes));
        }
        
        return true;
    }
    
    /**
     * Move uploaded file to destination
     * 
     * @param string $sourceFile Path to source file
     * @param string $destinationFile Path to destination file
     * @param bool $createDirectory Whether to create destination directory if it doesn't exist
     * @return bool True on success
     * @throws FileSystemException If move fails
     */
    public function moveUploadedFile(string $sourceFile, string $destinationFile, bool $createDirectory = true): bool
    {
        // Create directory if it doesn't exist
        if ($createDirectory) {
            $directory = dirname($destinationFile);
            if (!is_dir($directory)) {
                if (!mkdir($directory, 0775, true)) {
                    throw new FileSystemException("Failed to create directory: $directory");
                }
            }
        }
        
        // Move the file
        if (!move_uploaded_file($sourceFile, $destinationFile)) {
            throw new FileSystemException("Failed to move uploaded file to destination");
        }
        
        return true;
    }
    
    /**
     * Generate a unique filename
     * 
     * @param string $originalFilename Original filename
     * @param string $prefix Optional prefix for the filename
     * @return string Unique filename
     */
    public function generateUniqueFilename(string $originalFilename, string $prefix = ''): string
    {
        $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);
        $uniqueId = uniqid($prefix, true);
        
        return $uniqueId . '.' . $extension;
    }
    
    /**
     * Delete a file
     * 
     * @param string $filePath Path to file
     * @return bool True on success
     * @throws FileSystemException If deletion fails
     */
    public function deleteFile(string $filePath): bool
    {
        if (!file_exists($filePath)) {
            return true; // File doesn't exist, consider it deleted
        }
        
        if (!unlink($filePath)) {
            throw new FileSystemException("Failed to delete file: $filePath");
        }
        
        return true;
    }
    
    /**
     * Get absolute path from relative path
     * 
     * @param string $relativePath Relative path from project root
     * @return string Absolute path
     */
    public function getAbsolutePath(string $relativePath): string
    {
        return dirname(__DIR__, 2) . '/' . ltrim($relativePath, '/');
    }
}