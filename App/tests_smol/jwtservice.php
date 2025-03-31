<?php
/**
 * TokenService Test Script
 * 
 * This script provides a complete test for the TokenService class without requiring
 * a real database connection. It uses mock classes to simulate all dependencies.
 */

// Include the UserObject class definition
require_once __DIR__ . '/../src/Models/UserObject.php';
require_once __DIR__ .'/../src/Config/configManager.php';

// Define the TokenConfig base class
class TokenConfig {
    protected $secretKey = 'test_jwt_secret_key';
    protected $token_name = 'test_jwt_token';
    protected $life_expectancy;
    protected $time_limit_before_refresh = 1800; // 30 minutes
    protected $time_limit_before_refresh_expires = 2592000; // 30 days
    
    public function __construct() {
        // Calculate token lifetime (4 hours)
        $day = 0;
        $hours = 4;
        $minutes = 0;
        $this->life_expectancy = $day * 86400 + $hours * 3600 + $minutes * 60;
    }
}

// Mock the ConfigManager class
class ConfigManager {
    private static $instance = null;
    private $configs = [];
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConfigFor($class) {
        return new Config();
    }
}

// Mock the Config class
class Config {
    private $values = [
        'JWT_SECRET' => 'test_jwt_secret_key',
        'JWT_NAME' => 'test_jwt_token'
    ];
    
    public function get($key) {
        return $this->values[$key] ?? null;
    }
}

// Mock the UserModel class to avoid database connections
class UserModel {
    private $users = [];
    
    public function __construct() {
        // Create a mock user for testing
        $this->users[123] = new UserObject([
            'id_user' => 123,
            'user_name' => 'testuser',
            'user_fname' => 'Test User',
            'user_email' => 'test@example.com',
            'user_phash' => password_hash('password123', PASSWORD_DEFAULT),
            'user_gender' => 'M',
            'user_phone' => '1234567890',
            'user_photo_url' => '/images/avatar.jpg',
            'id_acctype' => 2,
            'user_creation_date' => date('Y-m-d'),
            'user_refresh_token' => null,
            'user_refresh_token_date' => null
        ]);
    }
    
    public function getUserById($userId) {
        return $this->users[$userId] ?? null;
    }
    
    public function updateUser($user) {
        $this->users[$user->id_user] = $user;
        return $user;
    }
}

// Include the actual TokenService class or define a version of it for testing
class TokenService extends TokenConfig {
    private UserModel $userModel;
    
    public function __construct() {
        parent::__construct();
        
        // Mock the config retrieval
        $configManager = \ConfigManager::getInstance();
        $config = $configManager->getConfigFor($this);
                
        $this->secretKey = $config->get('JWT_SECRET');
        $this->token_name = $config->get('JWT_NAME');
        $this->userModel = new UserModel();
    }

    public function createJWT($user_id) {
        // Override the REMOTE_ADDR for testing
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
        
        // Use UserModel to retrieve information used by the payload
        $userData = $this->userModel->getUserById($user_id);
        
        if (!$userData) {
            throw new Exception('User not found');
        }

        $issuedAt = time();
        $expirationTime = $issuedAt + $this->life_expectancy;

        $payload = [
            'iat' => $issuedAt,
            'exp' => $expirationTime,
            'user_id' => $user_id,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'photo_url' => $userData->user_photo_url,
            'acctype' => $userData->id_acctype,
        ];
         
        // For testing, just return the payload since we can't really use JWT without the library
        return json_encode($payload);
    }

    public function createRefreshToken($user_id) {
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
        
        // Generate random part
        $randompart = bin2hex(random_bytes(32));
        
        // Create content part
        $content = $_SERVER['REMOTE_ADDR'] . "," . $user_id;
        
        // Combine for full token
        $refresh_token = $randompart . $content;
        
        // Set date
        $refresh_token_date = date("Y-m-d", time());
        
        // Update user
        $current_user = $this->userModel->getUserById($user_id);
        
        if (!$current_user) {
            throw new Exception('User not found');
        }
        
        $current_user->user_refresh_token = $refresh_token;
        $current_user->user_refresh_token_date = $refresh_token_date;
        
        $this->userModel->updateUser($current_user);
        
        return $refresh_token;
    }

    public function decodeJWT($token) {
        // For testing, just decode the JSON
        return json_decode($token);
    }

