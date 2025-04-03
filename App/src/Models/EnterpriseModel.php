<?php

namespace App\Models;

use App\Services\Database;
use App\Exceptions\ModelException;
use App\Services\CacheService;
use PDO;
use PDOException;

/**
 * EnterpriseModel - Enterprise data management
 * 
 * This model handles CRUD operations for enterprise entities.
 */
class EnterpriseModel
{
    private PDO $database;
    
    /**
     * Create a new EnterpriseModel instance
     * 
     * @param Database $database Database service
     */
    public function __construct()
    {
        $this->database = Database::getInstance();
    }
    
    /**
     * Create a new enterprise
     * 
     * @param array $data Enterprise data
     * @return string ID of the created enterprise
     * @throws ModelException If creation fails or required fields are missing
     */
    public function createEnterprise(array $data): string
    {
        // Validate required fields
        if (empty($data["enterpriseName"]) || 
            empty($data["enterprisePhone"]) || 
            empty($data["enterpriseEmail"]) ||
            empty($data["id_enterprise"])) {
            throw new ModelException("Missing required fields for enterprise creation");
        }
        // Set default values for optional fields
        $descriptionUrl = $data["enterpriseDescriptionUrl"] ?? "";
        $photoUrl = $data["enterprisePhotoUrl"] ?? "/assets/pp/defaultenterprise.png";
        $site = $data["enterpriseSite"] ?? "";
        
        try {
            $query = "
                INSERT INTO Enterprise(
                    id_enterprise,
                    enterprise_name, 
                    enterprise_phone, 
                    enterprise_description_url, 
                    enterprise_email, 
                    enterprise_photo_url, 
                    enterprise_site
                ) VALUES (
                    :enterpriseId,
                    :enterpriseName, 
                    :enterprisePhone, 
                    :enterpriseDescriptionUrl, 
                    :enterpriseEmail, 
                    :enterprisePhotoUrl, 
                    :enterpriseSite
                )
            ";
            
            $stmt = $this->database->prepare($query);
            
            $stmt->execute([
                ":enterpriseId" => $data["id_enterprise"],
                ":enterpriseName" => $data["enterpriseName"],
                ":enterprisePhone" => $data["enterprisePhone"],
                ":enterpriseDescriptionUrl" => $descriptionUrl,
                ":enterpriseEmail" => $data["enterpriseEmail"],
                ":enterprisePhotoUrl" => $photoUrl,
                ":enterpriseSite" => $site,
            ]);
            
            return $data["id_enterprise"];
        } catch (PDOException $e) {
            throw new ModelException("Failed to create enterprise: " . $e->getMessage());
        }
    }
    
    /**
     * Get enterprise by ID
     * 
     * @param string $enterpriseId ID of the enterprise
     * @return array|null Enterprise data or null if not found
     * @throws ModelException If retrieval fails
     */
    public function getEnterpriseById(string $enterpriseId): ?array
    {
        try {
            $query = "SELECT * FROM Enterprise WHERE id_enterprise = :enterpriseId";
            
            $stmt = $this->database->prepare($query);
            $stmt->execute([":enterpriseId" => $enterpriseId]);
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result ?: null;
        } catch (PDOException $e) {
            throw new ModelException("Failed to fetch enterprise: " . $e->getMessage());
        }
    }
    
    /**
     * Get all enterprises
     * 
     * @param int $limit Maximum number of enterprises to return (0 for all)
     * @param int $offset Starting position for pagination
     * @return array All enterprises
     * @throws ModelException If retrieval fails
     */
    public function getAllEnterprises(int $limit = 0, int $offset = 0): array
    {
        try {
            $query = "SELECT * FROM Enterprise";
            
            // Add pagination if limit is specified
            if ($limit > 0) {
                $query .= " LIMIT :limit OFFSET :offset";
            }
            
            $stmt = $this->database->prepare($query);
            
            // Bind pagination parameters if needed
            if ($limit > 0) {
                $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            }
            
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new ModelException("Failed to fetch enterprises: " . $e->getMessage());
        }
    }
    
