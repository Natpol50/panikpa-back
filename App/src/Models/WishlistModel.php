<?php

namespace App\Models;

use App\Services\Database;
use App\Exceptions\ModelException;
use PDO;
use PDOException;

/**
 * WishlistModel - Manage user wishlists
 * 
 * Handles operations for user wishlists (saved offers)
 */
class WishlistModel
{
    private PDO $database;
    
    /**
     * Create a new WishlistModel instance
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
     * Get all offers in a user's wishlist
     * 
     * @param int $userId User ID
     * @return array Wishlist offers
     * @throws ModelException If fetch fails
     */
    public function getWishlistOffersFromUserId(int $userId): array
    {
        try {
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
                    o.offer_content,
                    o.id_enterprise,
                    o.id_city,
                    e.enterprise_name,
                    c.city_name,
                    c.city_postal
                FROM Wishlist w
                JOIN Offer o ON w.id_offer = o.id_offer
                JOIN Enterprise e ON o.id_enterprise = e.id_enterprise
                JOIN City c ON o.id_city = c.id_city
                WHERE w.id_user = :userId
                ORDER BY o.offer_publish_date DESC
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new ModelException("Failed to get wishlist offers: " . $e->getMessage());
        }
    }
    
    /**
     * Add an offer to a user's wishlist
     * 
     * @param int $userId User ID
     * @param int $offerId Offer ID
     * @return bool Success status
     * @throws ModelException If addition fails
     */
    public function addToWishlist(int $userId, int $offerId): bool
    {
        try {
            // Check if already in wishlist
            if ($this->isInWishlist($userId, $offerId)) {
                return true; // Already in wishlist, consider it a success
            }
            
            $query = "
                INSERT INTO Wishlist (id_user, id_offer)
                VALUES (:userId, :offerId)
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindValue(':offerId', $offerId, PDO::PARAM_INT);
            $stmt->execute();
            
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * Remove an offer from a user's wishlist
     * 
     * @param int $userId User ID
     * @param int $offerId Offer ID
     * @return bool Success status
     * @throws ModelException If removal fails
     */
    public function removeFromWishlist(int $userId, int $offerId): bool
    {
        try {
            $query = "
                DELETE FROM Wishlist
                WHERE id_user = :userId AND id_offer = :offerId
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindValue(':offerId', $offerId, PDO::PARAM_INT);
            $stmt->execute();
            
            // Check if a row was affected
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * Check if an offer is in a user's wishlist
     * 
     * @param int $userId User ID
     * @param int $offerId Offer ID
     * @return bool True if in wishlist
     * @throws ModelException If check fails
     */
    public function isInWishlist(int $userId, int $offerId): bool
    {
        try {
            $query = "
                SELECT COUNT(*) as count
                FROM Wishlist
                WHERE id_user = :userId AND id_offer = :offerId
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindValue(':offerId', $offerId, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result && $result['count'] > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * Get count of offers in wishlist
     * 
     * @param int $userId User ID
     * @return int Number of offers in wishlist
     * @throws ModelException If count fails
     */
    public function getWishlistCount(int $userId): int
    {
        try {
            $query = "
                SELECT COUNT(*) as count
                FROM Wishlist
                WHERE id_user = :userId
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result ? (int)$result['count'] : 0;
        } catch (PDOException $e) {
            throw new ModelException("Failed to count wishlist items: " . $e->getMessage());
        }
    }
    
    /**
     * Clear a user's wishlist
     * 
     * @param int $userId User ID
     * @return bool Success status
     * @throws ModelException If clear fails
     */
    public function clearWishlist(int $userId): bool
    {
        try {
            $query = "DELETE FROM Wishlist WHERE id_user = :userId";
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            
            return true;
        } catch (PDOException $e) {
            throw new ModelException("Failed to clear wishlist: " . $e->getMessage());
        }
    }

    /**
     * Get wishlist offers with pagination
     * 
     * @param int $userId User ID
     * @param int $page Current page number
     * @param int $itemsPerPage Items per page
     * @return array Array containing offers and total count
     * @throws ModelException If fetch fails
     */
    public function getWishlistOffersPaginated(int $userId, int $page = 1, int $itemsPerPage = 10): array
    {
        try {
            // Calculate offset for pagination
            $offset = ($page - 1) * $itemsPerPage;
            
            // Query to count total offers in wishlist
            $countQuery = "
                SELECT COUNT(*) as total
                FROM Wishlist w
                JOIN Offer o ON w.id_offer = o.id_offer
                WHERE w.id_user = :userId
            ";
            
            $countStmt = $this->database->prepare($countQuery);
            $countStmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $countStmt->execute();
            $totalOffers = (int)$countStmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            // Query to fetch paginated offers
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
                    o.offer_content,
                    o.id_enterprise,
                    o.id_city
                FROM Wishlist w
                JOIN Offer o ON w.id_offer = o.id_offer
                JOIN Enterprise e ON o.id_enterprise = e.id_enterprise
                JOIN City c ON o.id_city = c.id_city
                WHERE w.id_user = :userId
                ORDER BY o.offer_publish_date DESC
                LIMIT :limit OFFSET :offset
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            
            $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return [
                'offers' => $offers,
                'totalOffers' => $totalOffers
            ];
        } catch (PDOException $e) {
            throw new ModelException("Failed to get wishlist offers with pagination: " . $e->getMessage());
        }
    }
}