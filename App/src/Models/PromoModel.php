<?php

/*

    The model to use the promotion Logic

*/


namespace App\Models;

use App\Services\Database;
use App\Exceptions\ModelException;
use PDO;
use PDOException;

class PromoModel
{
    private PDO $database;

    public function __construct()
    {
        $this->database = Database::getInstance();
    }


    /**
     * Retrieve all the users from a said promotion with pagination
     * 
     * @param string $promoCode pour la promotion
     * @param int $page Items per page
     * @param int $itemsPerPage the number of items wanted
     * @return array array : the content from the query
     * 
     */
    public function getUsersFromPromo(string $promoCode, int $page, int $itemsPerPage): array
    {
        try {
            $offset = ($page - 1) * $itemsPerPage;

            // Base Query
            $baseQuery = "FROM Promo LEFT JOIN User ON Promo.id_user = User.id_user WHERE Promo.promo_code = :promo_code";
            $params = [':promo_code' => $promoCode];

            // Count Query
            $countQuery = "SELECT COUNT(*) as total " . $baseQuery;
            $countStmt = $this->database->prepare($countQuery);
            $countStmt->execute($params);
            $totalRows = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

            // Data Query
            $query = "SELECT User.id_user AS id_user,
             User.user_name AS user_name,
             User.user_fname AS user_fname,
             User.user_stype AS user_stype,
             User.user_email AS user_email,
             User.user_gender AS user_gender,
             User.user_photo_url AS user_photo_url,
             User.user_phone AS user_phone,
             User.id_acctype AS id_acctype,
             User.user_creation_date AS user_creation_date
             " . $baseQuery . " ORDER BY User.user_name DESC LIMIT :limit OFFSET :offset";
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':promo_code', $promoCode, PDO::PARAM_STR);
            $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'students' => $students,
                'totalRows' => $totalRows
            ];
        } catch (PDOException $e) {
            throw new ModelException("Couldn't fetch the students " . $e->getMessage());
        }
    }

    /**
     * Get the Promotions linked to the user id
     * 
     * @param string $promoCode for the promotion
     * @param int $userId the id of the user to link
     * @return null|array|false null : The user isn't in any promotion | array : you get the array with all the promo_codes linked to the userId
     * 
     */
    public function getPromotionFromUserId(int $userId){
        try {
            $sql = "SELECT promo_code FROM Promo WHERE id_user = :id_user";
            $stmt = $this->database->prepare($sql);
            $stmt->bindValue(":id_user", $userId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            throw new ModelException("Error when trying to get the promotion linked to the user " . $e->getMessage());
        }
    }

    /**
     * Create a promotion and link the promotion to an userId, either the tutor that created it, or who the administrator choised
     * 
     * @param string $promoCode for the promotion
     * @param int $userId the id of the user to link
     * @return null|array|false null : Promo was successfully created | array : the query failed | false : the promoCode is already used
     * 
     */
    public function createPromo(string $promoCode, int $userId): bool
    {
        try {
            // Vérifier si la promo existe déjà
            $queryCheck = "SELECT 1 FROM Promo WHERE promo_code = :promo_code";
            $stmtCheck = $this->database->prepare($queryCheck);
            $stmtCheck->bindValue(":promo_code", $promoCode, PDO::PARAM_STR);
            $stmtCheck->execute();

            if ($stmtCheck->fetch()) {
                throw new ModelException("The Promo code is already used");
                return false; // Promo déjà existante
            }

            // Insérer la promo
            $sql = "INSERT INTO Promo (promo_code, id_user) VALUES (:promo_code, :id_user)";
            $stmt = $this->database->prepare($sql);
            $stmt->bindValue(":promo_code", $promoCode, PDO::PARAM_STR);
            $stmt->bindValue(":id_user", $userId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new ModelException("Error when trying to create a promotion : " . $e->getMessage());
        }
    }

    /**
     * Link a user to a promotion
     * 
     * @param string $promoCode pour la promotion
     * @param int $userId the id of the user to link
     * @return null|array|false null : User was successfully added | array : the query failed | false : the user was already in the promotion
     * 
     */
    public function linkUserPromo(string $promoCode, int $userId): bool
    {
        try {
            // Check if the user is already within the promotion
            $query = "SELECT 1 FROM Promo WHERE promo_code = :promo_code AND id_user = :id_user";
            $stmtCheck = $this->database->prepare($query);
            $stmtCheck->bindValue(":promo_code", $promoCode, PDO::PARAM_STR);
            $stmtCheck->bindValue(":id_user", $userId, PDO::PARAM_INT);
            $stmtCheck->execute();

            if ($stmtCheck->fetch()) {
                throw new ModelException("The user is already linked");
                return false; // user already linked, nothing to do
            }

            // Ajouter l'utilisateur à la promo
            $queryInsert = "INSERT INTO Promo (promo_code, id_user) VALUES (:promo_code, :id_user)";
            $stmt = $this->database->prepare($queryInsert);
            $stmt->bindValue(":promo_code", $promoCode, PDO::PARAM_STR);
            $stmt->bindValue(":id_user", $userId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new ModelException("Error when linking the user to a promotion " . $e->getMessage());
        }
    }

    /**
     * Unlink a user from a promotion
     * 
     * @param string $promoCode for the promotion
     * @param int $userId the id of the user to unlink
     * @return null|array null : the user isn't within the promo anymore | array : the query failed
     * 
     */
    public function unlinkUserPromo(string $promoCode, int $userId): bool
    {
        try {
            $sql = "DELETE FROM Promo WHERE promo_code = :promo_code AND id_user = :id_user";
            $stmt = $this->database->prepare($sql);
            $stmt->bindValue(":promo_code", $promoCode, PDO::PARAM_STR);
            $stmt->bindValue(":id_user", $userId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new ModelException("Error when unlinking the user from a promotion " . $e->getMessage());
        }
    }

    /**
     * Unlink a user from a promotion
     * 
     * @param string $promoCode for the promotion
     * @param int $userId the id of the user to unlink
     * @return null|array null : Promo was successfully deleted | array : the query failed
     * 
     */
    public function deletePromo(string $promoCode): bool
    {
        try {
            $sql = "DELETE FROM Promo WHERE promo_code = :promo_code";
            $stmt = $this->database->prepare($sql);
            $stmt->bindValue(":promo_code", $promoCode, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new ModelException("Error when deleting the promotion: " . $e->getMessage());
        }
    }
}