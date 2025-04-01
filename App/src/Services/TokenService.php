<?php

namespace App\Services;

use App\Config\ConfigInterface;
use App\Models\UserModel;
use App\Exceptions\AuthenticationException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * TokenService - JWT authentication token management
 * 
 * Manages JWT authentication tokens and refresh tokens for user sessions.
 * Handles creation, validation, and refreshing of tokens.
 */
class TokenService
{
    private string $secretKey;
    private string $tokenName;
    private int $tokenLifetime;
    private int $refreshThreshold;
    private int $refreshTokenLifetime;
    private UserModel $userModel;
    
    /**
     * Initialize the TokenService with configuration
     * 
     * @param ConfigInterface|null $config Configuration with JWT settings
     */
    public function __construct(?ConfigInterface $config = null)
    {
        // If no config provided, this is likely just for type hinting
        if ($config === null) {
            return;
        }
        
        // Load JWT configuration
        $this->secretKey = $config->get('JWT_SECRET');
        $this->tokenName = $config->get('JWT_NAME');
        
        // Token expiration time (default: 4 hours)
        $this->tokenLifetime = $config->get('JWT_EXPIRY', 14400); // 4 hours in seconds
        
        // When to refresh token (default: 30 minutes before expiry)
        $this->refreshThreshold = $config->get('JWT_REFRESH_THRESHOLD', 1800); // 30 minutes in seconds
        
        // Refresh token expiration (default: 30 days)
        $this->refreshTokenLifetime = $config->get('JWT_REFRESH_EXPIRY', 2592000); // 30 days in seconds
        
        // Initialize user model for token validation
        $this->userModel = new UserModel();
    }
    
    /**
     * Get the token name used for cookies
     * 
     * @return string The token name
     */
    public function getTokenName(): string
    {
        return $this->tokenName;
    }
    
    /**
     * Creates and stores a JWT token as a secure cookie
     * 
     * @param int $userId The user ID to create a token for
     * @return string The generated JWT token
     * @throws AuthenticationException If token creation fails
     */
    public function createJWT(int $userId): string
    {
        // Get user's IP address
        $ip = $_SERVER['REMOTE_ADDR'];
        
        // Fetch user data for the payload
        $userData = $this->userModel->getUserById($userId);
        
        if (!$userData) {
            throw new AuthenticationException('User not found');
        }
        
        // Set token timing parameters
        $issuedAt = time();
        $expirationTime = $issuedAt + $this->tokenLifetime;
        
        // Build JWT payload
        $payload = [
            'iat' => $issuedAt,          // Issued At timestamp
            'exp' => $expirationTime,    // Expiration timestamp
            'user_id' => $userId,        // User identifier
            'ip' => $ip,                 // Client IP for verification
            'photo_url' => $userData->profilePictureUrl,  // Profile photo URL
            'acctype' => $userData->userRole,             // Account type/role
        ];
         
        try {
            // Generate the JWT token
            $jwt = JWT::encode($payload, $this->secretKey, 'HS256');
            
            // Store as HTTP-only secure cookie
            setcookie($this->tokenName, $jwt, [
                "expires" => $expirationTime,  // Cookie expiration
                "path" => "/",                 // Available site-wide
                "secure" => true,              // HTTPS only
                "httponly" => true,            // Not accessible via JavaScript
                "samesite" => "Strict"         // CSRF protection
            ]);
            
            return $jwt;
        } catch (\Exception $e) {
            throw new AuthenticationException('JWT creation failed: ' . $e->getMessage());
        }
    }
    
    /**
     * Creates a refresh token and stores it in the user's database record
     * 
     * @param int $userId The user ID to create a refresh token for
     * @return string The generated refresh token
     * @throws AuthenticationException If token creation/storage fails
     */
    public function createRefreshToken(int $userId): string
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        
        // Generate random part of the token (32 bytes = 64 hex characters)
        $randomPart = bin2hex(random_bytes(32));
        
        // Append contextual information (IP and user ID)
        $content = $ip . "," . $userId;
        $refreshToken = $randomPart . $content;
        
