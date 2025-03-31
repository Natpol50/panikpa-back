<?php

require_once __DIR__ . '/../Config/tokenConfig.php';
require_once __DIR__ .'/../Models/UserModel.php';
require_once __DIR__ .'/../Config/configManager.php';

/**
 * TokenService Class
 * 
 * Manages JWT authentication tokens and refresh tokens for user sessions.
 * Handles creation, validation, and refreshing of tokens.
 */
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TokenService extends TokenConfig
{
    /** @var UserModel $userModel User model for database interactions */
    private UserModel $userModel;

    /**
     * Initializes the TokenService with configuration settings
     */
    public function __construct()
    {
        // Get configuration using reflection-based security
        $configManager = \App\Config\ConfigManager::getInstance();
        $config = $configManager->getConfigFor($this);
        
        // Load JWT configuration from environment
        $this->secretKey = $config->get('JWT_SECRET');
        $this->token_name = $config->get('JWT_NAME');
        $this->life_expectancy = $this->day * 86400 + $this->hours * 3600 + $this->minutes * 60;
        $this->time_limit_before_refresh = $this->token_expiration_closeness_day * 86400 + $this->token_expiration_closeness_hours * 3600 + $this->token_expiration_closeness_minutes * 60;
        $this->time_limit_before_refresh_expires = $this->refresh_day * 86400;
        $this->userModel = new UserModel();
    }

    /**
     * Creates and stores a JWT token as a secure cookie
     * 
     * @param int $user_id The user ID to create a token for
     * @return string The generated JWT token
     * @throws Exception If token creation fails
     */
    public function createJWT($user_id)
    {
        // Get user's IP address
        $ip = $_SERVER['REMOTE_ADDR'];

        // Fetch user data for the payload
        $userData = $this->userModel->getUserById($user_id);
        
        if (!$userData) {
            throw new Exception('User not found');
        }

        // Set token timing parameters
        $issuedAt = time();
        $expirationTime = $issuedAt + $this->life_expectancy;

        // Build JWT payload
        $payload = [
            'iat' => $issuedAt,          // Issued At timestamp
            'exp' => $expirationTime,    // Expiration timestamp
            'user_id' => $user_id,       // User identifier
            'ip' => $ip,                 // Client IP for verification
            'photo_url' => $userData->user_photo_url,  // Profile photo URL
            'acctype' => $userData->id_acctype,        // Account type/role
        ];
         
        try {
            // Generate the JWT token
            $jwt = JWT::encode($payload, $this->secretKey, 'HS256');

            // Store as HTTP-only secure cookie
            setcookie($this->token_name, $jwt, [
                "expires" => $expirationTime,  // Cookie expiration
                "path" => "/",                 // Available site-wide
                "secure" => true,              // HTTPS only
                "httponly" => true,            // Not accessible via JavaScript
                "samesite" => "Strict"         // CSRF protection
            ]);
            
            return $jwt;
        } catch (Exception $e) {
            throw new Exception('JWT creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Creates a refresh token and stores it in the user's database record
     * 
     * @param int $user_id The user ID to create a refresh token for
     * @return string The generated refresh token
     * @throws Exception If token storage fails
     */
    public function createRefreshToken($user_id)
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        
        // Generate random part of the token (32 bytes = 64 hex characters)
        $randomPart = bin2hex(random_bytes(32));
        
        // Append contextual information (IP and user ID)
        $content = $ip . "," . $user_id;
        $refreshToken = $randomPart . $content;
        
        // Set current date for token creation timestamp
        $refreshTokenDate = date("Y-m-d", time());
        
        // Fetch and update user object
        $currentUser = $this->userModel->getUserById($user_id);
        
        if (!$currentUser) {
            throw new Exception('User not found');
        }
        
        $currentUser->user_refresh_token = $refreshToken;
        $currentUser->user_refresh_token_date = $refreshTokenDate;

        try {
            $this->userModel->updateUser($currentUser);
            return $refreshToken;
        } catch (PDOException $e) {
            throw new Exception("Failed to store refresh token: " . $e->getMessage());
        }
    }

    /**
     * Decodes and validates a JWT token
     * 
     * @param string $token The JWT token to decode
     * @return object The decoded token payload
     * @throws Exception If token is invalid
     */
    public function decodeJWT($token)
    {
        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
            return $decoded;
        } catch (Exception $e) {
            throw new Exception('Invalid token: ' . $e->getMessage());
        }
    }

    /**
     * Validates a JWT token and refreshes it if needed
     * 
     * @param string $token The JWT token to check
     * @return bool True if token is valid, false otherwise
     * @throws Exception If token validation fails unexpectedly
     */
    public function validateAndRefreshToken($token)
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
            
            // Extract refresh token and its creation date
            $refreshToken = $userData->user_refresh_token;
            $refreshTokenDate = $userData->user_refresh_token_date;
            
            // Verify IP in refresh token
            $refreshTokenParts = $this->parseRefreshToken($refreshToken);
            if (!$refreshTokenParts || $refreshTokenParts['ip'] !== $_SERVER['REMOTE_ADDR']) {
                return false; // IP in refresh token doesn't match
            }
            
            // If JWT is near expiration, check if we can refresh it
            if (($expireDate - $this->time_limit_before_refresh) <= time()) {
                // Check if refresh token has expired
                if (strtotime($refreshTokenDate) + $this->time_limit_before_refresh_expires <= time()) {
                    return false; // Refresh token expired, new login required
                }
                
                // Generate new JWT if refresh token is still valid
                $this->createJWT($userId);
            }
            
            return true;
        } catch (Exception $e) {
            throw new Exception("Token validation failed: " . $e->getMessage());
        }
    }
    
    /**
     * Parses a refresh token to extract its components
     * 
     * @param string $refreshToken The refresh token to parse
     * @return array|false Array with token parts or false if invalid format
     */
    private function parseRefreshToken($refreshToken)
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
}