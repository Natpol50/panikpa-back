<?php

namespace App\Core;

/**
 * Router Class
 * 
 * Handles URL routing and dispatching to appropriate controllers
 */
class Router
{
    /**
     * @var array Array of registered/authorized routes
     */
    private $routes = [];
    
    /**
     * @var string The base path for the application
     */
    private $basePath = '';

    /**
     * Constructor
     * 
     * @param string $basePath Base path for the application
     */
    public function __construct($basePath = '')
    {
        $this->basePath = $basePath;
    }

    /**
     * Add a route to the routing table
     * 
     * @param string $method HTTP method (GET, POST, etc.)
     * @param string $route The route URL pattern
     * @param array $params Parameters (controller, action, etc.)
     * @return void
     */
    public function add($method, $route, $params = [])
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
     * Add a GET route
     * 
     * @param string $route The route URL pattern
     * @param array $params Parameters (controller, action, etc.)
     * @return void
     */
    public function get($route, $params = [])
    {
        $this->add('GET', $route, $params);
    }

    /**
     * Add a POST route
     * 
     * @param string $route The route URL pattern
     * @param array $params Parameters (controller, action, etc.)
     * @return void
     */
    public function post($route, $params = [])
    {
        $this->add('POST', $route, $params);
    }

    /**
     * Match the route to the routes in the routing table
     * 
     * @param string $url The route URL
     * @param string $method The request method
     * @return array|boolean Array of parameters or false if no route found
     */
    public function match($url, $method)
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
     * @param string $url The route URL
     * @param string $method The request method
     * @return void
     * @throws \Exception When route not found or controller/action not found
     */
    public function dispatch($url, $method = 'GET')
    {
        $params = $this->match($url, $method);
        
        if ($params === false) {
            throw new \Exception("No route found for $url with method $method", 404);
        }
        
        // Get controller class
        $controller = $params['controller'];
        $controller = "App\\Controllers\\$controller";
        
        if (!class_exists($controller)) {
            throw new \Exception("Controller class $controller not found", 500);
        }
        
        // Get action method
        $action = $params['action'] ?? 'index';
        
        $controller = new $controller();
        
        if (!method_exists($controller, $action)) {
            throw new \Exception("Method $action not found in controller $controller", 500);
        }
        
        // Call controller action with any route parameters
        unset($params['controller']);
        unset($params['action']);
        
        return call_user_func_array([$controller, $action], $params);
    }
}
