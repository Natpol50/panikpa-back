<?php

namespace App\Models;

use App\Services\Database;
use App\Exceptions\ModelException;
use PDO;
use PDOException;

/**
 * CacheModel - Database operations for cache-related data
 * 
 * Handles database operations for role permissions and other cacheable data
 */
class CacheModel
{
    private PDO $database;
    
    /**
     * Create a new CacheModel instance
     * 
     * @param Database|null $database Database service
     */
    public function __construct(?Database $database = null)
    {
        if ($database) {
            $this->database = $database->getConnection();
        } else {
            // This is a fallback, but dependency injection is preferred
            $dbInstance = new Database();
            $this->database = $dbInstance->getConnection();
        }
    }
    
    /**
     * Fetch all role names
     * 
     * @return array List of role names
     * @throws ModelException If fetch fails
     */
    public function fetchRoles(): array
    {
        try {
            $query = "SELECT acctype_name FROM Acctype";
            $stmt = $this->database->prepare($query);
            $stmt->execute();
            
            $roles = [];
            while ($role = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $roles[] = $role['acctype_name'];
            }
            
            return $roles;
        } catch (PDOException $e) {
            throw new ModelException("Failed to fetch roles: " . $e->getMessage());
        }
    }
    
    /**
     * Get permissions for a specific role
     * 
     * @param int $roleId Role ID
     * @return array Role permissions
     * @throws ModelException If role not found or fetch fails
     */
    public function getRolePermission(int $roleId): array
    {
        try {
            $query = "SELECT * FROM Acctype WHERE id_acctype = :roleId";
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':roleId', $roleId, PDO::PARAM_INT);
            $stmt->execute();
            
            $roleData = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$roleData) {
                throw new ModelException("Role with ID $roleId not found");
            }
            
            return $roleData;
        } catch (PDOException $e) {
            throw new ModelException("Failed to fetch role permissions: " . $e->getMessage());
        }
    }
    
    /**
     * Get number of applicants for an offer
     * 
     * @param int $offerId Offer ID
     * @return int Number of applicants
     * @throws ModelException If count fails
     */
    public function getNumberOfApplicants(int $offerId): int
    {
        try {
            $query = "
                SELECT COUNT(*) as applicant_count
                FROM Interaction
                WHERE id_offer = :offerId
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':offerId', $offerId, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result ? (int)$result['applicant_count'] : 0;
        } catch (PDOException $e) {
            throw new ModelException("Failed to count applicants: " . $e->getMessage());
        }
    }
    
    /**
     * Get enterprise review ratings
     * 
     * @param string $enterpriseId Enterprise ID (3-character string)
     * @return array|null Array of ratings or null if none found
     * @throws ModelException If fetch fails
     */
    public function getEnterpriseReviews(string $enterpriseId): ?array
    {
        try {
            $query = "
                SELECT grade_UE
                FROM Comment
                WHERE id_enterprise = :enterpriseId
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':enterpriseId', $enterpriseId, PDO::PARAM_STR);
            $stmt->execute();
            
            $grades = $stmt->fetchAll(PDO::FETCH_COLUMN);
            
            return !empty($grades) ? $grades : null;
        } catch (PDOException $e) {
            throw new ModelException("Failed to fetch enterprise reviews: " . $e->getMessage());
        }
    }
    
    /**
     * Get average enterprise rating
     * 
     * @param string $enterpriseId Enterprise ID (3-character string)
     * @return float|null Average rating or null if no ratings
     * @throws ModelException If calculation fails
     */
    public function getAverageEnterpriseRating(string $enterpriseId): ?array
    {
        try {
            $query = "
                SELECT AVG(grade_UE) as average_rating, COUNT(*) as comment_count
                FROM Comment
                WHERE id_enterprise = :enterpriseId
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':enterpriseId', $enterpriseId, PDO::PARAM_STR);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result) {
                return [
                    'average_rating' => $result['average_rating'] ? (float)$result['average_rating'] : null,
                    'comment_count' => (int)$result['comment_count']
                ];
            }
            
            return null;
        } catch (PDOException $e) {
            throw new ModelException("Failed to calculate average rating and comment count: " . $e->getMessage());
        }
    }

    /**
     * Get the count of applicants for a specific offer
     * 
     * @param int $offerId Offer ID
     * @return int Number of applicants
     * @throws ModelException If query fails
     */
    public function getOfferApplicantsCount(int $offerId): int
    {
        try {
            $query = "
                SELECT COUNT(*) as applicant_count
                FROM Interaction
                WHERE id_offer = :offerId
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':offerId', $offerId, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result ? (int)$result['applicant_count'] : 0;
        } catch (PDOException $e) {
            throw new ModelException("Failed to fetch offer applicants count: " . $e->getMessage());
        }
    }
    
    /**
     * Get total comment count for an enterprise
     * 
     * @param string $enterpriseId Enterprise ID
     * @return int Number of comments
     * @throws ModelException If count fails
     */
    public function getEnterpriseCommentCount(string $enterpriseId): int
    {
        try {
            $query = "
                SELECT COUNT(*) as comment_count
                FROM Comment
                WHERE id_enterprise = :enterpriseId
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':enterpriseId', $enterpriseId, PDO::PARAM_STR);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result ? (int)$result['comment_count'] : 0;
        } catch (PDOException $e) {
            throw new ModelException("Failed to count enterprise comments: " . $e->getMessage());
        }
    }
}