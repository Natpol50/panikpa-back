<?php

namespace App\Controllers;

use App\Services\Database;
use App\Services\TokenService;
use App\Models\UserModel;
use App\Core\RequestObject;
use App\Exceptions\AuthenticationException;

/**
 * AuthController - Handles authentication actions
 */
class AuthController
{
    private UserModel $userModel;
    private TokenService $tokenService;
    
    /**
     * Create a new AuthController instance
     */
    public function __construct()
    {
        // Initialize dependencies
        $database = new Database();
        
        $this->userModel = new UserModel($database);
        
        // Create config for token service
        $configManager = \App\Config\ConfigManager::getInstance();
        $tokenConfig = $configManager->getConfigFor(new TokenService());
        
        $this->tokenService = new TokenService($tokenConfig);
    }
    
    /**
     * Display login form
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function loginForm(RequestObject $request): void
    {
        // If user is already authenticated, redirect to home
        if ($request->isAuthenticated()) {
            header('Location: /');
            exit;
        }
        
        // Get any error messages from session
        $error = $_SESSION['login_error'] ?? null;
        
        // Clear error message from session
        unset($_SESSION['login_error']);
        
        // Render login form
        echo $this->render('auth/login', [
            'error' => $error,
            'request' => $request
        ]);
    }
    
    /**
     * Process login attempt
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function login(RequestObject $request): void
    {
        // If user is already authenticated, redirect to home
        if ($request->isAuthenticated()) {
            header('Location: /');
            exit;
        }
        
        // Get login credentials
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $rememberMe = isset($_POST['remember_me']);
        
        try {
            // Validate credentials
            $user = $this->userModel->verifyCredentials($email, $password);
            
            if (!$user) {
                // Invalid credentials
                $_SESSION['login_error'] = 'Email ou mot de passe incorrect.';
                header('Location: /login');
                exit;
            }
            
            // Create JWT token
            $token = $this->tokenService->createJWT($user->userId);
            
            // Create refresh token if "remember me" is checked
            if ($rememberMe) {
                $this->tokenService->createRefreshToken($user->userId);
            }
            
            // Redirect to home page
            header('Location: /');
            exit;
        } catch (AuthenticationException $e) {
            // Log the error
            error_log('Authentication error: ' . $e->getMessage());
            
            // Set error message and redirect back to login
            $_SESSION['login_error'] = 'Une erreur est survenue lors de la connexion. Veuillez réessayer.';
            header('Location: /login');
            exit;
        }
    }
    
    /**
     * Process logout
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function logout(RequestObject $request): void
    {
        // Clear JWT token cookie
        $this->tokenService->logout();
        
        // Clear session data
        session_unset();
        session_destroy();
        
        // Redirect to login page
        header('Location: /login');
        exit;
    }
    
    /**
     * Render a view with data
     * 
     * @param string $view View name
     * @param array $data Data to pass to the view
     * @return string Rendered view
     */
    private function render(string $view, array $data = []): string
    {
        // Initialize Twig environment
        $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__, 2) . '/templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => dirname(__DIR__, 2) . '/var/cache/twig',
            'debug' => $_ENV['APP_DEBUG'] ?? false,
            'auto_reload' => true
        ]);
        
        // Add global variables
        $twig->addGlobal('app_name', 'PANIKPA');
        $twig->addGlobal('current_year', date('Y'));
        
        // Add debug extension if in debug mode
        if ($_ENV['APP_DEBUG'] ?? false) {
            $twig->addExtension(new \Twig\Extension\DebugExtension());
        }
        
        // Render the view
        return $twig->render($view . '.html.twig', $data);
    }
}