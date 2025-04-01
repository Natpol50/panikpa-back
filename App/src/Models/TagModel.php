<?php
namespace App\Models;

use App\Services\Database;
use App\Exceptions\ModelException;
use PDO;
use PDOException;

/**
 * TagModel - Handles tag-related database operations
 */
class TagModel
{
    private PDO $database;
    
    /**
     * Create a new TagModel instance
     */
    public function __construct()
    {
        $this->database = Database::getInstance();
    }
    
    /**
     * Get all tags
     * 
     * @return array List of all tags
     * @throws ModelException If fetching fails
     */
    public function getAllTags(): array
    {
        try {
            $query = "SELECT * FROM Tag ORDER BY tag_name";
            $stmt = $this->database->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new ModelException("Failed to fetch tags: " . $e->getMessage());
        }
    }
    
    /**
     * Add a tag by name
     * 
     * @param string $tagName Tag name
     * @return int ID of the tag
     * @throws ModelException If adding or fetching fails
     */
    public function addTag(string $tagName): int
    {
        try {
            // Normalize the tag name (e.g., trim and lowercase)
            $normalizedTagName = strtolower(trim($tagName));

            // Check for similar tags using regex
            $query = "SELECT id_tag FROM Tag WHERE tag_name REGEXP :pattern";
            $stmt = $this->database->prepare($query);
            $pattern = '^' . preg_quote($normalizedTagName, '/') . '$';
            $stmt->bindValue(':pattern', $pattern, PDO::PARAM_STR);
            $stmt->execute();

            $existingTag = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($existingTag) {
                return (int) $existingTag['id_tag'];
            }

            // Insert the new tag if it doesn't exist
            $insertQuery = "INSERT INTO Tag (tag_name) VALUES (:tagName)";
            $insertStmt = $this->database->prepare($insertQuery);
            $insertStmt->bindValue(':tagName', $normalizedTagName, PDO::PARAM_STR);
            $insertStmt->execute();

            return (int) $this->database->lastInsertId();
        } catch (PDOException $e) {
            throw new ModelException("Failed to add or fetch tag: " . $e->getMessage());
        }
    }
    /**
     * Get a tag by ID
     * 
     * @param int $tagId Tag ID
     * @return array|null Tag data or null if not found
     * @throws ModelException If fetching fails
     */
    public function getTagById(int $tagId): ?array
    {
        try {
            $query = "SELECT * FROM Tag WHERE id_tag = :tagId";
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':tagId', $tagId, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (PDOException $e) {
            throw new ModelException("Failed to fetch tag: " . $e->getMessage());
        }
    }
    
    /**
     * Get tags for a specific offer
     * 
     * @param int $offerId Offer ID
     * @return array Tags associated with the offer
     * @throws ModelException If fetching fails
     */
    public function getTagsByOfferId(int $offerId): array
    {
        try {
            $query = "
                SELECT t.id_tag, t.tag_name, ot.optional 
                FROM Tag t
                JOIN Offer_tag ot ON t.id_tag = ot.id_tag
                WHERE ot.id_offer = :offerId
                ORDER BY t.tag_name
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':offerId', $offerId, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new ModelException("Failed to fetch offer tags: " . $e->getMessage());
        }
    }
    
    /**
     * Add a tag to an offer
     * 
     * @param int $offerId Offer ID
     * @param int $tagId Tag ID
     * @param bool $optional Whether the tag is optional
     * @return bool Success status
     * @throws ModelException If adding fails
     */
    public function addTagToOffer(int $offerId, int $tagId, bool $optional = false): bool
    {
        try {
            $query = "
                INSERT INTO Offer_tag (id_offer, id_tag, optional)
                VALUES (:offerId, :tagId, :optional)
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':offerId', $offerId, PDO::PARAM_INT);
            $stmt->bindValue(':tagId', $tagId, PDO::PARAM_INT);
            $stmt->bindValue(':optional', $optional, PDO::PARAM_BOOL);
            $stmt->execute();
            
            return true;
        } catch (PDOException $e) {
            throw new ModelException("Failed to add tag to offer: " . $e->getMessage());
        }
    }
    
    /**
     * Remove a tag from an offer
     * 
     * @param int $offerId Offer ID
     * @param int $tagId Tag ID
     * @return bool Success status
     * @throws ModelException If removing fails
     */
    public function removeTagFromOffer(int $offerId, int $tagId): bool
    {
        try {
            $query = "
                DELETE FROM Offer_tag 
                WHERE id_offer = :offerId AND id_tag = :tagId
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':offerId', $offerId, PDO::PARAM_INT);
            $stmt->bindValue(':tagId', $tagId, PDO::PARAM_INT);
            $stmt->execute();
            
            return true;
        } catch (PDOException $e) {
            throw new ModelException("Failed to remove tag from offer: " . $e->getMessage());
        }
    }
    
    /**
     * Get tags for a specific user
     * 
     * @param string $userId User ID
     * @return array Tags associated with the user
     * @throws ModelException If fetching fails
     */
    public function getTagsByUserId(string $userId): array
    {
        try {
            $query = "
                SELECT t.id_tag, t.tag_name
                FROM Tag t
                JOIN User_tag ut ON t.id_tag = ut.id_tag
                WHERE ut.id_user = :userId
                ORDER BY t.tag_name
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_STR);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new ModelException("Failed to fetch user tags: " . $e->getMessage());
        }
    }
}