    /**
     * Search enterprises by a single query
     * 
     * @param string $searchQuery Search query to match against multiple columns
     * @param int $limit Maximum number of results
     * @param int $offset Starting position for pagination
     * @return array Matching enterprises
     * @throws ModelException If search fails
     */
    public function searchEnterprises(string $searchQuery, int $limit = 10, int $offset = 0): array
    {
        try {
            $query = "
                SELECT 
                    SQL_CALC_FOUND_ROWS
                    id_enterprise, 
                    enterprise_name, 
                    enterprise_email, 
                    enterprise_phone, 
                    enterprise_photo_url, 
                    enterprise_site
                FROM Enterprise 
                WHERE 
                    enterprise_name LIKE :searchQueryName OR
                    enterprise_email LIKE :searchQueryEmail OR
                    enterprise_phone LIKE :searchQueryPhone OR
                    enterprise_site LIKE :searchQuerySite
                LIMIT :limit OFFSET :offset
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':searchQueryName', '%' . $searchQuery . '%', PDO::PARAM_STR);
            $stmt->bindValue(':searchQueryEmail', '%' . $searchQuery . '%', PDO::PARAM_STR);
            $stmt->bindValue(':searchQueryPhone', '%' . $searchQuery . '%', PDO::PARAM_STR);
            $stmt->bindValue(':searchQuerySite', '%' . $searchQuery . '%', PDO::PARAM_STR);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Get the total number of matching rows
            $countQuery = "SELECT FOUND_ROWS() as total_count";
            $countStmt = $this->database->query($countQuery);
            $totalCount = $countStmt->fetch(PDO::FETCH_ASSOC)['total_count'];

            return [
                'total_count' => (int)$totalCount,
                'results' => $results
            ];
        } catch (PDOException $e) {
            throw new ModelException("Failed to search enterprises: " . $e->getMessage());
        }
    }
    
    /**
     * Update an enterprise
     * 
     * @param string $enterpriseId ID of the enterprise (3 characters long)
     * @param array $data New enterprise data
     * @return bool Success status
     * @throws ModelException If update fails
     */
    public function updateEnterprise(string $enterpriseId, array $data): bool
    {
        if (strlen($enterpriseId) !== 3) {
            throw new ModelException("Invalid enterprise ID. Must be a 3-character string.");
        }

        try {
            $currentData = $this->getEnterpriseById($enterpriseId);
            
            if (!$currentData) {
                throw new ModelException("Enterprise not found");
            }
            
            // Merge the arrays to update, keeping only non-null values
            $updatedData = array_merge(
                $currentData, 
                array_filter($data, fn($value) => $value !== null)
            );
            
            $query = "
                UPDATE Enterprise SET
                    enterprise_name = :enterpriseName,
                    enterprise_phone = :enterprisePhone,
                    enterprise_description_url = :enterpriseDescriptionUrl,
                    enterprise_site = :enterpriseSite,
                    enterprise_email = :enterpriseEmail,
                    enterprise_photo_url = :enterprisePhotoUrl
                WHERE id_enterprise = :enterpriseId
            ";
            
            $stmt = $this->database->prepare($query);
            
            $stmt->execute([
                ":enterpriseName" => $updatedData["enterprise_name"],
                ":enterprisePhone" => $updatedData["enterprise_phone"],
                ":enterpriseDescriptionUrl" => $updatedData["enterprise_description_url"],
                ":enterpriseSite" => $updatedData["enterprise_site"],
                ":enterpriseEmail" => $updatedData["enterprise_email"],
                ":enterprisePhotoUrl" => $updatedData["enterprise_photo_url"],
                ":enterpriseId" => $enterpriseId
            ]);
            
            return true;
        } catch (PDOException $e) {
            throw new ModelException("Failed to update enterprise: " . $e->getMessage());
        }
    }
    
    /**
     * Delete an enterprise
     * 
     * @param string $enterpriseId ID of the enterprise (3 characters long)
     * @return bool Success status
     * @throws ModelException If deletion fails
     */
    public function deleteEnterprise(string $enterpriseId): bool
    {
        if (strlen($enterpriseId) !== 3) {
            throw new ModelException("Invalid enterprise ID. Must be a 3-character string.");
        }

        try {
            if (!$this->getEnterpriseById($enterpriseId)) {
                throw new ModelException("Enterprise does not exist");
            }
            
            $query = "DELETE FROM Enterprise WHERE id_enterprise = :enterpriseId";
            
            $stmt = $this->database->prepare($query);
            $stmt->execute([":enterpriseId" => $enterpriseId]);
            
            return true;
        } catch (PDOException $e) {
            throw new ModelException("Failed to delete enterprise: " . $e->getMessage());
        }
    }
    
    /**
     * Get average rating for an enterprise
     * 
     * @param string $enterpriseId ID of the enterprise (3 characters long)
     * @return float|null Average rating or null if no ratings
     * @throws ModelException If rating retrieval fails
     */
    public function getAverageRating(string $enterpriseId): ?float
    {
        if (strlen($enterpriseId) !== 3) {
            throw new ModelException("Invalid enterprise ID. Must be a 3-character string.");
        }

        try {
            $query = "
                SELECT AVG(grade_UE) as average_rating
                FROM Comment
                WHERE id_enterprise = :enterpriseId
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->execute([":enterpriseId" => $enterpriseId]);
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result && $result['average_rating'] ? (float)$result['average_rating'] : null;
        } catch (PDOException $e) {
            throw new ModelException("Failed to get enterprise rating: " . $e->getMessage());
        }
    }
    
    /**
     * Count applications to enterprise offers
     * 
     * @param string $enterpriseId ID of the enterprise (3 characters long)
     * @return int Number of applications
     * @throws ModelException If count fails
     */
    public function countApplications(string $enterpriseId): int
    {
        if (strlen($enterpriseId) !== 3) {
            throw new ModelException("Invalid enterprise ID. Must be a 3-character string.");
        }

        try {
            $query = "
                SELECT COUNT(*) as application_count
                FROM Interaction i
                JOIN Offer o ON i.id_offer = o.id_offer
                WHERE o.id_enterprise = :enterpriseId
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->execute([":enterpriseId" => $enterpriseId]);
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result ? (int)$result['application_count'] : 0;
        } catch (PDOException $e) {
            throw new ModelException("Failed to count enterprise applications: " . $e->getMessage());
        }
    }

    /**
     * Add or update an enterprise rating
     * 
     * @param string $enterpriseId Enterprise ID (3 characters long)
     * @param int $userId User ID
     * @param float $rating Rating value (1-5)
     * @return bool Success status
     * @throws ModelException If rating addition fails
     */
    public function addRating(string $enterpriseId, int $userId, float $rating): bool
    {
        if (strlen($enterpriseId) !== 3) {
            throw new ModelException("Invalid enterprise ID. Must be a 3-character string.");
        }

        try {
            // Check if enterprise exists
            $enterprise = $this->getEnterpriseById($enterpriseId);
            
            if (!$enterprise) {
                throw new ModelException("Enterprise not found");
            }
            
            // Validate rating
            if ($rating < 1 || $rating > 5) {
                throw new ModelException("Invalid rating value. Must be between 1 and 5");
            }
            
            // Check if user has already rated this enterprise
            $existingRating = $this->getUserRating($enterpriseId, $userId);
            
            if ($existingRating) {
                // Update existing rating
                $query = "
                    UPDATE Comment 
                    SET grade_UE = :rating, comment_date = NOW() 
                    WHERE id_enterprise = :enterpriseId AND id_user = :userId
                ";
            } else {
                // Add new rating
                $query = "
                    INSERT INTO Comment (id_user, id_enterprise, grade_UE, comment_date) 
                    VALUES (:userId, :enterpriseId, :rating, NOW())
                ";
            }
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':enterpriseId', $enterpriseId, PDO::PARAM_STR);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindValue(':rating', $rating, PDO::PARAM_STR);
            $stmt->execute();
            
            // Update cache
            $cacheService = new CacheService();
            $cacheService->updateEnterpriseAverage($enterpriseId, $rating, !$existingRating);
            
            return true;
        } catch (PDOException $e) {
            throw new ModelException("Failed to add rating: " . $e->getMessage());
        }
    }

    /**
     * Get user rating for an enterprise
     * 
     * @param string $enterpriseId Enterprise ID (3 characters long)
     * @param int $userId User ID
     * @return float|null User rating or null if not found
     * @throws ModelException If retrieval fails
     */
    public function getUserRating(string $enterpriseId, int $userId): ?float
    {
        if (strlen($enterpriseId) !== 3) {
            throw new ModelException("Invalid enterprise ID. Must be a 3-character string.");
        }

        try {
            $query = "
                SELECT grade_UE 
                FROM Comment 
                WHERE id_enterprise = :enterpriseId AND id_user = :userId
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':enterpriseId', $enterpriseId, PDO::PARAM_STR);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result ? (float)$result['grade_UE'] : null;
        } catch (PDOException $e) {
            throw new ModelException("Failed to get user rating: " . $e->getMessage());
        }
    }

    /**
     * Check if a user is affiliated with an enterprise
     * 
     * @param int $userId User ID
     * @param string $enterpriseId Enterprise ID
     * @return bool True if the user is affiliated, false otherwise
     * @throws ModelException If the check fails
     */
    public function isUserAffiliatedToEnterprise(int $userId, string $enterpriseId): bool
    {
        if (strlen($enterpriseId) !== 3) {
            throw new ModelException("Invalid enterprise ID. Must be a 3-character string.");
        }

        try {
            $query = "
            SELECT 1
            FROM User
            WHERE id_user = :userId AND id_enterprise = :enterpriseId
            LIMIT 1
            ";

            $stmt = $this->database->prepare($query);
            $stmt->execute([
            ":userId" => $userId,
            ":enterpriseId" => $enterpriseId
            ]);

            return (bool) $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new ModelException("Failed to check user affiliation: " . $e->getMessage());
        }
    }

    /**
     * Delete an enterprise and wipe its affiliations
     * 
     * @param string $enterpriseId Enterprise ID
     * @return bool Success status
     * @throws ModelException If deletion fails
     */
    public function deleteEnterpriseById(string $enterpriseId): bool
    {
        if (strlen($enterpriseId) !== 3) {
            throw new ModelException("Invalid enterprise ID. Must be a 3-character string.");
        }

        try {
            $this->database->beginTransaction();

            // Remove enterprise ID from affiliated users
            $query = "
                UPDATE User
                SET id_enterprise = NULL
                WHERE id_enterprise = :enterpriseId
            ";
            $stmt = $this->database->prepare($query);
            $stmt->execute([":enterpriseId" => $enterpriseId]);

            // Delete related comments
            $query = "
                DELETE FROM Comment
                WHERE id_enterprise IN (
                    SELECT id_enterprise FROM Offer WHERE id_enterprise = :enterpriseId
                )
            ";
            $stmt = $this->database->prepare($query);
            $stmt->execute([":enterpriseId" => $enterpriseId]);

            // Delete related interactions
            $query = "
                DELETE FROM Interaction
                WHERE id_offer IN (
                    SELECT id_offer FROM Offer WHERE id_enterprise = :enterpriseId
                )
            ";
            $stmt = $this->database->prepare($query);
            $stmt->execute([":enterpriseId" => $enterpriseId]);

            // Delete related wishlist items
            $query = "
                DELETE FROM wishlist
                WHERE id_offer IN (
                    SELECT id_offer FROM Offer WHERE id_enterprise = :enterpriseId
                )
            ";
            $stmt = $this->database->prepare($query);
            $stmt->execute([":enterpriseId" => $enterpriseId]);            

            // Delete related offer tags
            $query = "
                DELETE FROM Offer_tag
                WHERE id_offer IN (
                    SELECT id_offer FROM Offer WHERE id_enterprise = :enterpriseId
                )
            ";
            $stmt = $this->database->prepare($query);
            $stmt->execute([":enterpriseId" => $enterpriseId]);

            // Delete related offers
            $query = "
                DELETE FROM Offer
                WHERE id_enterprise = :enterpriseId
            ";
            $stmt = $this->database->prepare($query);
            $stmt->execute([":enterpriseId" => $enterpriseId]);



            // Delete the enterprise itself
            $query = "
                DELETE FROM Enterprise
                WHERE id_enterprise = :enterpriseId
            ";
            $stmt = $this->database->prepare($query);
            $stmt->execute([":enterpriseId" => $enterpriseId]);

            $this->database->commit();

            return true;
        } catch (PDOException $e) {
            $this->database->rollBack();
            throw new ModelException("Failed to delete enterprise: " . $e->getMessage());
        }
    }
}