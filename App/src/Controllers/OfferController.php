<?php

namespace App\Controllers;

use App\Core\RequestObject;
use App\Models\EnterpriseModel;
use App\Models\CityModel;
use App\Models\TagModel;
use App\Services\Database;
use App\Models\InteractionModel;
use App\Models\OfferModel;
use App\Models\UserModel;
use App\Models\WishlistModel;
use App\Services\CacheService;
use PDO;

/**
 * OfferController - Handles offer listings and API endpoints
 */
class OfferController extends BaseController
{
    private PDO $database;
    private InteractionModel $interactionModel;
    private OfferModel $offerModel;
    private UserModel $userModel;
    private EnterpriseModel $enterpriseModel;
    private CityModel $cityModel;
    private TagModel $tagModel;
    private WishlistModel $wishlistModel;
    private CacheService $cacheService;

    /**
     * Constructor initializes dependencies
     */
    public function __construct()
    {
        $this->database = Database::getInstance();
        $this->interactionModel = new InteractionModel();
        $this->offerModel = new OfferModel();
        $this->userModel = new UserModel();
        $this->enterpriseModel = new EnterpriseModel();
        $this->cityModel = new CityModel();
        $this->tagModel = new TagModel();
        $this->wishlistModel = new WishlistModel();
        $this->cacheService = new CacheService();
    }

