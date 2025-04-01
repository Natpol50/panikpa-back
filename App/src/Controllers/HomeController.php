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
 * 
 * This controller is responsible for:
 * 1. Rendering the home page
 * 2. Providing API endpoints for user updates and featured offers
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
     * Returns recent interactions for the authenticated user
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function apiUpdates(RequestObject $request): void
    {
        // Ensure only authenticated users can access
        if (!$request->isAuthenticated()) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }

        try {
            // Fetch latest interactions for the user
            $updates = $this->interactionModel->getLatestInteractionsByUserId($request->userId);

            // Transform interactions into a more frontend-friendly format
            $formattedUpdates = array_map(function($interaction) {
                return [
                    'offer_title' => $this->offerModel->getOfferTitle($interaction['id_offer']),
                    'company' => $this->offerModel->getCompanyName($interaction['id_offer']),
                    'first_date' => $interaction['interaction_first_date'],
                    'followup_date' => $interaction['interaction_followup_date'],
                    'followup_interview_date' => $interaction['interaction_followup_interview_date'],
                    'reply_status' => $interaction['interaction_followup_reply_type']
                ];
            }, $updates);

            // Send JSON response
            header('Content-Type: application/json');
            echo json_encode($formattedUpdates);
        } catch (\Exception $e) {
            // Handle any errors
            http_response_code(500);
            echo json_encode(['error' => 'Failed to fetch updates']);
        }
    }

    /**
     * API endpoint to fetch featured offers
     * 
     * Returns offers based on user's preferences or a default set
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function apiFavoriteOffers(RequestObject $request): void
    {
        try {
            if (!$request->isAuthenticated()) {
                http_response_code(401);
                echo json_encode(['error' => 'Unauthorized']);
                return;
            } else {
                // Get user's role/type to match offers
                $userPermissions = $this->userModel->getUserPermission($request->userId);
                
                // Fetch offers matching user type
                $offers = $this->offerModel->getFavOffers($userPermissions['id_acctype']);
            }

            // Transform offers into the required format
            $formattedOffers = array_map(function ($offer) {
                // Fetch enterprise details
                $enterprise = $this->enterpriseModel->getEnterpriseById($offer['id_enterprise']);
                
                // Fetch city details
                $city = $this->cityModel->getCityById($offer['id_city']);
                
                // Fetch tags for the offer
                $tags = $this->tagModel->getTagsByOfferId($offer['id_offer']);
                $formattedTags = array_map(function ($tag) {
                    return [
                        'tag_name' => $tag['tag_name'],
                        'optional' => $tag['optional']
                    ];
                }, $tags);

                return [
                    'offer_type' => $offer['offer_type'],
                    'offer_name' => $offer['offer_title'],
                    'enterprise_name' => $enterprise['enterprise_name'],
                    'enterprise_id' => $offer['id_enterprise'],
                    'offer_id' => $offer['id_offer'],
                    'tags' => $formattedTags,
                    'city_name' => $city['city_name'],
                    'city_postal' => $city['city_postal'],
                    'offer_start_date' => $offer['offer_start'],
                    'offer_remuneration' => $offer['offer_remuneration'],
                    'is_in_wishlist' => $offer['is_in_wishlist'],
                    'is_star_candidate' => $offer['is_star_candidate']
                ];
            }, $offers);

            // Send JSON response
            header('Content-Type: application/json');
            echo json_encode($formattedOffers);
        } catch (\Exception $e) {
            // Handle any errors
            http_response_code(500);
            echo json_encode(['error' => 'Failed to fetch offers']);
        }
    }

    /**
     * Fetch random offers, optionally filtered by user type
     * 
     * @param int|null $userType Optional user type to filter offers
     * @return array Array of offers
     */
    private function fetchRandomOffers(?int $userSType = 0): array
    {
        try {
            // Base query to fetch random offers
            $query = "
                SELECT 
                    o.id_offer, 
                    o.offer_title, 
                    o.offer_start,
                    o.offer_remuneration,
                    e.enterprise_name,
                    o.offer_type
                FROM Offer o
                JOIN Enterprise e ON o.id_enterprise = e.id_enterprise
                WHERE o.offer_type = :offer_type
            ";

            // Add type filtering if user type is provided
            if ($userSType !== null) {
                // Mapping user types to offer types (this is a simplified example)
                // You might need to adjust this logic based on your specific requirements
                $offerTypeMap = [
                    1 => 0, // Admin might see all offer types
                    2 => 0, // Student internships
                    3 => 1, // Alternance
                    4 => 1  // Tutor might see alternance offers
                ];

                $mappedOfferType = $offerTypeMap[$userSType] ?? null;
                
                if ($mappedOfferType !== null) {
                    $query .= " WHERE o.offer_type = :offer_type";
                }
            }

            // Add randomization and limit
            $query .= " ORDER BY RAND() LIMIT 6";

            // Prepare and execute query
            $stmt = $this->database->prepare($query);
            
            if (isset($mappedOfferType)) {
                $stmt->bindValue(':offer_type', $mappedOfferType, PDO::PARAM_INT);
            }
            
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            // Log error and return empty array
            error_log('Error fetching random offers: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get offer title from offer ID
     * 
     * @param int $offerId Offer ID
     * @return string Offer title
     */
    private function getOfferTitle(int $offerId): string
    {
        try {
            $offer = $this->offerModel->getOfferByOfferId($offerId);
            return $offer['offer_title'] ?? 'Unknown Offer';
        } catch (\Exception $e) {
            return 'Unknown Offer';
        }
    }

    /**
     * Get company name for an offer
     * 
     * @param int $offerId Offer ID
     * @return string Company name
     */
    private function getCompanyName(int $offerId): string
    {
        try {
            $offer = $this->offerModel->getOfferByOfferId($offerId);
            $enterpriseId = $offer['id_enterprise'] ?? null;

            if (!$enterpriseId) {
                return 'Unknown Company';
            }

            $stmt = $this->database->prepare(
                "SELECT enterprise_name FROM Enterprise WHERE id_enterprise = :id"
            );
            $stmt->execute([':id' => $enterpriseId]);
            $enterprise = $stmt->fetch(PDO::FETCH_ASSOC);

            return $enterprise['enterprise_name'] ?? 'Unknown Company';
        } catch (\Exception $e) {
            return 'Unknown Company';
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
        // Logic to determine interaction status
        if ($interaction['interaction_followup_interview_date']) {
            return 'Interview Scheduled';
        }

        if ($interaction['interaction_followup_reply_type']) {
            return 'Positive Response';
        }

        return 'In Progress';
    }
}