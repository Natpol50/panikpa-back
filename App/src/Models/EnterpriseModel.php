<?php

namespace App\Models;

use App\Services\Database;
use App\Exceptions\ModelException;
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
     * @return int ID of the created enterprise
     * @throws ModelException If creation fails or required fields are missing
     */
    public function createEnterprise(array $data): int
    {
        // Validate required fields
        if (empty($data["enterpriseName"]) || 
            empty($data["enterprisePhone"]) || 
            empty($data["enterpriseEmail"])) {
            throw new ModelException("Missing required fields for enterprise creation");
        }
        
        // Set default values for optional fields
        $descriptionUrl = $data["enterpriseDescriptionUrl"] ?? "";
        $photoUrl = $data["enterprisePhotoUrl"] ?? "";
        $site = $data["enterpriseSite"] ?? "";
        
        try {
            $query = "
                INSERT INTO Enterprise(
                    enterprise_name, 
                    enterprise_phone, 
                    enterprise_description_url, 
                    enterprise_email, 
                    enterprise_photo_url, 
                    enterprise_site
                ) VALUES (
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
                ":enterpriseName" => $data["enterpriseName"],
                ":enterprisePhone" => $data["enterprisePhone"],
                ":enterpriseDescriptionUrl" => $descriptionUrl,
                ":enterpriseEmail" => $data["enterpriseEmail"],
                ":enterprisePhotoUrl" => $photoUrl,
                ":enterpriseSite" => $site
            ]);
            
            return (int)$this->database->lastInsertId();
        } catch (PDOException $e) {
            throw new ModelException("Failed to create enterprise: " . $e->getMessage());
        }
    }
    
    /**
     * Get enterprise by ID
     * 
     * @param int $enterpriseId ID of the enterprise
     * @return array|null Enterprise data or null if not found
     * @throws ModelException If retrieval fails
     */
    public function getEnterpriseById(int $enterpriseId): ?array
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
     * Search enterprises by criteria
     * 
     * @param array $criteria Search criteria
     * @param int $limit Maximum number of results
     * @param int $offset Starting position for pagination
     * @return array Matching enterprises
     * @throws ModelException If search fails
     */
    public function searchEnterprises(array $criteria, int $limit = 10, int $offset = 0): array
    {
        try {
            $query = "SELECT * FROM Enterprise WHERE 1=1";
            $params = [];
            
            // Add search criteria
            if (!empty($criteria['name'])) {
                $query .= " AND enterprise_name LIKE :name";
                $params[':name'] = '%' . $criteria['name'] . '%';
            }
            
            if (!empty($criteria['email'])) {
                $query .= " AND enterprise_email LIKE :email";
                $params[':email'] = '%' . $criteria['email'] . '%';
            }
            
            // Add pagination
            $query .= " LIMIT :limit OFFSET :offset";
            $params[':limit'] = $limit;
            $params[':offset'] = $offset;
            
            $stmt = $this->database->prepare($query);
            
            // Bind all parameters
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
            }
            
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new ModelException("Failed to search enterprises: " . $e->getMessage());
        }
    }
    
    /**
     * Update an enterprise
     * 
     * @param int $enterpriseId ID of the enterprise
     * @param array $data New enterprise data
     * @return bool Success status
     * @throws ModelException If update fails
     */
    public function updateEnterprise(int $enterpriseId, array $data): bool
    {
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
     * @param int $enterpriseId ID of the enterprise
     * @return bool Success status
     * @throws ModelException If deletion fails
     */
    public function deleteEnterprise(int $enterpriseId): bool
    {
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
     * @param int $enterpriseId ID of the enterprise
     * @return float|null Average rating or null if no ratings
     * @throws ModelException If rating retrieval fails
     */
    public function getAverageRating(int $enterpriseId): ?float
    {
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
     * @param int $enterpriseId ID of the enterprise
     * @return int Number of applications
     * @throws ModelException If count fails
     */
    public function countApplications(int $enterpriseId): int
    {
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
}