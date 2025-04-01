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
        
        // Render login form with empty arrays for messages
        echo $this->render('auth/login', [
            'error' => [],
            'success' => [],
            'request' => $request,
            'formData' => [] // Empty form data
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
        
        // Save form data to repopulate the form if there's an error
        $formData = [
            'email' => $email,
            'remember_me' => $rememberMe
        ];
        
        $errorMessages = [];
        $successMessages = [];
        
        try {
            // Validate credentials
            $user = $this->userModel->verifyCredentials($email, $password);
            
            if (!$user) {
                // Add error message to array
                $errorMessages[] = 'Email ou mot de passe incorrect.';
                
                // Render the login form with error and preserved form data
                echo $this->render('auth/login', [
                    'error' => $errorMessages,
                    'success' => $successMessages,
                    'request' => $request,
                    'formData' => $formData
                ]);
                exit; // Important to prevent further execution
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
            
            // Add error to array
            $errorMessages[] = 'Une erreur est survenue lors de la connexion. Veuillez réessayer.';
            
            // Render the login form with error and preserved form data
            echo $this->render('auth/login', [
                'error' => $errorMessages,
                'success' => $successMessages,
                'request' => $request,
                'formData' => $formData
            ]);
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
        
        // Set up success message for login form
        $successMessages = ['Vous avez été déconnecté avec succès.'];
        
        // Render login form with success message
        echo $this->render('auth/login', [
            'error' => [],
            'success' => $successMessages,
            'request' => $request,
            'formData' => []
        ]);
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
        
        // Render registration form with empty arrays
        echo $this->render('auth/register', [
            'error' => [],
            'success' => [],
            'request' => $request,
            'formData' => []
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
        
        // Save form data to repopulate the form if there's an error
        $formData = [
            'lastName' => $lastName,
            'firstName' => $firstName,
            'email' => $email,
            'phone' => $phone
        ];
        
        $errorMessages = [];
        $successMessages = [];
        
        // Validate password match
        if ($password !== $confirmPassword) {
            $errorMessages[] = 'Les mots de passe ne correspondent pas.';
            
            echo $this->render('auth/register', [
                'error' => $errorMessages,
                'success' => $successMessages,
                'request' => $request,
                'formData' => $formData
            ]);
            exit;
        }
        
        try {
            // Check if email already exists
            $existingUser = $this->userModel->getUserByEmail($email);
            if ($existingUser) {
                $errorMessages[] = 'Cet email est déjà utilisé.';
                
                echo $this->render('auth/register', [
                    'error' => $errorMessages,
                    'success' => $successMessages,
                    'request' => $request,
                    'formData' => $formData
                ]);
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
            
            // Set success message for home page and redirect
            $successMessages = ['Compte créé avec succès.'];
            
            // Store success message in session
            $_SESSION['success'] = $successMessages;
            
            // Redirect to home page
            header('Location: /');
            exit;
        } catch (\Exception $e) {
            // Log the error
            error_log('Registration error: ' . $e->getMessage());
            
            // Add error message to array
            $errorMessages[] = 'Une erreur est survenue lors de la création du compte. Veuillez réessayer.';
            
            // Render registration form with error and preserved form data
            echo $this->render('auth/register', [
                'error' => $errorMessages,
                'success' => $successMessages,
                'request' => $request,
                'formData' => $formData
            ]);
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
        
        // Render forgot password form with empty arrays
        echo $this->render('auth/forgot-password', [
            'error' => [],
            'success' => [],
            'request' => $request,
            'formData' => []
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
        
        // Save form data
        $formData = [
            'email' => $email
        ];
        
        // Initialize message arrays
        $successMessages = [];
        $errorMessages = [];
        
        // Validate email exists
        $user = $this->userModel->getUserByEmail($email);
        
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
            'request' => $request,
            'formData' => $formData
        ]);
    }
    
    /**
     * Display reset password form
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function resetPasswordForm(RequestObject $request): void
    {
        // If user is already authenticated, redirect to home
        if ($request->isAuthenticated()) {
            header('Location: /');
            exit;
        }
        
        $token = $_GET['token'] ?? '';
        
        // Initialize message arrays
        $errorMessages = [];
        $successMessages = [];
        
        // Validate token (would require implementation)
        if (empty($token)) {
            $errorMessages[] = 'Token de réinitialisation invalide ou expiré.';
            
            // Render forgot password form with error
            echo $this->render('auth/forgot-password', [
                'error' => $errorMessages,
                'success' => $successMessages,
                'request' => $request,
                'formData' => []
            ]);
            exit;
        }
        
        // Render reset password form
        echo $this->render('auth/reset-password', [
            'token' => $token,
            'error' => $errorMessages,
            'success' => $successMessages,
            'request' => $request,
            'formData' => []
        ]);
    }
    
    /**
     * Process reset password attempt
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function resetPassword(RequestObject $request): void
    {
        // If user is already authenticated, redirect to home
        if ($request->isAuthenticated()) {
            header('Location: /');
            exit;
        }
        
        // Get form data
        $token = $_POST['token'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirmPassword'] ?? '';
        
        // Initialize message arrays
        $errorMessages = [];
        $successMessages = [];
        
        // Validate passwords match
        if ($password !== $confirmPassword) {
            $errorMessages[] = 'Les mots de passe ne correspondent pas.';
            
            echo $this->render('auth/reset-password', [
                'token' => $token,
                'error' => $errorMessages,
                'success' => $successMessages,
                'request' => $request,
                'formData' => []
            ]);
            exit;
        }
        
        // Validate token and update password (would require implementation)
        // In a real application, verify token and update user's password
        
        // Set success message for login form
        $successMessages[] = 'Votre mot de passe a été réinitialisé avec succès.';
        
        // Render login form with success message
        echo $this->render('auth/login', [
            'error' => [],
            'success' => $successMessages,
            'request' => $request,
            'formData' => []
        ]);
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