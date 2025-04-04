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

    /**
     * Retrieve all internship offers with pagination and search
     * 
     * @param int $page Current page number
     * @param int $itemsPerPage Items per page
     * @param array $criteria Search criteria
     * @return array Offers and total count
     */
    public function getAllInternshipOffers(int $page = 1, int $itemsPerPage = 10, array $criteria = []): array
    {
        return $this->getOffersByType(0, $page, $itemsPerPage, $criteria);
    }

    /**
     * Retrieve all alternance offers with pagination and search
     * 
     * @param int $page Current page number
     * @param int $itemsPerPage Items per page
     * @param array $criteria Search criteria
     * @return array Offers and total count
     */
    public function getAllAlternanceOffers(int $page = 1, int $itemsPerPage = 10, array $criteria = []): array
    {
        return $this->getOffersByType(1, $page, $itemsPerPage, $criteria);
    }

    /**
     * Retrieve offers by type with pagination and search
     * 
     * @param int $type Offer type (0=internship, 1=alternance)
     * @param int $page Current page number
     * @param int $itemsPerPage Items per page
     * @param array $criteria Search criteria
     * @return array Offers and total count
     */
    private function getOffersByType(int $type, int $page, int $itemsPerPage, array $criteria = []): array
    {
        try {
            $offset = ($page - 1) * $itemsPerPage;
            
            // Build the base query
            $baseQuery = "FROM Offer o
                        LEFT JOIN Enterprise e ON o.id_enterprise = e.id_enterprise
                        LEFT JOIN City c ON o.id_city = c.id_city
                        WHERE o.offer_type = :offer_type";
            
            $params = [':offer_type' => $type];
            
            // Add search criteria if provided
            if (!empty($criteria['query'])) {
                $search = '%' . $criteria['query'] . '%';
                $baseQuery .= " AND (
                    o.offer_title LIKE :search_title OR
                    o.offer_level LIKE :search_level OR
                    o.offer_duration LIKE :search_duration OR
                    e.enterprise_name LIKE :search_enterprise OR
                    c.city_name LIKE :search_city
                )";
                $params[':search_title'] = $search;
                $params[':search_level'] = $search;
                $params[':search_duration'] = $search;
                $params[':search_enterprise'] = $search;
                $params[':search_city'] = $search;
            }
            
            // Count query for total results
            $countQuery = "SELECT COUNT(*) as total " . $baseQuery;
            $countStmt = $this->database->prepare($countQuery);
            foreach ($params as $key => $value) {
                $countStmt->bindValue($key, $value);
            }
            $countStmt->execute();
            $totalRows = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            // Data query with pagination
            $query = "SELECT o.* " . $baseQuery . " ORDER BY o.offer_publish_date DESC LIMIT :limit OFFSET :offset";
            $stmt = $this->database->prepare($query);
            
            // Bind parameters
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            
            $stmt->execute();
            $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
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
        $requiredFields = ['offer_title', 'offer_level', 'offer_duration', 
                           'offer_start', 'offer_content', 'id_enterprise', 'id_city'];

        foreach ($requiredFields as $field) {
            if (!isset($data[$field]) || $data[$field] === '') {
                throw new ModelException("Missing required field: $field");
            }
        }

        try {
            $query = "INSERT INTO Offer (offer_title, offer_remuneration, offer_level, offer_duration, 
                      offer_start, offer_type, offer_publish_date, offer_content,  
                      id_enterprise, id_city) 
                      VALUES (:offer_title, :offer_remuneration, :offer_level, :offer_duration, :offer_start, 
                      :offer_type, :offer_publish_date, :offer_content, :id_enterprise, :id_city)";

            $stmt = $this->database->prepare($query);
            $stmt->execute([
                ':offer_title'        => $data['offer_title'],
                ':offer_remuneration' => $data['offer_remuneration'] ?? 0,
                ':offer_level'        => $data['offer_level'],
                ':offer_duration'     => $data['offer_duration'],
                ':offer_start'        => $data['offer_start'],
                ':offer_type'         => $data['offer_type'] ?? 0,
                ':offer_publish_date' => date("Y-m-d"),
                ':offer_content'      => $data['offer_content'],
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

    // Delete an offer by its ID and related entries in other tables
    public function deleteOfferById($offerId) {
        try {
            $this->database->beginTransaction();

            // Delete from Interaction table
            $queryInteraction = "DELETE FROM Interaction WHERE id_offer = :id_offer";
            $stmtInteraction = $this->database->prepare($queryInteraction);
            $stmtInteraction->execute([':id_offer' => $offerId]);

            // Delete from Offer_tag table
            $queryOfferTag = "DELETE FROM Offer_tag WHERE id_offer = :id_offer";
            $stmtOfferTag = $this->database->prepare($queryOfferTag);
            $stmtOfferTag->execute([':id_offer' => $offerId]);

            // Delete from Wishlist table
            $queryWishlist = "DELETE FROM Wishlist WHERE id_offer = :id_offer";
            $stmtWishlist = $this->database->prepare($queryWishlist);
            $stmtWishlist->execute([':id_offer' => $offerId]);

            // Delete from Offer table
            $queryOffer = "DELETE FROM Offer WHERE id_offer = :id_offer";
            $stmtOffer = $this->database->prepare($queryOffer);
            $stmtOffer->execute([':id_offer' => $offerId]);

            $this->database->commit();
        } catch (PDOException $e) {
            $this->database->rollBack();
            throw new ModelException("Unable to delete the offer and its related data: " . $e->getMessage());
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
            // Base query for fetching offers with related data, excluding those in the wishlist
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
                (CASE WHEN o.offer_level = 'Bac+3, Bac+5' THEN TRUE ELSE FALSE END) as is_star_candidate
                FROM Offer o
                LEFT JOIN Wishlist w ON o.id_offer = w.id_offer AND w.id_user = :userId1
                LEFT JOIN Interaction i ON o.id_offer = i.id_offer AND i.id_user = :userId2
                JOIN User u ON u.id_user = :userId3
                WHERE u.user_stype = o.offer_type
                AND w.id_offer IS NULL
                AND i.id_offer IS NULL
            ";
            $query .= " ORDER BY o.offer_publish_date DESC LIMIT 6";
        
            $stmt = $this->database->prepare($query);
        
            // Bind the userId parameter twice with different parameter names
            $stmt->bindValue(':userId1', $userId, PDO::PARAM_STR);
            $stmt->bindValue(':userId2', $userId, PDO::PARAM_STR);
            $stmt->bindValue(':userId3', $userId, PDO::PARAM_STR);
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

    /**
     * Update an existing offer
     * 
     * @param array $data New offer data
     * @param int $offerId Offer ID to update
     * @return bool Success status
     * @throws ModelException If update fails
     */
    public function updateOffer(array $data, int $offerId): bool
    {
        try {
            // Check if offer exists
            $existingOffer = $this->getOfferByOfferId($offerId);
            if (!$existingOffer) {
                throw new ModelException("Offer with ID $offerId not found");
            }
            
            // Build update query with only fields that are provided
            $updateFields = [];
            $params = [':offerId' => $offerId];
            
            if (isset($data['offer_title'])) {
                $updateFields[] = 'offer_title = :offerTitle';
                $params[':offerTitle'] = $data['offer_title'];
            }
            
            if (isset($data['offer_remuneration'])) {
                $updateFields[] = 'offer_remuneration = :offerRemuneration';
                $params[':offerRemuneration'] = $data['offer_remuneration'];
            }
            
            if (isset($data['offer_level'])) {
                $updateFields[] = 'offer_level = :offerLevel';
                $params[':offerLevel'] = $data['offer_level'];
            }
            
            if (isset($data['offer_duration'])) {
                $updateFields[] = 'offer_duration = :offerDuration';
                $params[':offerDuration'] = $data['offer_duration'];
            }
            
            if (isset($data['offer_start'])) {
                $updateFields[] = 'offer_start = :offerStart';
                $params[':offerStart'] = $data['offer_start'];
            }
            
            if (isset($data['offer_content'])) {
                $updateFields[] = 'offer_content = :offerContent';
                $params[':offerContent'] = $data['offer_content'];
            }
            
            if (isset($data['id_enterprise'])) {
                $updateFields[] = 'id_enterprise = :enterpriseId';
                $params[':enterpriseId'] = $data['id_enterprise'];
            }
            
            if (isset($data['id_city'])) {
                $updateFields[] = 'id_city = :cityId';
                $params[':cityId'] = $data['id_city'];
            }
            
            // If no fields to update, return true (no changes needed)
            if (empty($updateFields)) {
                return true;
            }
            
            // Construct and execute the update query
            $query = "UPDATE Offer SET " . implode(', ', $updateFields) . " WHERE id_offer = :offerId";
            $stmt = $this->database->prepare($query);
            $stmt->execute($params);
            
            return true;
        } catch (PDOException $e) {
            throw new ModelException("Failed to update offer: " . $e->getMessage());
        }
    }
}