    /**
     * Display offer type selection page
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function index(RequestObject $request): void
    {
        // Render the offers selection page
        echo $this->render('offers/index', [
            'request' => $request
        ]);
    }

    /**
     * Display internship offers page
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function stages(RequestObject $request): void
    {
        // Check if user can create offers (for displaying create button)
        $canCreateOffer = false;
        
        if ($request->isAuthenticated()) {
            $canCreateOffer = $this->cacheService->checkRolePermission(
                $request->userRole, 
                "perm_create_offer"
            );
        }
        
        // Render the internships page with offer type = 0
        echo $this->render('offers/stages', [
            'request' => $request,
            'offerType' => 0,
            'pageTitle' => 'Stages',
            'canCreateOffer' => $canCreateOffer
        ]);
    }

    /**
     * Display traineeship/alternance offers page
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function alternances(RequestObject $request): void
    {
        // Check if user can create offers (for displaying create button)
        $canCreateOffer = false;
        
        if ($request->isAuthenticated()) {
            $canCreateOffer = $this->cacheService->checkRolePermission(
                $request->userRole, 
                "perm_create_offer"
            );
        }
        
        // Render the traineeships page with offer type = 1
        echo $this->render('offers/stages', [
            'request' => $request,
            'offerType' => 1,
            'pageTitle' => 'Alternances',
            'canCreateOffer' => $canCreateOffer
        ]);
    }

    /**
     * API endpoint to fetch offers with pagination and filtering
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function apiGetOffers(RequestObject $request): void
    {
        // Set response header to JSON
        header('Content-Type: application/json');
        
        try {
            // Get query parameters
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
            $type = isset($_GET['type']) ? (int)$_GET['type'] : 0; // 0 = internship, 1 = traineeship
            $query = isset($_GET['query']) ? htmlspecialchars($_GET['query']) : '';
            
            // Calculate offset for pagination
            $offset = ($page - 1) * $limit;
            
            // Fetch offers based on type
            $offers = $type === 0 
                ? $this->offerModel->getAllInternshipOffers() 
                : $this->offerModel->getAllAlternanceOffers();
            
            // Apply search filtering if query parameter is present
            if (!empty($query)) {
                $offers = array_filter($offers, function($offer) use ($query) {
                    $searchLower = strtolower($query);
                    
                    // Get enterprise and city data for searching
                    $enterprise = $this->enterpriseModel->getEnterpriseById($offer['id_enterprise']);
                    $city = $this->cityModel->getCityById($offer['id_city']);
                    
                    // Search in multiple fields
                    return (
                        strpos(strtolower($offer['offer_title']), $searchLower) !== false ||
                        strpos(strtolower($enterprise['enterprise_name'] ?? ''), $searchLower) !== false ||
                        strpos(strtolower($city['city_name'] ?? ''), $searchLower) !== false ||
                        strpos(strtolower($offer['offer_level']), $searchLower) !== false ||
                        strpos(strtolower($offer['offer_duration']), $searchLower) !== false
                    );
                });
                
                // Re-index array after filtering
                $offers = array_values($offers);
            }
            
            // Calculate total pages
            $totalOffers = count($offers);
            $totalPages = ceil($totalOffers / $limit);
            
            // Apply pagination
            $paginatedOffers = array_slice($offers, $offset, $limit);
            
            // Get wishlist and application data if user is authenticated
            $wishlistOfferIds = [];
            $appliedOffersIds = [];
            
            if ($request->isAuthenticated()) {
                $userId = $request->userId;
                $wishlistOffers = $this->wishlistModel->getWishlistOffersFromUserId($userId);
                $wishlistOfferIds = array_column($wishlistOffers, 'id_offer');
                
                $appliedOffers = $this->interactionModel->getInteractionByUserId($userId);
                $appliedOffersIds = array_column($appliedOffers, 'id_offer');
            }
            
            // Format offer data with additional information
            $formattedOffers = [];
            
            foreach ($paginatedOffers as $offer) {
                // Set wishlist status
                $offer['wishlisted'] = in_array($offer['id_offer'], $wishlistOfferIds) ? 1 : 0;
                
                // Set applied status
                $offer['applied'] = in_array($offer['id_offer'], $appliedOffersIds) ? 1 : 0;
                
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
                    'wishlisted' => $offer['wishlisted'],
                    'applied' => $offer['applied'],
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
                'totalOffers' => $totalOffers,
                'query' => $query
            ]);
            
        } catch (\Exception $e) {
            // Handle any errors
            http_response_code(500);
            echo json_encode([
                'success' => false, 
                'error' => 'Failed to fetch offers: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display form to create a new offer
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function create(RequestObject $request): void
    {
        // Check if user is authenticated and has permission
        if (!$request->isAuthenticated()) {
            header('Location: /login');
            exit;
        }
        
        // Verify permission to create offers
        $canCreateOffer = $this->cacheService->checkRolePermission(
            $request->userRole, 
            "perm_create_offer"
        );
        
        if (!$canCreateOffer) {
            // Redirect to offers page if no permission
            header('Location: /offres');
            exit;
        }
        
        // If user has permission, render the create offer form
        echo $this->render('offers/create', [
            'request' => $request
        ]);
    }

    /**
     * Process offer creation
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function store(RequestObject $request): void
    {
        // Check if user is authenticated and has permission
        if (!$request->isAuthenticated()) {
            header('Location: /login');
            exit;
        }
        
        // Verify permission to create offers
        $canCreateOffer = $this->cacheService->checkRolePermission(
            $request->userRole, 
            "perm_create_offer"
        );
        
        if (!$canCreateOffer) {
            // Redirect to offers page if no permission
            header('Location: /offres');
            exit;
        }
        
        // Validate and process form data
        $title = $_POST['title'] ?? '';
        $remuneration = $_POST['remuneration'] ?? '0';
        $level = $_POST['level'] ?? '';
        $duration = $_POST['duration'] ?? '';
        $type = isset($_POST['type']) ? (int)$_POST['type'] : 0;
        $startDate = $_POST['startDate'] ?? '';
        $description = $_POST['description'] ?? '';
        $city = $_POST['city'] ?? '';
        $postalCode = isset($_POST['postalCode']) ? (int)$_POST['postalCode'] : 0;
        
        // Validate required fields
        $errors = [];
        
        if (empty($title)) {
            $errors[] = 'Le titre est requis';
        }
        
        if (empty($level)) {
            $errors[] = 'Le niveau d\'études est requis';
        }
        
        if (empty($duration)) {
            $errors[] = 'La durée est requise';
        }
        
        if (empty($startDate)) {
            $errors[] = 'La date de début est requise';
        }
        
        if (empty($description)) {
            $errors[] = 'La description est requise';
        }
        
        if (empty($city)) {
            $errors[] = 'La ville est requise';
        }
        
        if ($postalCode <= 0) {
            $errors[] = 'Le code postal est requis';
        }
        
        // If there are validation errors, redisplay the form
        if (!empty($errors)) {
            echo $this->render('offers/create', [
                'request' => $request,
                'errors' => $errors,
                'formData' => $_POST
            ]);
            return;
        }
        
        try {
            // Get the user's enterprise
            $enterpriseId = $this->userModel->getEnterpriseIdByUser($request->userId)['id_enterprise'] ?? null;
            
            // If user is not linked to an enterprise, show error
            if (!$enterpriseId) {
                echo $this->render('offers/create', [
                    'request' => $request,
                    'errors' => ['Vous n\'êtes pas associé à une entreprise'],
                    'formData' => $_POST
                ]);
                return;
            }
            
            // Create or get city
            $cityId = null;
            $cities = $this->cityModel->getAllCities();
            
            foreach ($cities as $cityData) {
                if ($cityData['city_name'] == $city && $cityData['city_postal'] == $postalCode) {
                    $cityId = $cityData['id_city'];
                    break;
                }
            }
            
            if (!$cityId) {
                // Create new city
                $cityData = [
                    'city_name' => $city,
                    'city_postal' => $postalCode,
                    'city_lat' => 0, // Default values
                    'city_long' => 0
                ];
                
                $cityId = $this->cityModel->addCity($cityData);
            }
            
            // Save offer content to file or database field
            $contentUrl = "Description: $description";
            
            // Create offer data
            $offerData = [
                'offer_title' => $title,
                'offer_remuneration' => $remuneration,
                'offer_level' => $level,
                'offer_duration' => $duration,
                'offer_start' => date('Y-m-d', strtotime($startDate)),
                'offer_type' => $type,
                'offer_content_url' => $contentUrl,
                'id_enterprise' => $enterpriseId,
                'id_city' => $cityId
            ];
            
            // Create the offer
            $offerId = $this->offerModel->createOffer($offerData);
            
            // Process tags if any
            if (isset($_POST['tags']) && is_array($_POST['tags'])) {
                foreach ($_POST['tags'] as $index => $tagName) {
                    if (empty($tagName)) continue;
                    
                    // Add tag
                    $tagId = $this->tagModel->addTag($tagName);
                    
                    // Check if tag is optional
                    $isOptional = isset($_POST['optional_tags'][$index]) && $_POST['optional_tags'][$index] == '1';
                    
                    // Link tag to offer
                    $this->tagModel->addTagToOffer($offerId, $tagId, $isOptional);
                }
            }
            
            // Redirect to the offer listing with success message
            $_SESSION['success'] = ['Offre créée avec succès'];
            header('Location: /offres/' . ($type == 0 ? 'stages' : 'alternances'));
            exit;
            
        } catch (\Exception $e) {
            // Handle errors
            echo $this->render('offers/create', [
                'request' => $request,
                'errors' => ['Erreur lors de la création de l\'offre: ' . $e->getMessage()],
                'formData' => $_POST
            ]);
        }
    }

    /**
     * Display a specific offer
     * 
     * @param RequestObject $request Current request information
     * @param int $id Offer ID
     * @return void
     */
    public function show(RequestObject $request, Int $id = 0): void
    {
        // Get ID from route parameter if not provided
        if ($id === 0) {
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        }
        
        if ($id <= 0) {
            // Redirect to offers page if invalid ID
            header('Location: /offres');
            exit;
        }
        
        // Get the offer
        $offer = $this->offerModel->getOfferByOfferId($id);
        
        if (!$offer) {
            // Redirect to offers page if offer not found
            header('Location: /offres');
            exit;
        }
        
        // Check if offer is in user's wishlist
        $isInWishlist = false;
        $hasApplied = false;
        
        if ($request->isAuthenticated()) {
            $wishlisted = $this->wishlistModel->isInWishlist($request->userId, $id);
            $isInWishlist = $wishlisted;
            
            // Check if user has applied
            $applications = $this->interactionModel->getInteractionByUserId($request->userId);
            $appliedOfferIds = array_column($applications, 'id_offer');
            $hasApplied = in_array($id, $appliedOfferIds);
        }
        
        // Get enterprise details
        $enterprise = $this->enterpriseModel->getEnterpriseById($offer['id_enterprise']);
        
        // Get city details
        $city = $this->cityModel->getCityById($offer['id_city']);
        
        // Get tags
        $tags = $this->tagModel->getTagsByOfferId($id);
        
        // Format tags
        $formattedTags = [];
        foreach ($tags as $tag) {
            $formattedTags[] = [
                'id' => $tag['id_tag'],
                'name' => $tag['tag_name'],
                'optional' => (bool)$tag['optional']
            ];
        }
        
        // Check permissions
        $canApply = false;
        if ($request->isAuthenticated()) {
            $canApply = $this->cacheService->checkRolePermission(
                $request->userRole,
                "perm_offer_apply"
            );
        }
        
        // Format offer for display
        $formattedOffer = [
            'id' => $offer['id_offer'],
            'title' => $offer['offer_title'],
            'company' => $enterprise ? $enterprise['enterprise_name'] : 'Unknown',
            'companyId' => $offer['id_enterprise'],
            'location' => $city ? $city['city_name'] . ' - ' . $city['city_postal'] : 'Unknown Location',
            'reference' => sprintf('%s%d', $offer['id_enterprise'], $offer['id_offer']),
            'duration' => $offer['offer_duration'],
            'level' => $offer['offer_level'],
            'startDate' => date('d/m/Y', strtotime($offer['offer_start'])),
            'publishDate' => date('d/m/Y', strtotime($offer['offer_publish_date'])),
            'remuneration' => $offer['offer_remuneration'],
            'description' => $offer['offer_content_url'],
            'tags' => $formattedTags,
            'highlighted' => stripos($offer['offer_level'], 'Bac+3, Bac+5') !== false,
            'wishlisted' => $isInWishlist,
            'hasApplied' => $hasApplied
        ];
        
        // Render the offer detail view
        echo $this->render('offers/show', [
            'request' => $request,
            'offer' => $formattedOffer,
            'enterprise' => $enterprise,
            'city' => $city,
            'canApply' => $canApply
        ]);
    }
}