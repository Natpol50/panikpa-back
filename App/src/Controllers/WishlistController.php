<?php

namespace App\Controllers;

use App\Core\RequestObject;
use App\Models\WishlistModel;
use App\Exceptions\AuthorizationException;
use App\Services\CacheService;

/**
 * WishlistController - Handles wishlist-related actions
 */
class WishlistController extends BaseController
{
    private WishlistModel $wishlistModel;
    private CacheService $cache;
    
    /**
     * Constructor initializes dependencies
     */
    public function __construct()
    {
        $this->wishlistModel = new WishlistModel();
        $this->cache = new CacheService();
    }
    
    /**
     * Toggle an offer's wishlist status
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function toggle(RequestObject $request): void
    {
        // Set response header to JSON
        header('Content-Type: application/json');
        
        // Check if user is authenticated
        if (!$request->isAuthenticated()) {
            http_response_code(401);
            echo json_encode([
                'success' => false,
                'message' => 'You must be logged in to manage your wishlist'
            ]);
            return;
        }
        
        // Check if the user has permission to use the wishlist
        if (!$this->cache->checkRolePermission($request->userRole, 'perm_wishlist')) {
            http_response_code(403);
            echo json_encode([
                'success' => false,
                'message' => 'You do not have permission to use the wishlist feature'
            ]);
            return;
        }
        
        // Get offer ID from URL parameters 
        // Extract it from the last segment of the URL
        $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $segments = explode('/', trim($urlPath, '/'));
        $id = (int)end($segments);
        
        if ($id <= 0) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Invalid offer ID'
            ]);
            return;
        }
        
        try {
            $userId = $request->userId;
            
            // Check current wishlist status
            $isInWishlist = $this->wishlistModel->isInWishlist($userId, $id);
            
            if ($isInWishlist) {
                // If already in wishlist, remove it
                $success = $this->wishlistModel->removeFromWishlist($userId, $id);
                $newStatus = false;
            } else {
                // If not in wishlist, add it
                $success = $this->wishlistModel->addToWishlist($userId, $id);
                $newStatus = true;
            }
            
            if ($success) {
                echo json_encode([
                    'success' => true,
                    'wishlisted' => $newStatus,
                    'message' => $newStatus ? 
                        'Offer added to your wishlist' : 
                        'Offer removed from your wishlist'
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to update wishlist'
                ]);
            }
            
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ]);
        }
    }
    
    /**
     * Display wishlist page
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function index(RequestObject $request): void
    {
        // Check if user is authenticated
        if (!$request->isAuthenticated()) {
            header('Location: /login');
            exit;
        }
        
        // Check if the user has permission to use the wishlist
        if (!$this->cache->checkRolePermission($request->userRole, 'perm_wishlist')) {
            header('Location: /');
            exit;
        }
        
        try {
            // Get wishlist items
            $wishlistItems = $this->wishlistModel->getWishlistOffersFromUserId($request->userId);
            
            // Render wishlist view
            echo $this->render('wishlist/index', [
                'request' => $request,
                'wishlistItems' => $wishlistItems
            ]);
            
        } catch (\Exception $e) {
            // Handle errors
            echo $this->render('wishlist/index', [
                'request' => $request,
                'error' => ['An error occurred: ' . $e->getMessage()],
                'wishlistItems' => []
            ]);
        }
    }
}