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
        
        // Get any error from query parameters
        $error = $_GET['error'] ?? null;
        
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
                header('Location: /login?error=' . urlencode('Email ou mot de passe incorrect.'));
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
            header('Location: /login?error=' . urlencode('Une erreur est survenue lors de la connexion. Veuillez réessayer.'));
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
        
        // Redirect to login page
        header('Location: /login');
        exit;
    }

    /**
     * Display registration form
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function registerForm(RequestObject $request): void
    {
        // If user is already authenticated, redirect to home
        if ($request->isAuthenticated()) {
            header('Location: /');
            exit;
        }
        
        // Get any error from query parameters
        $error = $_GET['error'] ?? null;
        
        // Render registration form
        echo $this->render('auth/register', [
            'error' => $error,
            'request' => $request
        ]);
    }
    
    /**
     * Process registration attempt
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function register(RequestObject $request): void
    {
        // If user is already authenticated, redirect to home
        if ($request->isAuthenticated()) {
            header('Location: /');
            exit;
        }
        
        // Get registration data
        $lastName = $_POST['lastName'] ?? '';
        $firstName = $_POST['firstName'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirmPassword'] ?? '';
        
        // Validate password match
        if ($password !== $confirmPassword) {
            header('Location: /new-account?error=' . urlencode('Les mots de passe ne correspondent pas.'));
            exit;
        }
        
        try {
            // Check if email already exists
            $existingUser = $this->userModel->getUserByEmail($email);
            if ($existingUser) {
                header('Location: /new-account?error=' . urlencode('Cet email est déjà utilisé.'));
                exit;
            }
            
            // Create user data array
            $userData = [
                'userName' => $lastName,
                'userFirstName' => $firstName,
                'userEmail' => $email,
                'userPassword' => $password,
                'userPhone' => $phone,
                'userGender' => 'N', // Default value
                'userRoleId' => 3,   // Student role ID
            ];
            
            // Create user
            $newUser = $this->userModel->createUser($userData);
            
            // Create JWT token for auto-login
            $token = $this->tokenService->createJWT($newUser->userId);
            
            // Redirect to home page with success message
            header('Location: /?success=' . urlencode('Compte créé avec succès.'));
            exit;
        } catch (\Exception $e) {
            // Log the error
            error_log('Registration error: ' . $e->getMessage());
            
            // Set error message and redirect back to registration
            header('Location: /new-account?error=' . urlencode('Une erreur est survenue lors de la création du compte. Veuillez réessayer.'));
            exit;
        }
    }
    
    /**
     * Display forgot password form
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function forgotPasswordForm(RequestObject $request): void
    {
        // If user is already authenticated, redirect to home
        if ($request->isAuthenticated()) {
            header('Location: /');
            exit;
        }
        
        // Get messages from query parameters
        $error = $_GET['error'] ?? null;
        $success = $_GET['success'] ?? null;
        
        // Render forgot password form directly with parameters
        echo $this->render('auth/forgot-password', [
            'error' => $error,
            'success' => $success,
            'request' => $request
        ]);
    }
    
    /**
     * Process forgot password attempt
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function forgotPassword(RequestObject $request): void
    {
        // If user is already authenticated, redirect to home
        if ($request->isAuthenticated()) {
            header('Location: /');
            exit;
        }
        
        $email = $_POST['email'] ?? '';
        
        // Validate email exists
        $user = $this->userModel->getUserByEmail($email);
        
        $successMessages = [];
        $errorMessages = [];
        
        if (!$user) {
            // For security, don't indicate whether email exists or not
            $successMessages[] = 'Si un compte existe avec cet email, un lien de réinitialisation sera envoyé.';
        } else {
            try {
                // Generate a unique token for password reset
                // In a real implementation, this would send an email with a reset link
                $successMessages[] = 'Un email de réinitialisation de mot de passe a été envoyé à votre adresse.';
            } catch (\Exception $e) {
                // Log the error
                error_log('Forgot password error: ' . $e->getMessage());
                
                // Add error message
                $errorMessages[] = 'Une erreur est survenue. Veuillez réessayer.';
            }
        }
        
        // Render forgot password form with success and error messages
        echo $this->render('auth/forgot-password', [
            'success' => $successMessages,
            'error' => $errorMessages,
            'request' => $request
        ]);
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