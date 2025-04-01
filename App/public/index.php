<?php

/**
 * Application Entry Point
 * 
 * This file initializes the application, sets up dependencies,
 * defines routes, and dispatches requests to controllers.
 */

// Require Composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Import core classes
use App\Config\ConfigManager;
use App\Services\Database;
use App\Services\TokenService;
use App\Services\CacheService;
use App\Middleware\AuthMiddleware;
use App\Core\Router;
use App\Exceptions\ApplicationException;
use App\Exceptions\NotFoundException;

// Initialize error handling for production
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Set up exception handler
set_exception_handler(function ($exception) {
    $statusCode = 500;
    $isDebug = $_ENV['APP_DEBUG'] ?? false;
    
    // Log the exception
    error_log($exception->getMessage() . "\n" . $exception->getTraceAsString());
    
    // Handle different exception types
    if ($exception instanceof NotFoundException) {
        $statusCode = 404;
    } elseif ($exception instanceof \App\Exceptions\AuthenticationException) {
        $statusCode = 401;
    } elseif ($exception instanceof \App\Exceptions\AuthorizationException) {
        $statusCode = 403;
    }
    
    // Set HTTP status code
    http_response_code($statusCode);
    
    // In development mode, show detailed error information
    if ($isDebug) {
        echo '<div style="padding: 20px; font-family: Arial, sans-serif;">';
        echo '<h1>Error: ' . htmlspecialchars($exception->getMessage()) . '</h1>';
        echo '<p>File: ' . htmlspecialchars($exception->getFile()) . ' (Line ' . $exception->getLine() . ')</p>';
        echo '<h2>Stack Trace:</h2>';
        echo '<pre>' . htmlspecialchars($exception->getTraceAsString()) . '</pre>';
        echo '</div>';
    } else {
        // In production, show a generic error page
        if ($statusCode === 404) {
            require __DIR__ . '/404.html';
        } else {
            require __DIR__ . '/error.html';
        }
    }
    
    exit;
});

// Initialize the Config Manager
$configManager = ConfigManager::getInstance();

// Create a TokenService instance to fetch the real config
$tokenService = TokenService::getInstance();


// Initialize the Cache Service
$cacheService = new CacheService();

// Initialize the Auth Middleware
$authMiddleware = new AuthMiddleware($tokenService, $cacheService);

// Initialize the Router
$router = new Router('', $authMiddleware);

// Define routes
$router->get('/login', ['controller' => 'AuthController', 'action' => 'loginForm']);
$router->post('/login', ['controller' => 'AuthController', 'action' => 'login']);
$router->get('/logout', ['controller' => 'AuthController', 'action' => 'logout']);

// Enterprise routes
$router->get('/entreprises', ['controller' => 'EnterpriseController', 'action' => 'index', 'auth' => true]);
$router->get('/entreprises/create', ['controller' => 'EnterpriseController', 'action' => 'create', 'auth' => true]);
$router->post('/entreprises', ['controller' => 'EnterpriseController', 'action' => 'store', 'auth' => true]);

// Offer routes
$router->get('/offres', ['controller' => 'OfferController', 'action' => 'index']);
$router->get('/offres/stages', ['controller' => 'OfferController', 'action' => 'stages']);
$router->get('/offres/alternances', ['controller' => 'OfferController', 'action' => 'alternances']);
$router->get('/offres/create', ['controller' => 'OfferController', 'action' => 'create', 'auth' => true]);
$router->post('/offres', ['controller' => 'OfferController', 'action' => 'store', 'auth' => true]);
$router->get('/offres/{id}', ['controller' => 'OfferController', 'action' => 'show']);
$router->get('/API/GetOffers', ['controller' => 'OfferController', 'action' => 'apiGetOffers']);

// Add this for wishlist toggle functionality
$router->post('API/wishlist/toggle/{id}', ['controller' => 'WishlistController', 'action' => 'toggle', 'auth' => true]);

// Application routes
$router->get('/form', ['controller' => 'ApplicationController', 'action' => 'form']);
$router->post('/submit_application', ['controller' => 'ApplicationController', 'action' => 'submit']);

// Wishlist routes
$router->get('/wishlist', ['controller' => 'WishlistController', 'action' => 'index', 'auth' => true]);
$router->post('/wishlist/add/{id}', ['controller' => 'WishlistController', 'action' => 'add', 'auth' => true]);
$router->post('/wishlist/remove/{id}', ['controller' => 'WishlistController', 'action' => 'remove', 'auth' => true]);

// User management routes
$router->get('/users', ['controller' => 'UserController', 'action' => 'index', 'auth' => true]);
$router->get('/users/create', ['controller' => 'UserController', 'action' => 'create', 'auth' => true]);
$router->post('/users', ['controller' => 'UserController', 'action' => 'store', 'auth' => true]);
$router->get('/users/{id}', ['controller' => 'UserController', 'action' => 'show', 'auth' => true]);
// Legal pages
$router->get('/CGU', ['controller' => 'LegalController', 'action' => 'cgu']);
$router->get('/RGPD', ['controller' => 'LegalController', 'action' => 'rgpd']);


// Account creation routes
$router->get('/new-account', ['controller' => 'AuthController', 'action' => 'registerForm']);
$router->post('/new-account', ['controller' => 'AuthController', 'action' => 'register']);

// Password reset routes
$router->get('/examplenotification', ['controller' => 'ExampleController', 'action' => 'exampleMethod']);

$router->get('/forgot-password', ['controller' => 'AuthController', 'action' => 'forgotPasswordForm']);
$router->post('/forgot-password', ['controller' => 'AuthController', 'action' => 'forgotPassword']);
$router->post('/verify-reset-code', ['controller' => 'AuthController', 'action' => 'verifyResetCode']);
$router->get('/reset-password/{token}', ['controller' => 'AuthController', 'action' => 'resetPasswordForm']);
$router->post('/reset-password', ['controller' => 'AuthController', 'action' => 'resetPassword']);

$router->get('/', ['controller' => 'HomeController', 'action' => 'index']);
$router->get('/API/latestupdates', ['controller' => 'HomeController', 'action' => 'apiUpdates']);
$router->get('/API/favoffers', ['controller' => 'HomeController', 'action' => 'apiFavoriteOffers']);


$router->get('/favicon.ico', ['controller' => 'AssetController', 'action' => 'favicon']);

// Dispatch the request
try {
    $router->dispatch();
} catch (Exception $e) {
    // Exception handler will catch this
    throw $e;
}