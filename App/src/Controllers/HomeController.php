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
use PDO;

/**
 * HomeController - Handles home page and API endpoints for updates and offers
 */
class HomeController extends BaseController
{
    private PDO $database;
    private InteractionModel $interactionModel;
    private OfferModel $offerModel;
    private UserModel $userModel;
    private EnterpriseModel $enterpriseModel;
    private CityModel $cityModel;
    private TagModel $tagModel;

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
    }

    /**
     * Render the home page
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function index(RequestObject $request): void
    {
        // Render the home page template
        echo $this->render('home/index', [
            'request' => $request
        ]);
    }

    /**
     * API endpoint to fetch user updates
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function apiUpdates(RequestObject $request): void
    {
        // Set response header to JSON
        header('Content-Type: application/json');
        
        // Ensure only authenticated users can access
        if (!$request->isAuthenticated() or $request->userSType == null) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }

        try {
            // Fetch latest interactions for the user
            $updates = $this->interactionModel->getLatestInteractionsByUserId($request->userId);

            // Transform interactions into a more frontend-friendly format
            $formattedUpdates = [];
            
            foreach ($updates as $interaction) {
                $offer = $this->offerModel->getOfferByOfferId($interaction['id_offer']);
                if (!$offer) continue;
                
                $enterprise = $this->enterpriseModel->getEnterpriseById($offer['id_enterprise']);
                
                $formattedUpdates[] = [
                    'id' => $interaction['id_offer'],
                    'title' => $offer['offer_title'],
                    'company' => $enterprise ? $enterprise['enterprise_name'] : 'Unknown Company',
                    'timestamp' => $this->getTimestampText($interaction['interaction_followup_date'] ?? $interaction['interaction_first_date']),
                    'status' => $this->determineInteractionStatus($interaction),
                    'statusClass' => $this->getStatusClass($interaction),
                    'followupInterviewDate' => isset($interaction['interaction_followup_interview_date']) 
                        ? date('d/m/Y', strtotime($interaction['interaction_followup_interview_date'])) 
                        : null
                ];
            }

            // Send JSON response
            echo json_encode([
                'success' => true,
                'updates' => $formattedUpdates
            ]);
        } catch (\Exception $e) {
            // Handle any errors
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => 'Failed to fetch updates: ' . $e->getMessage()]);
        }
    }

    /**
     * API endpoint to fetch featured offers with their tags
     *
     * @param RequestObject $request Current request information
     * @return void
     */
    public function apiFavoriteOffers(RequestObject $request): void
    {
        // Set response header to JSON
        header('Content-Type: application/json');
    
        try {
            // Default role for non-authenticated users
            $userId = null;
            
            // Ensure only authenticated users can access
            if (!$request->isAuthenticated() or $request->userSType == null) {
                http_response_code(401);
                echo json_encode(['error' => 'Unauthorized']);
                return;
            } else {
                $userId = $request->userId;
            }
        
            // Fetch offers matching user type
            $offers = $this->offerModel->getFavOffers($userId);
            
            // Transform offers into the required format
            $formattedOffers = [];
        
            foreach ($offers as $offer) {
                // Fetch enterprise details
                $enterprise = $this->enterpriseModel->getEnterpriseById($offer['id_enterprise']);
            
                // Fetch city details
                $city = $this->cityModel->getCityById($offer['id_city']);
            
                // Get all tags from the offer (now included in the offer data)
                $offerTags = $offer['tags'] ?? [];
                
                // Format tags for display
                $formattedTags = [];
                foreach ($offerTags as $tag) {
                    $formattedTags[] = [
                        'name' => $tag['tag_name'],
                        'optional' => (bool)$tag['optional']
                    ];
                }
            
                $formattedOffer = [
                    'id' => $offer['id_offer'],
                    'title' => $offer['offer_title'],
                    'company' => $enterprise ? $enterprise['enterprise_name'] : 'Unknown Company',
                    'location' => $city ? $city['city_name'] . ' - ' . $city['city_postal'] : 'Unknown Location',
                    'reference' => $offer['id_enterprise'] . $offer['id_offer'],
                    'duration' => $offer['offer_duration'],
                    'level' => $offer['offer_level'],
                    'startDate' => date('d/m/Y', strtotime($offer['offer_start'])),
                    'remuneration' => $offer['offer_remuneration'],
                    'highlighted' => $offer['is_star_candidate'] ? true : false,
                    'wishlisted' => $offer['is_in_wishlist'] ? true : false,
                    'tags' => $formattedTags  // Include all tags in the response
                ];
            
                $formattedOffers[] = $formattedOffer;
            }
            
            // Send JSON response
            echo json_encode([
                'success' => true,
                'offers' => $formattedOffers
            ]);
        } catch (\Exception $e) {
            // Handle any errors
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => 'Failed to fetch offers: ' . $e->getMessage()]);
        }
    }

    /**
     * Format a timestamp into a human-readable string
     * 
     * @param string $date Date string
     * @return string Formatted time string (e.g., "Il y a 2 heures")
     */
    private function getTimestampText(string $date): string
    {
        $timestamp = strtotime($date);
        $now = time();
        $diff = $now - $timestamp;
        
        if ($diff < 60) {
            return "À l'instant";
        } elseif ($diff < 3600) {
            $minutes = floor($diff / 60);
            return "Il y a " . $minutes . " minute" . ($minutes > 1 ? 's' : '');
        } elseif ($diff < 86400) {
            $hours = floor($diff / 3600);
            return "Il y a " . $hours . " heure" . ($hours > 1 ? 's' : '');
        } elseif ($diff < 2592000) {
            $days = floor($diff / 86400);
            return "Il y a " . $days . " jour" . ($days > 1 ? 's' : '');
        } else {
            $months = floor($diff / 2592000);
            return "Il y a " . $months . " mois";
        }
    }

    /**
     * Determine interaction status based on interaction data
     * 
     * @param array $interaction Interaction data
     * @return string Status description
     */
    private function determineInteractionStatus(array $interaction): string
    {
        if ($interaction['interaction_followup_reply_type'] !== null) {
            return $interaction['interaction_followup_reply_type'] ? 'Accepté' : 'Refusé';
        }
        
        if ($interaction['interaction_followup_interview_date']) {
            return 'Entretien';
        }
        
        if ($interaction['interaction_followup_date']) {
            return 'Retour';
        }
        
        return 'En cours';
    }
    
    /**
     * Get CSS class for status display
     * 
     * @param array $interaction Interaction data
     * @return string CSS class name
     */
    private function getStatusClass(array $interaction): string
    {
        if ($interaction['interaction_followup_reply_type'] !== null) {
            return $interaction['interaction_followup_reply_type'] ? 'tag' : 'tag_negative';
        }
        
        if ($interaction['interaction_followup_interview_date']) {
            return 'tag';
        }
        
        if ($interaction['interaction_followup_date']) {
            return 'tag';
        }
        
        return 'tag';
    }
}