        // Set current date for token creation timestamp
        $refreshTokenDate = date("Y-m-d", time());
        
        // Fetch user object
        $userData = $this->userModel->getUserById($userId);
        
        if (!$userData) {
            throw new AuthenticationException('User not found');
        }
        
        // Update user's refresh token
        $userData->refreshToken = $refreshToken;
        $userData->refreshTokenDate = $refreshTokenDate;
        
        try {
            $this->userModel->updateUser($userData);
            return $refreshToken;
        } catch (\Exception $e) {
            throw new AuthenticationException("Failed to store refresh token: " . $e->getMessage());
        }
    }
    
    /**
     * Decodes and validates a JWT token
     * 
     * @param string $token The JWT token to decode
     * @return object The decoded token payload
     * @throws AuthenticationException If token is invalid
     */
    public function decodeJWT(string $token): object
    {
        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
            return $decoded;
        } catch (\Exception $e) {
            throw new AuthenticationException('Invalid token: ' . $e->getMessage());
        }
    }
    
    /**
     * Validates a JWT token and refreshes it if needed
     * 
     * @param string $token The JWT token to check
     * @return bool True if token is valid, false otherwise
     */
    public function validateAndRefreshToken(string $token): bool
    {
        try {
            // Decode the JWT token
            $decoded = $this->decodeJWT($token);
            
            // Extract important token data
            $userId = $decoded->user_id;
            $expireDate = $decoded->exp;
            
            // Verify IP address matches
            if ($_SERVER['REMOTE_ADDR'] !== $decoded->ip) {
                return false; // IP mismatch, token invalid
            }
            
            // Get user data to check refresh token
            $userData = $this->userModel->getUserById($userId);
            
            if (!$userData) {
                return false; // User not found
            }
            
            // If JWT is near expiration, check if we can refresh it
            if (($expireDate - $this->refreshThreshold) <= time()) {
                // Extract refresh token and its creation date
                $refreshToken = $userData->refreshToken;
                $refreshTokenDate = $userData->refreshTokenDate;
                
                if (!$refreshToken || !$refreshTokenDate) {
                    return false; // No refresh token available
                }
                
                // Verify IP in refresh token
                $refreshTokenParts = $this->parseRefreshToken($refreshToken);
                if (!$refreshTokenParts || $refreshTokenParts['ip'] !== $_SERVER['REMOTE_ADDR']) {
                    return false; // IP in refresh token doesn't match
                }
                
                // Check if refresh token has expired
                if (strtotime($refreshTokenDate) + $this->refreshTokenLifetime <= time()) {
                    return false; // Refresh token expired, new login required
                }
                
                // Generate new JWT if refresh token is still valid
                $this->createJWT($userId);
            }
            
            return true;
        } catch (\Exception $e) {
            // Log the exception but return false for security
            error_log("Token validation failed: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Parses a refresh token to extract its components
     * 
     * @param string $refreshToken The refresh token to parse
     * @return array|false Array with token parts or false if invalid format
     */
    private function parseRefreshToken(string $refreshToken)
    {
        if (strlen($refreshToken) <= 64) {
            return false; // Token too short to be valid
        }
        
        $randomPart = substr($refreshToken, 0, 64);
        $content = substr($refreshToken, 64);
        
        $contentParts = explode(',', $content);
        if (count($contentParts) !== 2) {
            return false; // Invalid content format
        }
        
        return [
            'random' => $randomPart,
            'ip' => $contentParts[0],
            'userId' => $contentParts[1]
        ];
    }
    
    /**
     * Invalidate the current session by clearing cookies
     * 
     * @return bool True on success
     */
    public function logout(): bool
    {
        if (isset($_COOKIE[$this->tokenName])) {
            // Clear the cookie by setting expiration in the past
            setcookie($this->tokenName, '', [
                'expires' => time() - 3600,
                'path' => '/',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'Strict'
            ]);
            
            return true;
        }
        
        return false;
    }
}