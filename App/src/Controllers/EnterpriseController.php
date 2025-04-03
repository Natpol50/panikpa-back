<?php

namespace App\Controllers;

use App\Services\Database;
use App\Models\EnterpriseModel;
use App\Models\OfferModel;
use App\Models\CityModel;
use App\Models\TagModel;
use App\Models\WishlistModel;
use App\Services\CacheService;
use App\Core\RequestObject;
use App\Exceptions\AuthorizationException;
use App\Exceptions\NotFoundException;
use App\Exceptions\ValidationException;

/**
 * EnterpriseController - Handles enterprise-related actions
 */
class EnterpriseController extends BaseController
{
    private EnterpriseModel $enterpriseModel;
    private OfferModel $offerModel;
    private CityModel $cityModel;
    private TagModel $tagModel;
    private WishlistModel $wishlistModel;
    private CacheService $cacheService;

    /**
     * Create a new EnterpriseController instance
     */
    public function __construct()
    {
        // Initialize database connection
        $database = new Database();

        // Initialize models and services
        $this->enterpriseModel = new EnterpriseModel();
        $this->offerModel = new OfferModel();
        $this->cityModel = new CityModel();
        $this->tagModel = new TagModel();
        $this->wishlistModel = new WishlistModel();
        $this->cacheService = new CacheService();
    }
    
    /**
     * Display a listing of enterprises
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function index(RequestObject $request): void
    {
        
        // Get query parameters
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
        
        // Get enterprises with pagination
        $enterprises = $this->enterpriseModel->getAllEnterprises($limit, $offset);
        
        // Load the view with the data
        echo $this->render('enterprises/index', [
            'enterprises' => $enterprises,
            'currentPage' => $page,
            'limit' => $limit,
            'request' => $request
        ]);
    }
    
    /**
     * Show the form for creating a new enterprise
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
        
        // Check if user has permission to create enterprises
        if (!$request->hasPermission('perm_company_creation')) {
            throw new AuthorizationException("You don't have permission to create enterprises");
        }
        
        // Load the view with the data
        echo $this->render('enterprises/create', [
            'request' => $request
        ]);
    }
    
    /**
     * Store a newly created enterprise
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
        
        // Check if user has permission to create enterprises
        if (!$request->hasPermission('perm_company_creation')) { 
            throw new AuthorizationException("You don't have permission to create enterprises");
        }
        
        // Validate input
        $data = $this->validateEnterpriseInput($_POST);
        
        // Create the enterprise
        $enterpriseId = $this->enterpriseModel->createEnterprise($data);
        
        // Redirect to the new enterprise page
        header("Location: /enterprises/{$enterpriseId}");
        exit;
    }
    
    /**
     * Show the form for editing an enterprise
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function edit(RequestObject $request): void
    {
        // Check if user is authenticated and has permission
        if (!$request->isAuthenticated()) {
            header('Location: /login');
            exit;
        }
        
        // Check if user has permission to edit enterprises
        if (!$request->hasPermission('perm_modify_comp_info')) {
            throw new AuthorizationException("You don't have permission to edit enterprises");
        }
        
        // Get enterprise ID from route parameters
        $enterpriseId = (int)($_GET['id'] ?? 0);
        
        if ($enterpriseId <= 0) {
            throw new NotFoundException("Enterprise not found");
        }
        
        // Get enterprise details
        $enterprise = $this->enterpriseModel->getEnterpriseById($enterpriseId);
        
        if (!$enterprise) {
            throw new NotFoundException("Enterprise not found");
        }
        
        // Load the view with the data
        echo $this->render('enterprises/edit', [
            'enterprise' => $enterprise,
            'request' => $request
        ]);
    }
    
    /**
     * Update the specified enterprise
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function update(RequestObject $request): void
    {
        // Check if user is authenticated and has permission
        if (!$request->isAuthenticated()) {
            header('Location: /login');
            exit;
        }
        
        // Check if user has permission to edit enterprises
        if (!$request->hasPermission('perm_modify_comp_info')) {
            throw new AuthorizationException("You don't have permission to edit enterprises");
        }
        
        // Get enterprise ID from route parameters
        $enterpriseId = (int)($_GET['id'] ?? 0);
        
        if ($enterpriseId <= 0) {
            throw new NotFoundException("Enterprise not found");
        }
        
        // Check if enterprise exists
        $enterprise = $this->enterpriseModel->getEnterpriseById($enterpriseId);
        
        if (!$enterprise) {
            throw new NotFoundException("Enterprise not found");
        }
        
        // Validate input
        $data = $this->validateEnterpriseInput($_POST);
        
        // Update the enterprise
        $this->enterpriseModel->updateEnterprise($enterpriseId, $data);
        
        // Redirect to the enterprise page
        header("Location: /enterprises/{$enterpriseId}");
        exit;
    }
    
    /**
     * Delete the specified enterprise
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function delete(RequestObject $request): void
    {
        // Check if user is authenticated and has permission
        if (!$request->isAuthenticated()) {
            header('Location: /login');
            exit;
        }
        
        // Check if user has permission to delete enterprises
        if (!$request->hasPermission('perm_modify_comp_info')) { 
            throw new AuthorizationException("You don't have permission to delete enterprises");
        }
        
        // Get enterprise ID from route parameters
        $enterpriseId = (int)($_GET['id'] ?? 0);
        
        if ($enterpriseId <= 0) {
            throw new NotFoundException("Enterprise not found");
        }
        
        // Check if enterprise exists
        $enterprise = $this->enterpriseModel->getEnterpriseById($enterpriseId);
        
        if (!$enterprise) {
            throw new NotFoundException("Enterprise not found");
        }
        
        // Delete the enterprise
        $this->enterpriseModel->deleteEnterprise($enterpriseId);
        
        // Redirect to the enterprises list
        header("Location: /enterprises");
        exit;
    }
    
    /**
     * Validate enterprise input data
     * 
     * @param array $input Raw input data
     * @return array Validated data
     * @throws ValidationException If validation fails
     */
    private function validateEnterpriseInput(array $input): array
    {
        $errors = [];
        
        // Validate enterprise name
        if (empty($input['enterpriseName'])) {
            $errors['enterpriseName'] = 'Enterprise name is required';
        } elseif (strlen($input['enterpriseName']) > 100) {
            $errors['enterpriseName'] = 'Enterprise name must be 100 characters or less';
        }
        
        // Validate enterprise phone
        if (empty($input['enterprisePhone'])) {
            $errors['enterprisePhone'] = 'Enterprise phone is required';
        } elseif (!preg_match('/^[0-9+\s()-]{10,20}$/', $input['enterprisePhone'])) {
            $errors['enterprisePhone'] = 'Invalid phone number format';
        }
        
        // Validate enterprise email
        if (empty($input['enterpriseEmail'])) {
            $errors['enterpriseEmail'] = 'Enterprise email is required';
        } elseif (!filter_var($input['enterpriseEmail'], FILTER_VALIDATE_EMAIL)) {
            $errors['enterpriseEmail'] = 'Invalid email format';
        }
        
        // If there are validation errors, throw an exception
        if (!empty($errors)) {
            throw new ValidationException("Validation failed", $errors);
        }
        
        // Return sanitized data
        return [
            'enterpriseName' => htmlspecialchars($input['enterpriseName']),
            'enterprisePhone' => htmlspecialchars($input['enterprisePhone']),
            'enterpriseEmail' => htmlspecialchars($input['enterpriseEmail']),
            'enterpriseDescriptionUrl' => isset($input['enterpriseDescriptionUrl']) ? 
                htmlspecialchars($input['enterpriseDescriptionUrl']) : '',
            'enterprisePhotoUrl' => isset($input['enterprisePhotoUrl']) ? 
                htmlspecialchars($input['enterprisePhotoUrl']) : '',
            'enterpriseSite' => isset($input['enterpriseSite']) ? 
                htmlspecialchars($input['enterpriseSite']) : ''
        ];
    }

