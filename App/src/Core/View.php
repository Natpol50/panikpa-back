<?php

namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * View Class
 * 
 * Handles rendering Twig templates
 */
class View
{
    /**
     * @var Environment Twig environment
     */
    private static $twig;

    /**
     * Initialize Twig environment
     * 
     * @param string $viewsPath Path to the views directory
     * @param array $options Twig options
     * @return Environment Twig environment
     */
    public static function init($viewsPath, $options = [])
    {
        $loader = new FilesystemLoader($viewsPath);
        
        $defaultOptions = [
            'cache' => false, // Set to a directory path in production
            'debug' => true,
            'auto_reload' => true,
        ];
        
        $options = array_merge($defaultOptions, $options);
        
        self::$twig = new Environment($loader, $options);
        
        // Add global variables and extensions here
        if ($options['debug']) {
            self::$twig->addExtension(new \Twig\Extension\DebugExtension());
        }
        
        return self::$twig;
    }

    /**
     * Get the Twig environment
     * 
     * @return Environment Twig environment
     */
    public static function getTwig()
    {
        return self::$twig;
    }

    /**
     * Render a template
     * 
     * @param string $template Template name
     * @param array $data Data to pass to the template
     * @return string Rendered template
     */
    public static function render($template, $data = [])
    {
        if (!self::$twig) {
            throw new \Exception('Twig environment not initialized. Call View::init() first.');
        }
        
        return self::$twig->render($template, $data);
    }
}
