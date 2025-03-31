<?php
/**
 * WishlistModel : Gère les offres dans la liste de souhaits d'un utilisateur.
 *
 * Fonctionnalités :
 * - Récupérer toutes les offres d'une wishlist d'un utilisateur
 * - Ajouter une offre à la wishlist
 * - Supprimer une offre de la wishlist
 */

class WishlistModel {
    private PDO $database;

    public function __construct() {
        $this->database = Database::getInstance();
    }

    /**
     * Récupère toutes les offres de la wishlist d'un utilisateur.
     * 
     * @param int $userId
     * @return array
     */
    public function getWishlistOffersFromUserId(int $userId): array {
        try {
            $query = "
                SELECT
                    Offer.id_offer AS id_offer,
                    Offer.offer_title AS offer_title,
                    Offer.offer_remuneration AS offer_remuneration,
                    Offer.offer_level AS offer_level,
                    Offer.offer_duration AS offer_duration,
                    Offer.offer_start AS offer_start,
                    Offer.offer_type AS offer_type,
                    Offer.offer_publish_date AS offer_publish_date,
                    Offer.offer_content_url AS offer_content_url,
                    Offer.offer_applicant_nb AS offer_applicant_nb,
                    Offer.id_enterprise AS id_enterprise,
                    Offer.id_city AS id_city
                FROM Wishlist
                JOIN Offer ON Wishlist.id_offer = Offer.id_offer
                WHERE Wishlist.id_user = :id_user
            ";

            $stmt = $this->database->prepare($query);
            $stmt->execute([":id_user" => $userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return [];
        }
    }

    /**
     * Ajoute une offre à la wishlist d'un utilisateur.
     * 
     * @param int $userId
     * @param int $offerId
     * @throws Exception
     */
    public function addOfferToWishlist(int $userId, int $offerId): void {
        try {
            $query = "
                INSERT INTO Wishlist (id_user, id_offer)
                VALUES (:id_user, :id_offer)
            ";

            $stmt = $this->database->prepare($query);
            $stmt->execute([
                ":id_user"  => $userId,
                ":id_offer" => $offerId
            ]);

        } catch (PDOException $e) {
            throw new Exception("Unable to add the offer to the wishlist: " . $e->getMessage());
        }
    }

    /**
     * Supprime une offre de la wishlist d'un utilisateur.
     * 
     * @param int $userId
     * @param int $offerId
     * @throws Exception
     */
    public function removeOfferFromWishlist(int $userId, int $offerId): void {
        try {
            $query = "
                DELETE FROM Wishlist
                WHERE id_user = :id_user AND id_offer = :id_offer
            ";

            $stmt = $this->database->prepare($query);
            $stmt->execute([
                ":id_user"  => $userId,
                ":id_offer" => $offerId
            ]);

        } catch (PDOException $e) {
            throw new Exception("Unable to delete the offer from your wishlist: " . $e->getMessage());
        }
    }
}

/*
// Script de test de la classe

require_once 'Database.php';


try {
    // Instanciation de la classe WishlistModel
    $wishlistModel = new WishlistModel();

    echo "==== TEST : Ajouter une offre à la wishlist ====\n";
    $userId = 1; // Remplace avec un ID utilisateur existant
    $offerId = 2; // Remplace avec un ID d'offre existant

    $wishlistModel->addOfferToWishlist($userId, $offerId);
    echo "✅ Offre ajoutée à la wishlist avec succès.\n";

    echo "==== TEST : Récupérer la wishlist de l'utilisateur ====\n";
    $wishlist = $wishlistModel->getWishlistOffersFromUserId($userId);
    
    if (!empty($wishlist)) {
        echo "✅ Offres récupérées :\n";
        print_r($wishlist);
    } else {
        echo "❌ Aucune offre trouvée dans la wishlist.\n";
    }

    echo "==== TEST : Supprimer une offre de la wishlist ====\n";
    $wishlistModel->removeOfferFromWishlist($userId, $offerId);
    echo "✅ Offre supprimée de la wishlist avec succès.\n";

} catch (Exception $e) {
    echo "❌ Erreur : " . $e->getMessage() . "\n";
}
    
*/