    /**
     * API endpoint to retrieve enterprises with filtering and pagination
     *
     * @param RequestObject $request Current request information
     * @return void Outputs JSON response
     */
    public function apiList(RequestObject $request): void
    {
        // Set headers for JSON response
        header('Content-Type: application/json');
        
        // Validate and sanitize input parameters
        $query = trim($_GET['query'] ?? '');
        $pageSize = isset($_GET['pageSize']) ? max(1, min(100, (int)$_GET['pageSize'])) : 10;
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        
        // Calculate offset
        $offset = ($page - 1) * $pageSize;
        
        try {
            // Retrieve filtered and paginated enterprises
            $results = $this->enterpriseModel->searchEnterprises(
                $query,
                $pageSize,
                $offset
            );
            
            $enterprises = array_map(function ($enterprise) {
                if (empty($enterprise['enterprise_photo_url'])) {
                    $enterprise['enterprise_photo_url'] = '/assets/pp/defaultenterprise.png';
                }
                return $enterprise;
            }, $results['results'] ?? []);
            
            $count = $results['total_count'] ?? 0;
            
            // Prepare response
            $response = [
                'success' => true,
                'data' => $enterprises,
                'pagination' => [
                    'currentPage' => $page,
                    'pageSize' => $pageSize,
                    'totalEnterprises' => $count,
                    'totalPages' => ceil($count / $pageSize)
                ]
            ];
            
            // Output JSON response
            echo json_encode($response, JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            // Handle any errors
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'error' => 'Internal Server Error',
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * API endpoint to retrieve enterprises list
     * 
     * @param RequestObject $request Current request information
     * @return void Outputs JSON response
     */
    public function apiEnterpriseList(RequestObject $request): void
    {
        // Set headers for JSON response
        header('Content-Type: application/json');
        
        try {
            // Fetch all enterprises from the database
            $enterprises = $this->enterpriseModel->getAllEnterprises();
            
            // Format data to include only the fields we need
            $formattedEnterprises = array_map(function ($enterprise) {
                return [
                    'enterprise_id' => $enterprise['id_enterprise'],
                    'enterprise_name' => $enterprise['enterprise_name']
                ];
            }, $enterprises);
            
            // Return formatted JSON
            echo json_encode($formattedEnterprises);
        } catch (\Exception $e) {
            // Handle any errors
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'error' => 'Failed to fetch enterprises',
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the details of a specific enterprise
     * 
     * @param RequestObject $request Current request information
     * @return void
     * @throws NotFoundException If the enterprise is not found
     * @throws \Exception If an error occurs while fetching data
     */
    public function show(RequestObject $request): void
    {
        // Extract enterprise ID from URL
        $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $segments = explode('/', trim($urlPath, '/'));
        $enterpriseId = end($segments);

        if (strlen($enterpriseId) !== 3) {
            throw new NotFoundException("Invalid enterprise ID (enterprise ID: $enterpriseId, length: " . strlen($enterpriseId).")");
        }

        try {
            // Get enterprise details
            $enterprise = $this->enterpriseModel->getEnterpriseById($enterpriseId);

            if (!$enterprise) {
                throw new NotFoundException("Enterprise not found");
            }

            // Get associated offers
            $offers = $this->offerModel->getOffersByEnterpriseId($enterpriseId);

            // Format offers with additional data
            $formattedOffers = [];
            foreach ($offers as $offer) {
                // Get city data
                $city = $this->cityModel->getCityById($offer['id_city']);
                $cityName = $city ? $city['city_name'] . ' - ' . $city['city_postal'] : 'Unknown location';

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

                // Check if offer is in user's wishlist
                $isInWishlist = false;
                if ($request->isAuthenticated()) {
                    $isInWishlist = $this->wishlistModel->isInWishlist($request->userId, $offer['id_offer']);
                }

                // Add formatted offer
                $formattedOffers[] = [
                    'id' => $offer['id_offer'],
                    'title' => $offer['offer_title'],
                    'location' => $cityName,
                    'reference' => sprintf('%s%d', $enterprise['id_enterprise'], $offer['id_offer']),
                    'duration' => $offer['offer_duration'],
                    'level' => $offer['offer_level'],
                    'startDate' => date('d/m/Y', strtotime($offer['offer_start'])),
                    'publishDate' => date('d/m/Y', strtotime($offer['offer_publish_date'])),
                    'remuneration' => $offer['offer_remuneration'],
                    'wishlisted' => $isInWishlist,
                    'tags' => $formattedTags,
                    'highlighted' => stripos($offer['offer_level'], 'Bac+3, Bac+5') !== false
                ];
            }

            // Get average rating and count
            $ratings = $this->cacheService->getEnterpriseAverage($enterpriseId);

            // Get application count
            $applicationCount = $this->enterpriseModel->countApplications($enterpriseId);

            // Check if user has permission to edit
            $canEdit = false;
            if ($request->isAuthenticated()) {
                $canEdit = $request->hasPermission('perm_modify_comp_info');
            }

            // Check if user has permission to evaluate
            $canEvaluate = false;
            if ($request->isAuthenticated()) {
                $canEvaluate = $request->hasPermission('perm_rate_enterprise');
            }

            // Render the enterprise details view
            $this->renderView('enterprises/show', [
                'request' => $request,
                'enterprise' => $enterprise,
                'offers' => $formattedOffers,
                'ratings' => $ratings,
                'applicationCount' => $applicationCount,
                'canEdit' => $canEdit,
                'canEvaluate' => $canEvaluate
            ]);
        } catch (\Exception $e) {
            throw new \Exception("An error occurred while loading enterprise information: " . $e->getMessage());
        }
    }

    /**
     * API endpoint to evaluate an enterprise
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function apiEvaluate(RequestObject $request): void
    {
        // Set response headers
        header('Content-Type: application/json');
        
        // Check if user is authenticated
        if (!$request->isAuthenticated()) {
            http_response_code(401);
            echo json_encode([
                'success' => false,
                'message' => 'Vous devez être connecté pour évaluer une entreprise',
                'redirect' => '/login'
            ]);
            return;
        }
        
        // Check if user has permission to evaluate enterprises
        if (!$request->hasPermission('perm_rate_enterprise')) {
            http_response_code(403);
            echo json_encode([
                'success' => false,
                'message' => 'Vous n\'avez pas la permission d\'évaluer des entreprises'
            ]);
            return;
        }
        
        // Get form data
        $enterpriseId = (int)($_POST['enterpriseId'] ?? 0);
        $rating = (float)($_POST['rating'] ?? 0);
        
        // Validate enterprise ID
        if ($enterpriseId <= 0) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'ID d\'entreprise invalide'
            ]);
            return;
        }
        
        // Validate rating
        if ($rating < 1 || $rating > 5) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'La note doit être comprise entre 1 et 5'
            ]);
            return;
        }
        
        try {
            // Save rating
            $success = $this->enterpriseModel->addRating($enterpriseId, $request->userId, $rating);
            
            if ($success) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Évaluation enregistrée avec succès'
                ]);
            } else {
                throw new \Exception('Échec de l\'enregistrement de l\'évaluation');
            }
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Une erreur est survenue: ' . $e->getMessage()
            ]);
        }
    }
}