<?php

namespace App\Controllers;

use App\Core\RequestObject;
use App\Models\WishlistModel;
use App\Exceptions\AuthorizationException;
use App\Models\EnterpriseModel;
use App\Models\CityModel;
use App\Models\TagModel;
use App\Models\InteractionModel;
use App\Services\CacheService;

/**
 * WishlistController - Handles wishlist-related actions
 */
class WishlistController extends BaseController
{
    private WishlistModel $wishlistModel;
    private CacheService $cache;
    private EnterpriseModel $enterpriseModel;
    private CityModel $cityModel;
    private TagModel $tagModel;
    private InteractionModel $interactionModel;

    
    /**
     * Constructor initializes dependencies
     */
    public function __construct()
    {
        $this->wishlistModel = new WishlistModel();
        $this->cache = new CacheService();
        $this->enterpriseModel = new EnterpriseModel();
        $this->cityModel = new CityModel();
        $this->tagModel = new TagModel();
        $this->interactionModel = new InteractionModel();
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
        if (!$request->hasPermission('perm_wishlist')) {
            header('Location: /');
            exit;
        }
        
        // Render wishlist view
        echo $this->render('wishlist/index', [
            'request' => $request
        ]);
    }
    /**
     * API endpoint to fetch wishlist items with pagination
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function apiGetWishlist(RequestObject $request): void
    {
        // Set response header to JSON
        header('Content-Type: application/json');
        
        // Check if user is authenticated
        if (!$request->isAuthenticated()) {
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Authentication required']);
            exit;
        }
        
        // Check if the user has permission to use the wishlist
        if (!$request->hasPermission('perm_wishlist')) {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Permission denied']);
            exit;
        }
        
        try {
            // Get query parameters for pagination
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
            
            // Fetch paginated wishlist items
            $result = $this->wishlistModel->getWishlistOffersPaginated($request->userId, $page, $limit);
            $offers = $result['offers'];
            $totalOffers = $result['totalOffers'];
            $totalPages = ceil($totalOffers / $limit);
            
            // Format offer data with additional information
            $formattedOffers = [];
            
            foreach ($offers as $offer) {
                // Get enterprise data
                $enterprise = $this->enterpriseModel->getEnterpriseById($offer['id_enterprise']);
                $enterpriseName = $enterprise ? $enterprise['enterprise_name'] : 'Unknown';
                
                // Get city data
                $city = $this->cityModel->getCityById($offer['id_city']);
                $cityName = $city ? $city['city_name'] . ' - ' . $city['city_postal'] : 'Unknown Location';
                
                // Get tags for this offer
                $tags = $this->tagModel->getTagsByOfferId($offer['id_offer']);
                
                // Format tags for display
                $formattedTags = [];
                foreach ($tags as $tag) {
                    $formattedTags[] = [
                        'id' => $tag['id_tag'],
                        'name' => $tag['tag_name'],
                        'optional' => (bool)$tag['optional']
                    ];
                }
                
                // Check if user has applied to this offer
                $hasApplied = false;
                if ($request->isAuthenticated()) {
                    $applications = $this->interactionModel->getInteractionByUserId($request->userId);
                    $appliedOfferIds = array_column($applications, 'id_offer');
                    $hasApplied = in_array($offer['id_offer'], $appliedOfferIds);
                }
                
                // Create a nicely formatted offer object
                $formattedOffers[] = [
                    'id' => $offer['id_offer'],
                    'title' => $offer['offer_title'],
                    'company' => $enterpriseName,
                    'location' => $cityName,
                    'reference' => sprintf('%s%d', $offer['id_enterprise'], $offer['id_offer']),
                    'duration' => $offer['offer_duration'],
                    'level' => $offer['offer_level'],
                    'startDate' => date('d/m/Y', strtotime($offer['offer_start'])),
                    'publishDate' => date('d/m/Y', strtotime($offer['offer_publish_date'])),
                    'remuneration' => $offer['offer_remuneration'],
                    'wishlisted' => true, // Always true since these are wishlist items
                    'applied' => $hasApplied,
                    'tags' => $formattedTags,
                    'highlighted' => stripos($offer['offer_level'], 'Bac+3, Bac+5') !== false
                ];
            }
            
            // Return JSON response
            echo json_encode([
                'success' => true,
                'offers' => $formattedOffers,
                'totalPages' => $totalPages,
                'currentPage' => $page,
                'totalOffers' => $totalOffers
            ]);
            
        } catch (\Exception $e) {
            // Handle any errors
            http_response_code(500);
            echo json_encode([
                'success' => false, 
                'error' => 'Failed to fetch wishlist offers: ' . $e->getMessage()
            ]);
        }
    }
}