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
use App\Exceptions\AuthenticationException;
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
        
        // Extract enterprise ID from URL
        $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $segments = explode('/', trim($urlPath, '/'));
        $enterpriseId = $segments[count($segments) - 2]; // Get the segment before "edit"

        if (strlen($enterpriseId) !== 3) {
            throw new NotFoundException("Invalid enterprise ID (enterprise ID: $enterpriseId, length: " . strlen($enterpriseId) . ")");
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
     * API endpoint to delete the specified enterprise
     * 
     * @param RequestObject $request Current request information
     * @return void Outputs JSON response
     */
    public function apiDelete(RequestObject $request): void
    {
        // Set response headers
        header('Content-Type: application/json');
        
        // Check if user is authenticated
        if (!$request->isAuthenticated()) {
            http_response_code(401);
            echo json_encode([
                'success' => false,
                'message' => 'Vous devez être connecté pour effectuer cette action',
                'redirect' => '/'
            ]);
            return;
        }
        
        // Get enterprise ID from GET parameter
        $enterpriseId = (string)($_GET['id'] ?? 0);
        
        if (strlen((string)$enterpriseId) !== 3) {
            http_response_code(400);
            echo json_encode([
            'success' => false,
            'message' => 'ID d\'entreprise invalide.'
            ]);
            return;
        }
        
        // Check if enterprise exists
        $enterprise = $this->enterpriseModel->getEnterpriseById($enterpriseId);
        
        if (!$enterprise) {
            http_response_code(404);
            echo json_encode([
                'success' => false,
                'message' => 'Entreprise introuvable'
            ]);
            return;
        }
        
        // Check if user has permission to delete the enterprise
        $isAdmin = $request->hasPermission('perm_admin');
        $isAffiliated = $this->enterpriseModel->isUserAffiliatedToEnterprise($request->userId, $enterpriseId);
        
        if (!($isAdmin || ($request->hasPermission('perm_modify_comp_info') && $isAffiliated))) {
            http_response_code(403);
            echo json_encode([
            'success' => false,
            'message' => 'Vous n\'avez pas la permission de supprimer cette entreprise'
            ]);
            return;
        }
        
        try {
            // Delete the enterprise
            $this->enterpriseModel->deleteEnterpriseById($enterpriseId);
            
            echo json_encode([
                'success' => true,
                'message' => 'Entreprise supprimée avec succès'
            ]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la suppression de l\'entreprise',
                'error' => $e->getMessage()
            ]);
        }
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
    /**
     * Show the form for creating a new enterprise
     * 
     * This method handles the display of the enterprise creation form.
     * It performs two key checks:
     * 1. Ensures the user is authenticated
     * 2. Verifies the user has permission to create enterprises
     * 
     * @param RequestObject $request Current request information
     * @return void Renders the create enterprise form
     * @throws AuthenticationException If user is not authenticated
     * @throws AuthorizationException If user lacks required permissions
     */
    public function create(RequestObject $request): void
    {
        // Redirect to login if not authenticated
        if (!$request->isAuthenticated()) {
            // Store the intended destination in session for post-login redirect
            header('Location: /login');
            exit;
        }
        
        // Check for company creation permission
        if (!$request->hasPermission('perm_company_creation')) { 
            // Throw a descriptive authorization exception
            throw new AuthorizationException(
                "Vous n'avez pas l'autorisation de créer des entreprises. " .
                "Contactez un administrateur si vous pensez que c'est une erreur."
            );
        }
        
        // Render the enterprise creation form
        echo $this->render('enterprises/create', [
            'request' => $request
        ]);
    }

    /**
     * Validate enterprise input data
     * 
     * Performs comprehensive validation on enterprise input:
     * - Validates required fields
     * - Checks field lengths
     * - Validates email and URL formats
     * - Sanitizes input to prevent XSS
     * 
     * @param array $input Raw input data from form submission
     * @return array Validated and sanitized enterprise data
     * @throws ValidationException If any validation rules are violated
     */
    private function validateEnterpriseInput(array $input): array
    {
        // Initialize error collection
        $errors = [];

        // Validate enterprise name
        $enterpriseName = trim($input['enterpriseName'] ?? '');
        if (empty($enterpriseName)) {
            $errors[] = 'Le nom de l\'entreprise est obligatoire.';
        } elseif (mb_strlen($enterpriseName) > 100) {
            $errors[] = 'Le nom de l\'entreprise ne doit pas dépasser 100 caractères.';
        }

        // Validate phone number
        $enterprisePhone = preg_replace('/\s+/', '', $input['enterprisePhone'] ?? '');
        if (empty($enterprisePhone)) {
            $errors[] = 'Le numéro de téléphone est obligatoire.';
        } elseif (!preg_match('/^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/', $enterprisePhone)) {
            $errors[] = 'Le numéro de téléphone doit être un format français valide (0X XX XX XX XX ou +33X XX XX XX XX).';
        }

        // Validate email
        $enterpriseEmail = trim($input['enterpriseEmail'] ?? '');
        if (empty($enterpriseEmail)) {
            $errors[] = 'L\'adresse email est obligatoire.';
        } elseif (!filter_var($enterpriseEmail, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'L\'adresse email n\'est pas valide.';
        }

        // Optional: Validate website URL
        $enterpriseSite = trim($input['enterpriseSite'] ?? '');
        if (!empty($enterpriseSite)) {
            // Ensure URL starts with http:// or https://
            if (!preg_match('/^https?:\/\//', $enterpriseSite)) {
                $enterpriseSite = 'https://' . $enterpriseSite;
            }

            if (!filter_var($enterpriseSite, FILTER_VALIDATE_URL)) {
                $errors[] = 'L\'URL du site web n\'est pas valide.';
            }
        }

        // Optional: Validate description URL
        $enterpriseDescriptionUrl = trim($input['enterpriseDescriptionUrl'] ?? '');

        $enterprisePhotoUrl = trim($input['enterprisePhotoUrl'] ?? '');
        // Optional: Validate photo URL
        if (!empty($enterprisePhotoUrl)) {
            // Optional: Check if URL points to an image (non-blocking)
            try {
                $headers = @get_headers($enterprisePhotoUrl, 1);
                $contentType = is_array($headers) ? ($headers['Content-Type'] ?? '') : '';
                
                if (!preg_match('/^image\/(jpeg|png|gif|webp|svg\+xml)$/', $contentType)) {
                    $errors[] = 'L\'URL de la photo doit pointer vers une image.';
                }
            } catch (\Exception $e) {
                // Silently catch any errors during image URL validation
            }
        }

        // Throw validation exception if any errors exist
        if (!empty($errors)) {
            throw new ValidationException("Validation des données de l'entreprise échouée", $errors);
        }

        // Sanitize and return validated data
        return [
            'enterpriseName' => htmlspecialchars($enterpriseName, ENT_QUOTES, 'UTF-8'),
            'enterprisePhone' => htmlspecialchars($enterprisePhone, ENT_QUOTES, 'UTF-8'),
            'enterpriseEmail' => htmlspecialchars($enterpriseEmail, ENT_QUOTES, 'UTF-8'),
            'enterpriseSite' => !empty($enterpriseSite) ? htmlspecialchars($enterpriseSite, ENT_QUOTES, 'UTF-8') : null,
            'enterpriseDescriptionUrl' => !empty($enterpriseDescriptionUrl) ? htmlspecialchars($enterpriseDescriptionUrl, ENT_QUOTES, 'UTF-8') : null,
            'enterprisePhotoUrl' => !empty($enterprisePhotoUrl) ? htmlspecialchars($enterprisePhotoUrl, ENT_QUOTES, 'UTF-8') : null
        ];
        }

        /**
        * Store a newly created enterprise
        * 
        * Handles the process of creating a new enterprise:
        * 1. Authenticates the user
        * 2. Validates input data
        * 3. Creates the enterprise
        * 4. Handles success and error scenarios
        * 
        * @param RequestObject $request Current request information
        * @return void Redirects or renders the form with errors
        * @throws AuthenticationException If user is not authenticated
        * @throws AuthorizationException If user lacks required permissions
        * @throws ValidationException If input data is invalid
        */
        public function store(RequestObject $request): void
        {
        // Ensure authentication
        if (!$request->isAuthenticated()) {
            header('Location: /login');
            exit;
        }

        // Check permission to create enterprises
        if (!$request->hasPermission('perm_company_creation')) { 
            header('Location: /login');
            exit;
        }

        try {
            // Validate and sanitize input data
            $validatedData = $this->validateEnterpriseInput($_POST);
            
            // Generate a unique enterprise ID
            do {
                $uniqueId = strtoupper(substr($validatedData['enterpriseName'], 0, 1)) . bin2hex(random_bytes(1));
                $error[''] = $uniqueId;
            } while ($this->enterpriseModel->getEnterpriseById($uniqueId));

            $validatedData['id_enterprise'] = $uniqueId;
            
            // Fallback default photo if not provided
            if (empty($validatedData['enterprisePhotoUrl'])) {
                $validatedData['enterprisePhotoUrl'] = '/assets/pp/defaultenterprise.png';
            }
            
            // Create the enterprise
            $enterpriseId = $this->enterpriseModel->createEnterprise($validatedData);
            
            // Log the creation event (optional)
            error_log("Enterprise created: {$enterpriseId} by user {$request->userId}");
            
            // Redirect to the new enterprise's details page
            header("Location: /entreprises/{$enterpriseId}");
            exit;
        } catch (ValidationException $e) {
            // Re-render the form with validation errors
            echo $this->render('enterprises/create', [
                'request' => $request,
                'error' => $e->getErrors(),
                'formData' => $_POST
            ]);
        } catch (\Exception $e) {
            // Log unexpected errors
            error_log("Enterprise creation error: " . $e->getMessage());
            
            // Render form with a generic error message
            echo $this->render('enterprises/create', [
                'request' => $request,
                'error' => [
                    'Une erreur inattendue est survenue lors de la création de l\'entreprise.',
                    'Veuillez réessayer ou contacter le support technique.'
                ],
                'formData' => $_POST
            ]);
        }
    }
}