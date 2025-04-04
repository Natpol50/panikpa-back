<?php

namespace App\Controllers;

use App\Core\RequestObject;
use App\Models\InteractionModel;
use App\Models\OfferModel;
use App\Models\TagModel;
use App\Exceptions\FileSystemException;
use App\Exceptions\ValidationException;
use App\Exceptions\AuthorizationException;

/**
 * ApplicationController - Handles job applications
 */
class ApplicationController extends BaseController
{
    private InteractionModel $interactionModel;
    private OfferModel $offerModel;
    private TagModel $tagModel;
    
    /**
     * Create a new ApplicationController instance
     */
    public function __construct()
    {
        $this->interactionModel = new InteractionModel();
        $this->offerModel = new OfferModel();
        $this->tagModel = new TagModel();
    }
    
    /**
     * Display the application form
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function form(RequestObject $request): void
    {
        // Redirect to login if not authenticated
        if (!$request->isAuthenticated()) {
            header('Location: /login');
            exit;
        }
    
        // Check permission to apply
        if (!$request->hasPermission('perm_offer_apply')) {
            header('Location: /');
            exit;
        }
    
        // Get offer ID from request
        $offerId = (int)($_GET['offerId'] ?? 0);
    
        // Fetch offer details
        $offer = $this->offerModel->getOfferByOfferId($offerId);
    
        if (!$offer) {
            header('Location: /');
            exit;
        }
    
        // Fetch offer tags from TagModel
        $offerTags = $this->tagModel->getTagsByOfferId($offerId);
    
        // Render the form view with offer details
        echo $this->render('application/form', [
            'request' => $request,
            'offerId' => $offerId,
            'offerName' => $offer['offer_title'] ?? '',
            'enterpriseId' => $offer['id_enterprise'] ?? 0,
            'offerTags' => $offerTags,
            'offerDuration' => $offer['offer_duration'] ?? ''
        ]);
    }
    
    
    /**
     * Process the application submission
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function submit(RequestObject $request): void
    {
        // Set response header for AJAX requests
        header('Content-Type: application/json');
        
        // Check if user is authenticated
        if (!$request->isAuthenticated()) {
            http_response_code(401);
            echo json_encode([
                'success' => false,
                'message' => 'You must be logged in to apply'
            ]);
            return;
        }
        
        // Check permission to apply
        if (!$request->hasPermission('perm_offer_apply')) {
            http_response_code(403);
            echo json_encode([
                'success' => false,
                'message' => 'You do not have permission to apply for jobs'
            ]);
            return;
        }
        
        try {
            // Get form data
            $offerId = (int)($_POST['offerId'] ?? 0);
            $motivation = trim($_POST['motivation'] ?? '');
            
            // Validate offer ID
            if ($offerId <= 0) {
                throw new ValidationException("Invalid offer ID");
            }
            
            // Check if offer exists
            $offer = $this->offerModel->getOfferByOfferId($offerId);
            if (!$offer) {
                throw new ValidationException("Offer not found");
            }
            
            // Validate motivation text
            if (empty($motivation)) {
                throw new ValidationException("Cover letter is required");
            }
            
            // Validate file upload
            if (!isset($_FILES['cv']) || $_FILES['cv']['error'] !== UPLOAD_ERR_OK) {
                throw new ValidationException("CV file is required");
            }
            
            // Check file type
            $fileType = mime_content_type($_FILES['cv']['tmp_name']);
            if ($fileType !== 'application/pdf') {
                throw new ValidationException("Only PDF files are allowed");
            }
            
            // Check file size (2MB max)
            $maxSize = 2 * 1024 * 1024; // 2MB in bytes
            if ($_FILES['cv']['size'] > $maxSize) {
                throw new ValidationException("File size exceeds the maximum limit of 2MB");
            }
            
            // Create directory if it doesn't exist
            $uploadDir = dirname(__DIR__, 2) . '/assets/cv/';
            if (!is_dir($uploadDir)) {
                if (!mkdir($uploadDir, 0755, true)) {
                    throw new FileSystemException("Failed to create upload directory");
                }
            }
            
            // Generate filename based on user, enterprise, and offer IDs
            $userId = $request->userId;
            $enterpriseId = $offer['id_enterprise'];
            $fileName = $userId . $enterpriseId . $offerId . '.pdf';
            $filePath = $uploadDir . $fileName;
            
            // Move uploaded file
            if (!move_uploaded_file($_FILES['cv']['tmp_name'], $filePath)) {
                throw new FileSystemException("Failed to save the uploaded file");
            }
            
            // Create interaction record
            $interactionData = [
                'id_offer' => $offerId,
                'id_user' => $userId,
                'interaction_cv_url' => '/assets/cv/' . $fileName,
                'interaction_cover_letter_url' => $motivation // Store the actual cover letter text
            ];
            
            // Check if user has already applied to this offer
            $existingApplications = $this->interactionModel->getInteractionByUserId($userId);
            $hasApplied = false;
            
            foreach ($existingApplications as $application) {
                if ((int)$application['id_offer'] === $offerId) {
                    $hasApplied = true;
                    break;
                }
            }
            
            if ($hasApplied) {
                // If already applied, return success but inform the user
                echo json_encode([
                    'success' => true,
                    'message' => 'You have already applied to this offer'
                ]);
                return;
            }
            
            // Save the interaction
            $this->interactionModel->createInteraction($interactionData);
            
            // Return success response
            echo json_encode([
                'success' => true,
                'message' => 'Your application has been submitted successfully'
            ]);
            
        } catch (ValidationException $e) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        } catch (FileSystemException $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Error processing file: ' . $e->getMessage()
            ]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display user's applications
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function viewApplications(RequestObject $request): void
    {
        // Redirect to login if not authenticated
        if (!$request->isAuthenticated()) {
            header('Location: /login');
            exit;
        }
        
        try {
            // Get user's applications
            $applications = $this->interactionModel->getInteractionByUserId($request->userId);
            
            // Format applications with offer details
            $formattedApplications = [];
            
            foreach ($applications as $application) {
                $offer = $this->offerModel->getOfferByOfferId($application['id_offer']);
                
                if ($offer) {
                    $formattedApplications[] = [
                        'interaction' => $application,
                        'offer' => $offer
                    ];
                }
            }
            
            // Render the applications view
            echo $this->render('application/list', [
                'request' => $request,
                'applications' => $formattedApplications
            ]);
            
        } catch (\Exception $e) {
            // Handle errors
            echo $this->render('application/list', [
                'request' => $request,
                'applications' => [],
                'error' => $e->getMessage()
            ]);
        }
    }
}