<?php

/*

    The OfferModel Class, with it, you can get all the offers from a specified type

    - Create / Update / destroy an Offer

*/

namespace App\Models;

use App\Services\Database;
use App\Exceptions\ModelException;
use App\Exceptions\AuthenticationException;
use PDO;
use PDOException;


class OfferModel {
    private PDO $database;

    public function __construct() {
        $this->database = Database::getInstance();
    }

    // Retrieve all offers from a specific enterprise
    public function getOffersByEnterpriseId($enterpriseId) {
        try {
            $query = "SELECT * FROM Offer WHERE id_enterprise = :id_enterprise";
            $stmt = $this->database->prepare($query);
            $stmt->execute([':id_enterprise' => $enterpriseId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new ModelException("Unable to get the offers from an enterprise: " . $e->getMessage());
        }
    }

    // Retrieve a specific offer by its ID
    public function getOfferByOfferId($offerId) {
        try {
            $query = "SELECT * FROM Offer WHERE id_offer = :id_offer";
            $stmt = $this->database->prepare($query);
            $stmt->execute([':id_offer' => $offerId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new ModelException("Unable to get the specified offer: " . $e->getMessage());
        }
    }

    // Retrieve all internship offers with pagination
    public function getAllInternshipOffers(int $page = 0 , int $itemsPerPage = 0) {
        return $this->getOffersByType(0, $page, $itemsPerPage);
    }

    // Retrieve all alternance offers with pagination
    public function getAllAlternanceOffers(int $page = 0 , int $itemsPerPage = 0) {
        return $this->getOffersByType(1, $page, $itemsPerPage);
    }

    private function getOffersByType(int $type, int $page, int $itemsPerPage) {
        try {
            $offset = ($page - 1) * $itemsPerPage;

            // Query to fetch the offers
            $query = "SELECT * FROM Offer WHERE offer_type = :offer_type LIMIT :limit OFFSET :offset";
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':offer_type', $type, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Query to count the total number of rows
            $countQuery = "SELECT COUNT(*) as total FROM Offer WHERE offer_type = :offer_type";
            $countStmt = $this->database->prepare($countQuery);
            $countStmt->bindValue(':offer_type', $type, PDO::PARAM_INT);
            $countStmt->execute();
            $totalRows = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

            return [
                'offers' => $offers,
                'totalRows' => $totalRows
            ];
        } catch (PDOException $e) {
            throw new ModelException("Unable to retrieve offers: " . $e->getMessage());
        }
    }

    // Create a new offer
    public function createOffer(array $data) {
        $requiredFields = ['offer_title', 'offer_remuneration', 'offer_level', 'offer_duration', 
                           'offer_start', 'offer_type', 'offer_content_url', 'id_enterprise', 'id_city'];

        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                throw new ModelException("Missing required field: $field");
            }
        }

        try {
            $query = "INSERT INTO Offer (offer_title, offer_remuneration, offer_level, offer_duration, 
                      offer_start, offer_type, offer_publish_date, offer_content_url, offer_applicant_nb, 
                      id_enterprise, id_city) 
                      VALUES (:offer_title, :offer_remuneration, :offer_level, :offer_duration, :offer_start, 
                      :offer_type, :offer_publish_date, :offer_content_url, :offer_applicant_nb, :id_enterprise, :id_city)";

            $stmt = $this->database->prepare($query);
            $stmt->execute([
                ':offer_title'        => $data['offer_title'],
                ':offer_remuneration' => $data['offer_remuneration'],
                ':offer_level'        => $data['offer_level'],
                ':offer_duration'     => $data['offer_duration'],
                ':offer_start'        => $data['offer_start'],
                ':offer_type'         => $data['offer_type'],
                ':offer_publish_date' => date("Y-m-d"),
                ':offer_content_url'  => $data['offer_content_url'],
                ':offer_applicant_nb' => 0,
                ':id_enterprise'      => $data['id_enterprise'],
                ':id_city'            => $data['id_city']
            ]);
            
        // Return the last inserted ID
        $id_offer = $this->database->lastInsertId();
        return $id_offer;
        
        } catch (PDOException $e) {
            throw new ModelException("Unable to create the offer: " . $e->getMessage());
        }
    }

    // Update an offer
    public function updateOffer(array $data, $offerId) {
        $existingData = $this->getOfferByOfferId($offerId);
        if (!$existingData) {
            throw new ModelException("Offer not found.");
        }

        $updatedData = array_merge($existingData, $data);

        try {
            $query = "UPDATE Offer SET offer_title = :offer_title, offer_remuneration = :offer_remuneration, 
                      offer_level = :offer_level, offer_duration = :offer_duration, offer_start = :offer_start, 
                      offer_content_url = :offer_content_url, offer_applicant_nb = :offer_applicant_nb
                      WHERE id_offer = :id_offer";

            $stmt = $this->database->prepare($query);
            $stmt->execute([
                ':offer_title'        => $updatedData['offer_title'],
                ':offer_remuneration' => $updatedData['offer_remuneration'],
                ':offer_level'        => $updatedData['offer_level'],
                ':offer_duration'     => $updatedData['offer_duration'],
                ':offer_start'        => $updatedData['offer_start'],
                ':offer_content_url'  => $updatedData['offer_content_url'],
                ':offer_applicant_nb' => $updatedData['offer_applicant_nb'],
                ':id_offer'           => $offerId
            ]);
        } catch (PDOException $e) {
            throw new ModelException("Unable to update the offer: " . $e->getMessage());
        }
    }

    // Delete an offer
    public function deleteOffer($offerId) {
        try {
            $query = "DELETE FROM Offer WHERE id_offer = :id_offer";
            $stmt = $this->database->prepare($query);
            $stmt->execute([':id_offer' => $offerId]);
        } catch (PDOException $e) {
            throw new ModelException("Unable to delete the offer: " . $e->getMessage());
        }
    }

    // Retrieve offer tags
    public function getOfferTags($offerId) {
        try {
            $query = "SELECT t.tag_name, ot.optional FROM Offer_tag ot
                      JOIN Tag t ON ot.id_tag = t.id_tag WHERE ot.id_offer = :id_offer";
            $stmt = $this->database->prepare($query);
            $stmt->execute([':id_offer' => $offerId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new ModelException("Unable to get the tags of the offer: " . $e->getMessage());
        }
    }

    // Retrieve the title of an offer by its ID
    public function getOfferTitle($offerId) {
        try {
            $query = "SELECT offer_title FROM Offer WHERE id_offer = :id_offer";
            $stmt = $this->database->prepare($query);
            $stmt->execute([':id_offer' => $offerId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['offer_title'] : null;
        } catch (PDOException $e) {
            throw new ModelException("Unable to get the offer title: " . $e->getMessage());
        }
    }

    // Retrieve the company name associated with an offer by its ID
    public function getCompanyName($offerId) {
        try {
            $query = "SELECT e.company_name FROM Enterprise e
                      JOIN Offer o ON e.id_enterprise = o.id_enterprise
                      WHERE o.id_offer = :id_offer";
            $stmt = $this->database->prepare($query);
            $stmt->execute([':id_offer' => $offerId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['company_name'] : null;
        } catch (PDOException $e) {
            throw new ModelException("Unable to get the company name: " . $e->getMessage());
        }
    }

    /**
     * Get favorite offers based on user role with associated tags
     *
     * @param int $userId Role ID of the user
     * @return array List of favorite offers with tags
     * @throws ModelException If fetching fails
     */
    public function getFavOffers(int $userId): array
    {
        try {
            // Base query for fetching offers with related data
            $query = "
                SELECT
                o.id_offer,
                o.offer_title,
                o.offer_remuneration,
                o.offer_level,
                o.offer_duration,
                o.offer_start,
                o.offer_type,
                o.offer_publish_date,
                o.id_enterprise,
                o.id_city,
                (CASE WHEN w.id_offer IS NOT NULL THEN TRUE ELSE FALSE END) as is_in_wishlist,
                (CASE WHEN o.offer_level = 'Bac+3, Bac+5' THEN TRUE ELSE FALSE END) as is_star_candidate
                FROM Offer o
                LEFT JOIN Wishlist w ON o.id_offer = w.id_offer AND w.id_user = :userId1
                JOIN User u ON u.id_user = :userId2
                WHERE u.user_stype = o.offer_type
            ";
            $query .= " ORDER BY o.offer_publish_date DESC LIMIT 6";
        
            $stmt = $this->database->prepare($query);
        
            // Bind the userId parameter twice with different parameter names
            $stmt->bindValue(':userId1', $userId, PDO::PARAM_STR);
            $stmt->bindValue(':userId2', $userId, PDO::PARAM_STR);
            $stmt->execute();
        
            $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Now fetch the tags for each offer
            foreach ($offers as &$offer) {
                $tagQuery = "
                    SELECT t.id_tag, t.tag_name, ot.optional
                    FROM Tag t
                    JOIN Offer_tag ot ON t.id_tag = ot.id_tag
                    WHERE ot.id_offer = :offerId
                    ORDER BY t.tag_name
                ";
                
                $tagStmt = $this->database->prepare($tagQuery);
                $tagStmt->bindValue(':offerId', $offer['id_offer'], PDO::PARAM_INT);
                $tagStmt->execute();
                
                $offer['tags'] = $tagStmt->fetchAll(PDO::FETCH_ASSOC);
            }
            
            return $offers;
        } catch (PDOException $e) {
            throw new ModelException("Failed to fetch favorite offers: " . $e->getMessage());
        }
    }
}