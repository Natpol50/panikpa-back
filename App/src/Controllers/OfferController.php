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
use App\Exceptions\AuthorizationException;
use App\Exceptions\NotFoundException;
use App\Exceptions\ValidationException;
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
        $query = isset($_GET['query']) ? $_GET['query'] : '';
        
        // Prepare search criteria
        $searchCriteria = [];
        if (!empty($query)) {
            $searchCriteria['query'] = $query;
        }
        
        // Fetch paginated and filtered offers directly from the database
        $result = $type === 0 
            ? $this->offerModel->getAllInternshipOffers($page, $limit, $searchCriteria) 
            : $this->offerModel->getAllAlternanceOffers($page, $limit, $searchCriteria);
        
        $offers = $result['offers'];
        $totalOffers = $result['totalRows'];
        $totalPages = ceil($totalOffers / $limit);
        
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
        
        foreach ($offers as $offer) {
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
        $error = [];
        
        if (empty($title)) {
            $error[] = 'Le titre est requis';
        }
        
        if (empty($level)) {
            $error[] = 'Le niveau d\'études est requis';
        }
        
        if (empty($duration)) {
            $error[] = 'La durée est requise';
        }
        
        if (empty($startDate)) {
            $error[] = 'La date de début est requise';
        }
        
        if (empty($description)) {
            $error[] = 'La description est requise';
        }
        
        if (empty($city)) {
            $error[] = 'La ville est requise';
        }
        
        if ($postalCode <= 0) {
            $error[] = 'Le code postal est requis';
        }
        
        // If there are validation errors, redisplay the form
        if (!empty($error)) {
            echo $this->render('offers/create', [
                'request' => $request,
                'error' => $error,
                'formData' => $_POST,
                'success' => [
                    'title' => $title,
                    'remuneration' => $remuneration,
                    'level' => $level,
                    'duration' => $duration,
                    'type' => $type,
                    'startDate' => $startDate,
                    'description' => $description,
                    'city' => $city,
                    'postalCode' => $postalCode
                ]
            ]);
            return;
        }
        
        try {
            // Get the user's enterprise
            if ($_POST['enterprise']) {
                $enterpriseId = $_POST['enterprise'];
            } else {
                $enterpriseId = $this->userModel->getEnterpriseIdByUser($request->userId)['id_enterprise'] ?? null;
            }

            // If user is not linked to an enterprise, show error
            if (!$enterpriseId) {
                echo $this->render('offers/create', [
                    'request' => $request,
                    'error' => ['Vous n\'êtes pas associé à une entreprise'],
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
                ];
                
                $cityId = $this->cityModel->addCity($cityData);
            }
            
            // Save offer content to file or database field
            $contentUrl = "$description";
            
            // Create offer data
            $offerData = [
                'offer_title' => $title,
                'offer_remuneration' => $remuneration,
                'offer_level' => $level,
                'offer_duration' => $duration,
                'offer_start' => date('Y-m-d', strtotime($startDate)),
                'offer_type' => $type,
                'offer_content' => $contentUrl,
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
                'error' => ['Erreur lors de la création de l\'offre: ' . $e->getMessage()],
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
    public function show(RequestObject $request): void
    {   
        // Extract the ID from the URL after "/offre/{3 characters to ignore}"
        $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $segments = explode('/', trim($urlPath, '/'));
        $idSegment = end($segments);

        // Remove the first 3 characters from the ID segment
        $id = (int)substr($idSegment, 3);

        if ($id <= 0) {
            // Redirect to offers page if invalid ID
            header('Location: /offres');
            exit;
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
            'description' => $offer['offer_content'],
            'tags' => $formattedTags,
            'highlighted' => stripos($offer['offer_level'], 'Bac+3, Bac+5') !== false,
            'wishlisted' => $isInWishlist,
            'hasApplied' => $hasApplied,
            'applicantsCount' => $this->cacheService->getOfferApplicantsCount($id)
        ];
        
        // Render the offer detail view
        $canEdit = false;
        if ($request->isAuthenticated()) {
            $canEdit = $this->cacheService->checkRolePermission(
            $request->userRole,
            "perm_modify_offer"
            ) && $this->userModel->isUserAffiliatedToEnterprise($request->userId, $offer['id_enterprise']);
        }

        echo $this->render('offers/show', [
            'request' => $request,
            'offer' => $formattedOffer,
            'enterprise' => $enterprise,
            'city' => $city,
            'canApply' => $canApply,
            'canEdit' => $canEdit,
        ]);
    }

    /**
     * API endpoint to retrieve existing tags for autocomplete
     * 
     * @param RequestObject $request Current request information
     * @return void Outputs JSON response
     */
    public function apiTagsList(RequestObject $request): void
    {
        // Set content type header for JSON response
        header('Content-Type: application/json');
        
        // Check if user is authenticated
        if (!$request->isAuthenticated()) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }

        try {
            // Get the query parameter for filtering tags
            $query = isset($_GET['query']) ? trim($_GET['query']) : '';

            // Get all tags or filter by query
            if (!empty($query)) {
                $tags = $this->tagModel->getTagsByQuery($query);
            } else {
                $tags = $this->tagModel->getAllTags();
            }
            
            // Format data for the autocomplete (just tag names)
            $formattedTags = array_map(function($tag) {
                return [
                    'id' => $tag['id_tag'],
                    'name' => $tag['tag_name']
                ];
            }, $tags);
            
            // Return JSON response
            echo json_encode($formattedTags);
        } catch (\Exception $e) {
            // Handle errors
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Failed to fetch tags: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * API endpoint to fetch the list of cities for autocomplete
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function apiCityList(RequestObject $request): void
    {   
        // Set response header to JSON
        header('Content-Type: application/json');

        // Check if user is authenticated
        if (!$request->isAuthenticated()) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }

        try {
            // Get the query parameter for filtering cities
            $query = isset($_GET['query']) ? trim($_GET['query']) : '';

            // Get cities from database using CityModel
            if (!empty($query)) {
                $cities = $this->cityModel->getCitiesByQuery($query);
            } else {
                $cities = $this->cityModel->getAllCities();
            }
            
            // Format city data for easier use in frontend
            $formattedCities = array_map(function($city) {
                return [
                    'id_city' => $city['id_city'],
                    'city_name' => $city['city_name'],
                    'city_postal' => $city['city_postal']
                ];
            }, $cities);
            
            // Return JSON response
            echo json_encode($formattedCities);
            
        } catch (\Exception $e) {
            // Log the error
            error_log('Error fetching cities list: ' . $e->getMessage());
            
            // Return error response
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Failed to fetch cities list: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * API endpoint to delete an offer
     * 
     * @param RequestObject $request Current request information
     * @return void Outputs JSON response
     */
    public function apiDelete(RequestObject $request): void
    {
        // Set response header to JSON
        header('Content-Type: application/json');

        // Check if user is authenticated
        if (!$request->isAuthenticated()) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }

        // Verify permission to delete offers
        $canDeleteOffer = $this->cacheService->checkRolePermission(
            $request->userRole,
            "perm_delete_offer"
        );

        if (!$canDeleteOffer) {
            http_response_code(403);
            echo json_encode(['error' => 'Forbidden']);
            return;
        }

        // Get the offer ID from the query parameter
        $offerId = isset($_GET['offerid']) ? (int)$_GET['offerid'] : 0;

        if ($offerId <= 0) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid offer ID']);
            return;
        }

        try {
            // Check if the offer exists
            $offer = $this->offerModel->getOfferByOfferId($offerId);

            if (!$offer) {
                http_response_code(404);
                echo json_encode(['error' => 'Offer not found']);
                return;
            }

            // Delete the offer
            $this->offerModel->deleteOfferById($offerId);

            // Return success response
            echo json_encode(['success' => true, 'message' => 'Offer deleted successfully']);
        } catch (\Exception $e) {
            // Handle errors
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Failed to delete offer: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the form to edit an offer
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function edit(RequestObject $request): void
    {
        // Check if user is authenticated
        if (!$request->isAuthenticated()) {
            header('Location: /login');
            exit;
        }
        
        // Verify permission to modify offers
        $canModifyOffer = $this->cacheService->checkRolePermission(
            $request->userRole,
            "perm_modify_offer"
        );
        
        if (!$canModifyOffer) {
            throw new AuthorizationException("You don't have permission to modify offers");
        }
        
        // Extract offer ID from URL
        $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $segments = explode('/', trim($urlPath, '/'));
        $offerId = end($segments);
        
        if (!is_numeric($offerId) || $offerId <= 0) {
            throw new NotFoundException("Invalid offer ID");
        }
        
        // Get offer details
        $offer = $this->offerModel->getOfferByOfferId($offerId);
        
        if (!$offer) {
            throw new NotFoundException("Offer not found");
        }
        
        // Get enterprise details
        $enterprise = $this->enterpriseModel->getEnterpriseById($offer['id_enterprise']);
        
        // Get city details
        $city = $this->cityModel->getCityById($offer['id_city']);
        
        // Get tags for this offer
        $tags = $this->tagModel->getTagsByOfferId($offerId);
        
        // Render the edit form
        echo $this->render('offers/edit', [
            'request' => $request,
            'offer' => $offer,
            'enterprise' => $enterprise,
            'city' => $city,
            'tags' => $tags
        ]);
    }

    /**
     * Process update of an offer
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function update(RequestObject $request): void
    {
        // Check if user is authenticated
        if (!$request->isAuthenticated()) {
            header('Location: /login');
            exit;
        }
        
        // Verify permission to modify offers
        $canModifyOffer = $this->cacheService->checkRolePermission(
            $request->userRole,
            "perm_modify_offer"
        );
        
        if (!$canModifyOffer) {
            throw new AuthorizationException("You don't have permission to modify offers");
        }
        
        // Get offer ID from form data
        $offerId = isset($_POST['offerId']) ? (int)$_POST['offerId'] : 0;
        
        if ($offerId <= 0) {
            throw new ValidationException("Invalid offer ID");
        }
        
        // Check if offer exists
        $existingOffer = $this->offerModel->getOfferByOfferId($offerId);
        if (!$existingOffer) {
            throw new NotFoundException("Offer not found");
        }
        
        // Validate input data
        $title = $_POST['title'] ?? '';
        $remuneration = isset($_POST['remuneration']) ? (float)$_POST['remuneration'] : 0;
        $level = $_POST['level'] ?? '';
        $duration = $_POST['duration'] ?? '';
        $startDate = $_POST['startDate'] ?? '';
        $content = $_POST['content'] ?? '';
        $enterpriseId = $_POST['enterpriseId'] ?? '';
        $cityId = isset($_POST['cityId']) ? (int)$_POST['cityId'] : 0;
        
        // Validation for required fields
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
        
        if (empty($content)) {
            $errors[] = 'La description est requise';
        }
        
        if (empty($enterpriseId)) {
            $errors[] = 'L\'entreprise est requise';
        }
        
        if ($cityId <= 0) {
            $errors[] = 'La ville est requise';
        }
        
        // If there are validation errors, re-display the form
        if (!empty($errors)) {
            $offer = $this->offerModel->getOfferByOfferId($offerId);
            $enterprise = $this->enterpriseModel->getEnterpriseById($offer['id_enterprise']);
            $city = $this->cityModel->getCityById($offer['id_city']);
            $tags = $this->tagModel->getTagsByOfferId($offerId);
            
            echo $this->render('offers/edit', [
                'request' => $request,
                'offer' => $offer,
                'enterprise' => $enterprise,
                'city' => $city,
                'tags' => $tags,
                'error' => $errors,
                'formData' => $_POST
            ]);
            return;
        }
        
        try {
            // Prepare the offer data for update
            $offerData = [
                'offer_title' => $title,
                'offer_remuneration' => $remuneration,
                'offer_level' => $level,
                'offer_duration' => $duration,
                'offer_start' => date('Y-m-d', strtotime($startDate)),
                'offer_content' => $content,
                'id_enterprise' => $enterpriseId,
                'id_city' => $cityId
            ];
            
            // Update the offer
            $this->offerModel->updateOffer($offerData, $offerId);
            
            // Process tags if any
            if (isset($_POST['tags']) && is_array($_POST['tags'])) {
                // First, remove all existing tags for this offer
                $this->tagModel->removeAllTagsFromOffer($offerId);
                
                // Then add the new tags
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
            
            // Redirect to the offer details page with success message
            header('Location: /offres/' . $enterpriseId . $offerId);
            exit;
            
        } catch (\Exception $e) {
            // If there's an error, re-display the form with error message
            $offer = $this->offerModel->getOfferByOfferId($offerId);
            $enterprise = $this->enterpriseModel->getEnterpriseById($offer['id_enterprise']);
            $city = $this->cityModel->getCityById($offer['id_city']);
            $tags = $this->tagModel->getTagsByOfferId($offerId);
            
            echo $this->render('offers/edit', [
                'request' => $request,
                'offer' => $offer,
                'enterprise' => $enterprise,
                'city' => $city,
                'tags' => $tags,
                'error' => ['Une erreur est survenue: ' . $e->getMessage()],
                'formData' => $_POST
            ]);
        }
    }
}