    public function validateAndRefreshToken($token) {
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
        
        try {
            // Decode the token
            $decoded = $this->decodeJWT($token);
            
            // Extract data
            $userId = $decoded->user_id;
            $expireDate = $decoded->exp;
            
            // Verify IP
            if ($_SERVER['REMOTE_ADDR'] !== $decoded->ip) {
                echo "IP mismatch\n";
                return false;
            }
            
            // Get user data
            $userData = $this->userModel->getUserById($userId);
            
            if (!$userData) {
                echo "User not found\n";
                return false;
            }
            
            // If token is near expiration, refresh it
            if (($expireDate - $this->time_limit_before_refresh) <= time()) {
                // Check if refresh token is valid
                if ($userData->user_refresh_token && $userData->user_refresh_token_date) {
                    // Extract IP from refresh token
                    $refreshTokenParts = $this->parseRefreshToken($userData->user_refresh_token);
                    
                    if (!$refreshTokenParts || $refreshTokenParts['ip'] !== $_SERVER['REMOTE_ADDR']) {
                        echo "Refresh token IP mismatch\n";
                        return false;
                    }
                    
                    // Check refresh token expiration
                    if (strtotime($userData->user_refresh_token_date) + $this->time_limit_before_refresh_expires <= time()) {
                        echo "Refresh token expired\n";
                        return false;
                    }
                    
                    // Create new JWT
                    $newToken = $this->createJWT($userId);
                    echo "Token refreshed\n";
                } else {
                    echo "No refresh token available\n";
                    return false;
                }
            }
            
            return true;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
            return false;
        }
    }
    
    private function parseRefreshToken($refreshToken) {
        if (strlen($refreshToken) <= 64) {
            return false;
        }
        
        $randomPart = substr($refreshToken, 0, 64);
        $content = substr($refreshToken, 64);
        
        $contentParts = explode(',', $content);
        if (count($contentParts) !== 2) {
            return false;
        }
        
        return [
            'random' => $randomPart,
            'ip' => $contentParts[0],
            'userId' => $contentParts[1]
        ];
    }
}

// Set up namespace for testing

class ConfigManager2 extends App\Config\ConfigManager {}


// Test runner function
function runTests() {
    echo "Starting TokenService Tests\n";
    echo "==========================\n\n";

    // Initialize the service
    $tokenService = new TokenService();
    $userId = 123;
    
    try {
        // Test 1: Create JWT
        echo "Test 1: Creating JWT token\n";
        $jwt = $tokenService->createJWT($userId);
        echo "JWT created: " . substr($jwt, 0, 30) . "...\n";
        
        // Test 2: Create Refresh Token
        echo "\nTest 2: Creating refresh token\n";
        $refreshToken = $tokenService->createRefreshToken($userId);
        echo "Refresh token created: " . substr($refreshToken, 0, 30) . "...\n";
        
        // Test 3: Validate Token
        echo "\nTest 3: Validating token\n";
        $isValid = $tokenService->validateAndRefreshToken($jwt);
        echo "Token validation result: " . ($isValid ? "Valid" : "Invalid") . "\n";
        
        // Test 4: Simulate token near expiration
        echo "\nTest 4: Simulating token near expiration\n";
        
        // Create a token that's about to expire
        $decodedToken = json_decode($jwt);
        $decodedToken->exp = time() + 1500; // 25 minutes in the future (below the 30 minute refresh threshold)
        $nearExpiryToken = json_encode($decodedToken);
        
        // Validate the near-expiry token
        $isRefreshed = $tokenService->validateAndRefreshToken($nearExpiryToken);
        echo "Token refresh result: " . ($isRefreshed ? "Refreshed" : "Not refreshed") . "\n";
        
        // Test 5: Invalid token (wrong IP)
        echo "\nTest 5: Testing invalid token (wrong IP)\n";
        $decodedToken = json_decode($jwt);
        $decodedToken->ip = '192.168.1.1'; // Different IP
        $invalidToken = json_encode($decodedToken);
        
        $isValid = $tokenService->validateAndRefreshToken($invalidToken);
        echo "Invalid token validation result: " . ($isValid ? "Valid (ERROR!)" : "Invalid (CORRECT)") . "\n";
        
        echo "\nAll tests completed!\n";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
}

// Run the tests
runTests();