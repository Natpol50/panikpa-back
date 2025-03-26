<?php

// Load Composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Error handling for development
if ($_ENV['APP_ENV'] === 'development') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

// Initialize the router
$router = new App\Core\Router();

// Initialize Twig
App\Core\View::init(__DIR__ . '/../src/Views', [
    'cache' => $_ENV['APP_ENV'] === 'production' ? __DIR__ . '/../var/cache/twig' : false,
    'debug' => $_ENV['APP_ENV'] === 'development',
    'auto_reload' => $_ENV['APP_ENV'] === 'development',
]);

// Define routes
$router->get('/', ['controller' => 'HomeController', 'action' => 'index']);
$router->get('/offres', ['controller' => 'OffresController', 'action' => 'index']);
$router->get('/offres.html', ['controller' => 'OffresController', 'action' => 'index']);
$router->get('/stages', ['controller' => 'OffresController', 'action' => 'stages']);
$router->get('/stages.html', ['controller' => 'OffresController', 'action' => 'stages']);
$router->get('/form', ['controller' => 'FormController', 'action' => 'index']);
$router->get('/form.html', ['controller' => 'FormController', 'action' => 'index']);
$router->post('/submit_application.php', ['controller' => 'FormController', 'action' => 'submit']);
$router->get('/CGU', ['controller' => 'CGUController', 'action' => 'index']);
$router->get('/CGU.html', ['controller' => 'CGUController', 'action' => 'index']);
$router->get('/RGPD', ['controller' => 'RGPDController', 'action' => 'index']);
$router->get('/RGPD.html', ['controller' => 'RGPDController', 'action' => 'index']);
$router->get('/get_offers.php', ['controller' => 'OffresController', 'action' => 'getOffers']);

try {
    // Dispatch the route
    $router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
} catch (Exception $e) {
    // Handle 404 and other errors
    http_response_code($e->getCode() ?: 500);
    echo 'Error: ' . $e->getMessage();
}
