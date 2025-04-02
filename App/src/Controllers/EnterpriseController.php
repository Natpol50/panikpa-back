<?php

namespace App\Controllers;

use App\Services\Database;
use App\Models\EnterpriseModel;
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
    
    /**
     * Create a new EnterpriseController instance
     */
    public function __construct()
    {
        // Initialize database connection
        $database = new Database();
        
        // Initialize enterprise model
        $this->enterpriseModel = new EnterpriseModel();
    }
    
    /**
     * Display a listing of enterprises
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
     * Display the specified enterprise
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function show(RequestObject $request): void
    {
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
        
        // Get average rating
        $averageRating = $this->enterpriseModel->getAverageRating($enterpriseId);
        
        // Get application count
        $applicationCount = $this->enterpriseModel->countApplications($enterpriseId);
        
        // Load the view with the data
        echo $this->render('enterprises/show', [
            'enterprise' => $enterprise,
            'averageRating' => $averageRating,
            'applicationCount' => $applicationCount,
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
        if (!$request->hasPermission(4)) { // Assuming 4 is the permission bit for enterprise creation
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
        if (!$request->hasPermission(4)) { // Assuming 4 is the permission bit for enterprise creation
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
        if (!$request->hasPermission(8)) { // Assuming 8 is the permission bit for enterprise editing
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
        if (!$request->hasPermission(8)) { // Assuming 8 is the permission bit for enterprise editing
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
        if (!$request->hasPermission(16)) { // Assuming 16 is the permission bit for enterprise deletion
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
        $count = $results['total_count'] ??0;
        
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
}