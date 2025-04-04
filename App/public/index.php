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
$router->get('/entreprises', ['controller' => 'EnterpriseController', 'action' => 'index']);
$router->post('/entreprises/edit', ['controller' => 'EnterpriseController', 'action' => 'update', 'auth' => true]);
$router->get('/entreprises/create', ['controller' => 'EnterpriseController', 'action' => 'create', 'auth' => true]);
$router->get('/entreprises/{id:[A-Za-z0-9]}{td:[A-Za-z0-9]}{cd:[A-Za-z0-9]}/edit', ['controller' => 'EnterpriseController', 'action' => 'edit', 'auth' => true]);
$router->get('/entreprises/{id:[A-Za-z0-9]+}', ['controller' => 'EnterpriseController', 'action' => 'show', 'auth' => true]);
$router->post('/entreprises', ['controller' => 'EnterpriseController', 'action' => 'store', 'auth' => true]);
$router->get('/API/entreprises', ['controller' => 'EnterpriseController', 'action' => 'ApiList']);
$router->post('/api/evaluate-enterprise', ['controller' => 'EnterpriseController', 'action' => 'apiEvaluate', 'auth' => true]);
$router->get('/api/delete-enterprise', ['controller' => 'EnterpriseController', 'action' => 'apiDelete', 'auth' => true]);
$router->post('/API/entreprises/comments', ['controller' => 'EnterpriseController', 'action' => 'apiAddComment', 'auth' => true]);
$router->get('/API/entreprises/{id:[A-Za-z0-9]}{td:[A-Za-z0-9]}{cd:[A-Za-z0-9]}/comments', ['controller' => 'EnterpriseController', 'action' => 'apiGetComments']);



// Offer routes
$router->get('/offres', ['controller' => 'OfferController', 'action' => 'index']);
$router->get('/offres/stages', ['controller' => 'OfferController', 'action' => 'stages']);
$router->get('/offres/alternances', ['controller' => 'OfferController', 'action' => 'alternances']);
$router->get('/offres/create', ['controller' => 'OfferController', 'action' => 'create', 'auth' => true]);
$router->post('/offres', ['controller' => 'OfferController', 'action' => 'store', 'auth' => true]);
$router->get('/offres/{id:[A-Za-z0-9]+}', ['controller' => 'OfferController', 'action' => 'show']);
$router->get('/offres/edit/{id:[0-9]+}', ['controller' => 'OfferController', 'action' => 'edit', 'auth' => true]);
$router->post('/offres/update', ['controller' => 'OfferController', 'action' => 'update', 'auth' => true]);
$router->get('/API/GetOffers', ['controller' => 'OfferController', 'action' => 'apiGetOffers']);
$router->get('/api/delete-offer', ['controller' => 'OfferController', 'action' => 'apiDelete', 'auth' => true]);

// Add this for wishlist toggle functionality
$router->post('/API/wishlist/toggle/{id:[A-Za-z0-9]+}', ['controller' => 'WishlistController', 'action' => 'toggle', 'auth' => true]);
$router->get('/API/wishlist', ['controller' => 'WishlistController', 'action' => 'apiGetWishlist', 'auth' => true]);

// Application routes
$router->get('/form', ['controller' => 'ApplicationController', 'action' => 'form']);
$router->post('/submit_application', ['controller' => 'ApplicationController', 'action' => 'submit', 'auth'=> true]);

// Wishlist routes
$router->get('/wishlist', ['controller' => 'WishlistController', 'action' => 'index', 'auth' => true]);

// User management routes
$router->get('/users', ['controller' => 'UserController', 'action' => 'index', 'auth' => true]);
$router->get('/users/create', ['controller' => 'UserController', 'action' => 'create', 'auth' => true]);
$router->post('/users', ['controller' => 'UserController', 'action' => 'store', 'auth' => true]);
$router->get('/users/{id}', ['controller' => 'UserController', 'action' => 'show', 'auth' => true]);

// Legal pages
$router->get('/CGU', ['controller' => 'StaticController', 'action' => 'showCguPage']);
$router->get('/RGPD', ['controller' => 'StaticController', 'action' => 'showRgpdPage']);
$router->get('/team', ['controller' => 'StaticController', 'action' => 'showOurTeamPage']);
$router->get('/about', ['controller' => 'StaticController', 'action' => 'showWhoAreWePage']);


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

// User profile routes
$router->get('/profile', ['controller' => 'UserController', 'action' => 'profile', 'auth' => true]);
$router->post('/update-profile', ['controller' => 'UserController', 'action' => 'updateProfile', 'auth' => true]);
$router->post('/upload-profile-picture', ['controller' => 'UserController', 'action' => 'uploadProfilePicture', 'auth' => true]);
$router->post('/change-password', ['controller' => 'UserController', 'action' => 'changePassword', 'auth' => true]);
$router->post('/delete-user/{id:[0-9]+}', ['controller' => 'UserController', 'action' => 'apiDeleteUser', 'auth' => true]);
$router->get('/API/enterpriseList', ['controller' => 'EnterpriseController', 'action' => 'apiEnterpriseList']);
$router->get('/API/tagsList', ['controller' => 'OfferController', 'action' => 'apiTagsList']);
$router->get('/API/citiesList', ['controller' => 'OfferController', 'action' => 'apiCityList']);

// Gestion routes
$router->get('/gestion', ['controller' => 'GestionController', 'action' => 'index', 'auth' => true]);
$router->get('/gestion/promotion', ['controller' => 'GestionController', 'action' => 'promo', 'auth' => true]);
$router->get('/gestion/user', ['controller' => 'GestionController', 'action' => 'userGestion', 'auth' => true]);
$router->get('/API/gestionpromo', ['controller' => 'GestionController', 'action' => 'apiGetPromoUsers', 'auth' => true]);
$router->get('/API/admingetuser', ['controller' => 'GestionController', 'action' => 'apiGetUserAdmin', 'auth' => true]);
$router->get('/API/tutorgetser', ['controller' => 'GestionController', 'action' => 'apiGetUserTutor', 'auth' => true]);
$router->post('/API/createuser', ['controller' => 'GestionController', 'action' => 'apiCreateUser', 'auth' => true]);
$router->post('/API/updateuser', ['controller' => 'GestionController', 'action' => 'apiUpdateUser', 'auth' => true]);
$router->post('/API/deleteuser', ['controller' => 'GestionController', 'action' => 'apiDeleteUser', 'auth' => true]);
// User tags routes
$router->get('/API/user/tags', ['controller' => 'UserController', 'action' => 'apiGetUserTags', 'auth' => true]);
$router->post('/API/user/tags/add', ['controller' => 'UserController', 'action' => 'apiAddUserTag', 'auth' => true]);
$router->post('/API/user/tags/remove', ['controller' => 'UserController', 'action' => 'apiRemoveUserTag', 'auth' => true]);

// Application routes
$router->get('/form', ['controller' => 'ApplicationController', 'action' => 'form']);
$router->post('/submit_application', ['controller' => 'ApplicationController', 'action' => 'submit', 'auth'=> true]);
$router->get('/applications', ['controller' => 'ApplicationController', 'action' => 'viewApplications', 'auth' => true]);
$router->post('/apply', ['controller' => 'ApplicationController', 'action' => 'submit', 'auth' => true]);

$router->get('/favicon.ico', ['controller' => 'AssetController', 'action' => 'favicon']);

// Dispatch the request
try {
    $router->dispatch();
} catch (Exception $e) {
    // Exception handler will catch this
    throw $e;
}