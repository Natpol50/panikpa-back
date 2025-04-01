<?php

namespace App\Core;

use App\Middleware\AuthMiddleware;
use App\Exceptions\NotFoundException;
use App\Exceptions\AuthorizationException;

/**
 * Router - URL routing and controller dispatcher
 * 
 * Handles URL routing and dispatching to appropriate controllers.
 */
class Router
{
    private array $routes = [];
    private string $basePath = '';
    private ?AuthMiddleware $authMiddleware;
    
    /**
     * Create a new router instance
     * 
     * @param string $basePath Base path for the application
     * @param AuthMiddleware|null $authMiddleware Authentication middleware instance
     */
    public function __construct(string $basePath = '', ?AuthMiddleware $authMiddleware = null) 
    {   
        $this->basePath = $basePath;
        $this->authMiddleware = $authMiddleware;
    }
    
    /**
     * Register a GET route
     * 
     * @param string $route The route URL pattern
     * @param array $params Parameters (controller, action, etc.)
     * @return void
     */
    public function get(string $route, array $params = []): void
    {
        $this->addRoute('GET', $route, $params);
    }
    
    /**
     * Register a POST route
     * 
     * @param string $route The route URL pattern
     * @param array $params Parameters (controller, action, etc.)
     * @return void
     */
    public function post(string $route, array $params = []): void
    {
        $this->addRoute('POST', $route, $params);
    }
    
    /**
     * Add a route to the routing table
     * 
     * @param string $method HTTP method (GET, POST, etc.)
     * @param string $route The route URL pattern
     * @param array $params Parameters (controller, action, etc.)
     * @return void
     */
    private function addRoute(string $method, string $route, array $params = []): void
    {
        // Convert route to regex pattern
        $route = preg_replace('/\//', '\\/', $route);
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        $route = '/^' . $route . '$/i';
        
        $this->routes[] = [
            'method' => $method,
            'route' => $route,
            'params' => $params
        ];
    }
    
    /**
     * Match the route to the routes in the routing table
     * 
     * @param string $url The route URL
     * @param string $method The request method
     * @return array|false Array of parameters or false if no route found
     */
    public function match(string $url, string $method): array|false
    {
        // Remove query string from URL
        $url = parse_url($url, PHP_URL_PATH);
        
        // Remove base path from URL
        if (!empty($this->basePath)) {
            $url = str_replace($this->basePath, '', $url);
        }
        
        // Make sure URL starts with a slash
        if ($url !== '/') {
            $url = '/' . ltrim($url, '/');
        }
        
        // Check each route for a match
        foreach ($this->routes as $route) {
            // Skip routes that don't match the request method
            if ($route['method'] !== $method) {
                continue;
            }
            
            if (preg_match($route['route'], $url, $matches)) {
                $params = $route['params'];
                
                // Get named capture group values
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                
                return $params;
            }
        }
        
        return false;
    }
    
    /**
     * Dispatch the route to the controller and action
     * 
     * @param string|null $url The route URL (null to use current URL)
     * @param string|null $method The request method (null to use current method)
     * @return mixed Controller action result
     * @throws NotFoundException When route not found
     * @throws \Exception When controller or action not found
     */
    public function dispatch(?string $url = null, ?string $method = null): mixed
    {
        // Use current URL and method if not provided
        $url = $url ?? $_SERVER['REQUEST_URI'];
        $method = $method ?? $_SERVER['REQUEST_METHOD'];
        
        // Match route to get parameters
        $params = $this->match($url, $method);
        
        if ($params === false) {
            throw new NotFoundException("No route found for $url with method $method");
        }
        
        // Get RequestObject from AuthMiddleware
        $requestObject = null;
        
        if ($this->authMiddleware !== null) {
            // Call the Process method of AuthMiddleware to get a complete RequestObject
            $requestObject = $this->authMiddleware->handle();
            
            // Check if the route requires authentication
            if (isset($params['auth']) && $params['auth'] === true && $requestObject === null) {
                // Redirect to login page if authentication required but not authenticated
                header('Location: /login');
                exit;
            }
        }
        
        // If no RequestObject created yet, create a default one
        if ($requestObject === null) {
            $requestObject = new RequestObject();
        }
        
        // Get controller class
        $controller = $params['controller'] ?? 'HomeController';
        $controller = "App\\Controllers\\$controller";
        
        if (!class_exists($controller)) {
            throw new \Exception("Controller class $controller not found");
        }
        
        // Get action method
        $action = $params['action'] ?? 'index';
        
        // Create controller instance
        $controllerInstance = new $controller();
        
        if (!method_exists($controllerInstance, $action)) {
            throw new \Exception("Method $action not found in controller $controller");
        }
        
        // Call controller action with RequestObject as the first parameter
        return call_user_func([$controllerInstance, $action], $requestObject);
    }
}