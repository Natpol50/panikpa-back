<?php

namespace App\Models;

use App\Services\Database;
use App\Exceptions\ModelException;
use App\Exceptions\AuthenticationException;
use PDO;
use PDOException;

/**
 * UserModel - User management in the database
 * 
 * This class handles the complete lifecycle of users (CRUD)
 */
class UserModel
{
    private PDO $database;
    
    // Required fields for creating a user
    private const REQUIRED_FIELDS = [
        'userName', 'userFirstName', 'userEmail', 'userPassword',
        'userGender', 'userPhone', 'userRoleId'
    ];
    
    /**
     * Create a new UserModel instance
     * 
     * @param Database|null $database Database service
     */
    public function __construct(?Database $database = null)
    {
        if ($database) {
            $this->database = $database->getInstance();
        } else {
            // This is a fallback, but dependency injection is preferred
            $dbInstance = new Database();
            $this->database = $dbInstance->getInstance();
        }
    }
    
    /**
     * Get user by ID
     * 
     * @param int $userId User ID
     * @return object|null User object or null if not found
     * @throws ModelException If database error occurs
     */
    public function getUserById(int $userId): ?object
    {
        try {
            $query = "SELECT * FROM User WHERE id_user = :userId";
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$user) {
                return null;
            }
            
            // Get user's promotion codes
            $promoCodes = $this->getUserPromoCodes($userId);
            $user['promotionCode'] = $promoCodes;

            $offers = $this->getUserOffersStatistics($userId); 

            $user['user_pending_offers'] = $offers['user_pending_offers'];
            $user['user_total_offers'] = $offers['user_total_offers'];
            
            $offers = $this->getUserOffersStatistics($userId); 

            $user['user_pending_offers'] = $offers['user_pending_offers'];
            $user['user_total_offers'] = $offers['user_total_offers'];
            // Convert to object
            return $this->arrayToUserObject($user);
        } catch (PDOException $e) {
            throw new ModelException("Failed to get user by ID: " . $e->getMessage());
        }
    }

    /**
     * Get user offers statistics
     * 
     * @param int $userId User ID
     * @return array Array containing user_pending_offers and user_total_offers
     * @throws ModelException If database error occurs
     */
    public function getUserOffersStatistics(int $userId): array
    {
        try {
            $query = "
                SELECT 
                    COUNT(*) AS user_total_offers,
                    SUM(CASE WHEN interaction_followup_reply_type IS NULL THEN 1 ELSE 0 END) AS user_pending_offers
                FROM Interaction
                WHERE id_user = :userId
            ";

            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return [
                'user_total_offers' => (int)($result['user_total_offers'] ?? 0),
                'user_pending_offers' => (int)($result['user_pending_offers'] ?? 0),
            ];
        } catch (PDOException $e) {
            throw new ModelException("Failed to get user offers statistics: " . $e->getMessage());
        }
    }
    
    /**
     * Get user by email
     * 
     * @param string $email User's email
     * @return object|null User object or null if not found
     * @throws ModelException If database error occurs
     */
    public function getUserByEmail(string $email): ?object
    {
        try {
            $query = "SELECT * FROM User WHERE user_email = :email";
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$user) {
                return null;
            }
            
            // Get user's promotion codes
            $promoCodes = $this->getUserPromoCodes($user['id_user']);
            $user['promotionCode'] = $promoCodes;
            
            $offers = $this->getUserOffersStatistics($user['id_user']); 

            $user['user_pending_offers'] = $offers['user_pending_offers'];
            $user['user_total_offers'] = $offers['user_total_offers'];
            // Convert to object
            return $this->arrayToUserObject($user);
        } catch (PDOException $e) {
            throw new ModelException("Failed to get user by email: " . $e->getMessage());
        }
    }
    
    /**
     * Get all users with optional pagination
     * 
     * @param int $limit Maximum number of users to return
     * @param int $offset Starting position for pagination
     * @return array Array of user objects
     * @throws ModelException If database error occurs
     */
    public function getAllUsers(int $limit = 0, int $offset = 0): array
    {
        try {
            $query = "SELECT * FROM User";
            
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
            
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = [];
            
            foreach ($users as $user) {
                // Get user's promotion codes
                $promoCodes = $this->getUserPromoCodes($user['id_user']);
                $user['promotionCode'] = $promoCodes;
                
                // Convert to object and add to result
                $result[] = $this->arrayToUserObject($user);
            }
            
            return $result;
        } catch (PDOException $e) {
            throw new ModelException("Failed to get all users: " . $e->getMessage());
        }
    }
    
    /**
     * Get user permissions based on role
     * 
     * @param int $userId User ID
     * @return array|null User's permissions or null if not found
     * @throws ModelException If database error occurs
     */
    public function getUserPermission(int $userId): ?array
    {
        try {
            $query = "
                SELECT Acctype.*
                FROM User 
                JOIN Acctype ON User.id_acctype = Acctype.id_acctype
                WHERE User.id_user = :userId
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            
            $permissions = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $permissions ?: null;
        } catch (PDOException $e) {
            throw new ModelException("Failed to get user permissions: " . $e->getMessage());
        }
    }
    
    /**
     * Create a new user
     * 
     * @param array $userData User data
     * @return object Created user object with updated ID
     * @throws ModelException If creation fails or required fields are missing
     */
    public function createUser(array $userData): object
    {
        // Validate required fields
        $this->validateRequiredFields($userData);
        
        // Set default values
        $userData = $this->setDefaultValues($userData);
        
        try {
            $query = "
                INSERT INTO User (
                    user_phash, user_name, user_fname, user_stype, 
                    user_email, user_phone, user_gender, user_photo_url,
                    user_creation_date, id_acctype
                ) VALUES (
                    :password, :name, :fname, :stype, :email, 
                    :phone, :gender, :photoUrl, :creationDate, :acctype
                )
            ";
            
            $stmt = $this->database->prepare($query);
            
            $stmt->execute([
                ':password' => password_hash($userData['userPassword'], PASSWORD_DEFAULT),
                ':name' => $userData['userName'],
                ':fname' => $userData['userFirstName'],
                ':stype' => $userData['userSearchType'] ?? 'none',
                ':email' => $userData['userEmail'],
                ':phone' => $userData['userPhone'],
                ':gender' => $userData['userGender'],
                ':photoUrl' => $userData['userPhotoUrl'] ?? '/assets/img/default-avatar.png',
                ':creationDate' => date('Y-m-d'),
                ':acctype' => $userData['userRoleId'],
                
            ]);
            
            // Get the inserted ID
            $userId = (int)$this->database->lastInsertId();
            
            // Get the newly created user
            $newUser = $this->getUserById($userId);
            
            if (!$newUser) {
                throw new ModelException("Failed to retrieve newly created user");
            }
            
            return $newUser;
        } catch (PDOException $e) {
            throw new ModelException("Failed to create user: " . $e->getMessage());
        }
    }
    
    /**
     * Update an existing user
     * 
     * @param object $user User object to update
     * @return object Updated user object
     * @throws ModelException If update fails or user doesn't exist
     */
    public function updateUser(object $user): object
    {
        if (!isset($user->userId) || !$user->userId) {
            throw new ModelException("User ID is required for update");
        }
        
        // Verify user exists
        $existingUser = $this->getUserById($user->userId);
        
        if (!$existingUser) {
            throw new ModelException("User with ID {$user->userId} not found");
        }
        
        try {
            $query = "
                UPDATE User SET 
                    user_name = :name,
                    user_fname = :fname,
                    user_stype = :stype,
                    user_email = :email,
                    user_phone = :phone,
                    user_gender = :gender,
                    user_photo_url = :photoUrl,
                    id_acctype = :acctype,
                    user_refresh_token = :refreshToken,
                    user_refresh_token_date = :refreshTokenDate
                WHERE id_user = :userId
            ";
            
            $stmt = $this->database->prepare($query);
            
            $stmt->execute([
                ':name' => $user->userName,
                ':fname' => $user->userFirstName,
                ':stype' => $user->userSearchType,
                ':email' => $user->userEmail,
                ':phone' => $user->userPhone,
                ':gender' => $user->userGender,
                ':photoUrl' => $user->profilePictureUrl,
                ':acctype' => $user->userRole,
                ':refreshToken' => $user->refreshToken,
                ':refreshTokenDate' => $user->refreshTokenDate,
                ':userId' => $user->userId
            ]);
            
            // Get updated user
            return $this->getUserById($user->userId);
        } catch (PDOException $e) {
            throw new ModelException("Failed to update user: " . $e->getMessage());
        }
    }
    
    /**
     * Delete a user and all related data
     * 
     * @param int $userId User ID to delete
     * @return bool True on success
     * @throws ModelException If deletion fails
     */
    public function deleteUser(int $userId): bool
    {
        try {
            $this->database->beginTransaction();

            // Check if user is a tutor and has promo codes
            $promoCodes = $this->getUserPromoCodes($userId);
            if (!empty($promoCodes)) {
                // Delete all rows with those promo codes
                $queryDeletePromoCodes = "DELETE FROM Promo WHERE promo_code IN (" . implode(',', array_fill(0, count($promoCodes), '?')) . ")";
                $stmt = $this->database->prepare($queryDeletePromoCodes);
                $stmt->execute($promoCodes);
            }

            // Delete from Wishlist
            $queryWishlist = "DELETE FROM Wishlist WHERE id_user = :userId";
            $stmt = $this->database->prepare($queryWishlist);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();

            // Delete from Interaction
            $queryInteraction = "DELETE FROM Interaction WHERE id_user = :userId";
            $stmt = $this->database->prepare($queryInteraction);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();

            // Delete from Promo
            $queryPromo = "DELETE FROM Promo WHERE id_user = :userId";
            $stmt = $this->database->prepare($queryPromo);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();

            // Delete from User_tag
            $queryUserTag = "DELETE FROM User_tag WHERE id_user = :userId";
            $stmt = $this->database->prepare($queryUserTag);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();

            // Delete from Comment
            $queryComment = "DELETE FROM Comment WHERE id_user = :userId";
            $stmt = $this->database->prepare($queryComment);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();

            // Delete from CompanyUsers
            $queryCompanyUsers = "DELETE FROM CompanyUsers WHERE id_user = :userId";
            $stmt = $this->database->prepare($queryCompanyUsers);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();

            // Finally, delete the user
            $queryUser = "DELETE FROM User WHERE id_user = :userId";
            $stmt = $this->database->prepare($queryUser);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();

            $this->database->commit();

            // Check if a row was affected
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            $this->database->rollBack();
            throw new ModelException("Failed to delete user and related data: " . $e->getMessage());
        }
    }
    
    /**
     * Verify user credentials
     * 
     * @param string $email User email
     * @param string $password User password
     * @return object|null User object if credentials are valid, null otherwise
     * @throws AuthenticationException If authentication fails
     */
    public function verifyCredentials(string $email, string $password): ?object
    {
        try {
            $user = $this->getUserByEmail($email);
            
            if (!$user) {
                return null;
            }
            
            // Verify password
            if (password_verify($password, $user->passwordHash)) {
                return $user;
            }
            
            return null;
        } catch (PDOException $e) {
            throw new AuthenticationException("Authentication failed: " . $e->getMessage());
        }
    }
    
    /**
     * Get user promo codes
     * 
     * @param int $userId User ID
     * @return array Array of promo codes
     */
    private function getUserPromoCodes(int $userId): array
    {
        try {
            $query = "SELECT promo_code FROM Promo WHERE id_user = :userId";
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            
            $promoCodes = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (!empty($row['promo_code'])) {
                    $promoCodes[] = $row['promo_code'];
                }
            }
            
            return $promoCodes;
        } catch (PDOException $e) {
            // Log the error but return empty array to avoid breaking the main function
            error_log("Failed to get user promo codes: " . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Validate required fields for user creation
     * 
     * @param array $data User data
     * @throws ModelException If required fields are missing
     */
    private function validateRequiredFields(array $data): void
    {
        $missingFields = [];
        
        foreach (self::REQUIRED_FIELDS as $field) {
            if (!isset($data[$field]) || trim((string)$data[$field]) === '') {
                $missingFields[] = $field;
            }
        }
        
        if (!empty($missingFields)) {
            throw new ModelException(
                "Missing required user data fields: " . implode(", ", $missingFields)
            );
        }
    }
    
    /**
     * Set default values for optional fields
     * 
     * @param array $data User data
     * @return array Data with default values added if necessary
     */
    private function setDefaultValues(array $data): array
    {
        // Default profile picture
        if (!isset($data['userPhotoUrl']) || !$data['userPhotoUrl']) {
            $data['userPhotoUrl'] = '/assets/img/default-avatar.png';
        }
        
        // Default search type
        if (!isset($data['userSearchType']) || $data['userSearchType'] === '') {
            $data['userSearchType'] = 'none';
        }
        
        return $data;
    }
    
    /**
     * Convert database array to user object
     * 
     * @param array $data User data from database
     * @return object User object
     */
    private function arrayToUserObject(array $data): object
    {
        $user = new \stdClass();
        
        // Map database fields to object properties
        $user->userId = (int)$data['id_user'];
        $user->passwordHash = $data['user_phash'];
        $user->userName = $data['user_name'];
        $user->userFirstName = $data['user_fname'];
        $user->userSearchType = $data['user_stype'];
        $user->userEmail = $data['user_email'];
        $user->userPhone = $data['user_phone'];
        $user->userGender = $data['user_gender'];
        $user->profilePictureUrl = $data['user_photo_url'];
        $user->creationDate = $data['user_creation_date'];
        $user->refreshTokenDate = $data['user_refresh_token_date'] ?? null;
        $user->refreshToken = $data['user_refresh_token'] ?? null;
        $user->userRole = (int)$data['id_acctype'];
        $user->promotionCode = $data['promotionCode'] ?? [];
        $user->user_stype = $data['userSType'] ?? null;
        $user->pending_offers = $data['user_pending_offers'] ?? null;
        $user->total_offers = $data['user_total_offers'] ?? null;
        
        return $user;
    }

    /**
     * Link a user to an enterprise
     *
     * @param int $userId The ID of the user to link
     * @param string $enterpriseId The ID of the enterprise to link to
     * @return bool Returns true if link is successful
     * @throws ModelException If the linking process fails
     */
    public function linkUserEnterprise(int $userId, string $enterpriseId): bool
    {
        try {
            // Check if the Enterprise exists
            $queryEnterprise = "SELECT id_enterprise FROM Enterprise WHERE id_enterprise = :id_enterprise";
            $stmt = $this->database->prepare($queryEnterprise);
            $stmt->execute([':id_enterprise' => $enterpriseId]);

            if (!$stmt->fetch(PDO::FETCH_ASSOC)) {
                return false; // Enterprise does not exist
            }

            $stmt->closeCursor();


            // The Enterprise exists, we link the user to the enterprise
            $queryLink = 'UPDATE User SET id_enterprise = :id_enterprise WHERE id_user = :id_user';
            $stmt = $this->database->prepare($queryLink);
            $stmt->execute([':id_user' => $userId , ':id_enterprise' => $enterpriseId]);
            $stmt->closeCursor();
            return true;
        } catch (PDOException $e) {
            throw new ModelException("Unable to link the user to the enterprise: " . $e->getMessage());
        }
    }


    /**
     * Get enterprise ID for a user
     *
     * @param int $userId The ID of the user to get the enterprise for
     * @return array Returns an array with the id of the enterprise or an empty array
     * @throws ModelException If the fetching process fails
     */
    public function getEnterpriseIdByUser(int $userId): array
    {
        try {
            $query = "SELECT id_enterprise FROM User WHERE id_user = :id_user";
            $stmt = $this->database->prepare($query);
            $stmt->execute([':id_user' => $userId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            return $result ?: []; // Return empty array if no result
        } catch (PDOException $e) {
            throw new ModelException("Unable to fetch the enterprise ID linked to the user: " . $e->getMessage());
        }
    }
    /**
     * Update user password
     * 
     * @param array $userData User data containing userId and new password
     * @return bool True on success
     * @throws ModelException If update fails
     */
    public function updateUserPassword(object $user): bool
    {
        try {
            if (!isset($user->userId) || !isset($user->user_phash)) {
                throw new ModelException("User ID and password are required for password update");
            }
            
            $query = "UPDATE User SET user_phash = :passwordHash WHERE id_user = :userId";
            
            $stmt = $this->database->prepare($query);
            $stmt->execute([
                ':passwordHash' => $user->user_phash,
                ':userId' => $user->userId
            ]);
            
            // Check if a row was affected
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            throw new ModelException("Failed to update user password: " . $e->getMessage());
        }
    }

    /**
     * Get user profile image path
     * 
     * @param int $userId User ID
     * @return string|null Profile image path or null if not set
     */
    public function getUserProfileImagePath(int $userId): ?string
    {
        try {
            $query = "SELECT user_photo_url FROM User WHERE id_user = :userId";
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result && $result['user_photo_url'] ? $result['user_photo_url'] : null;
        } catch (PDOException $e) {
            error_log("Failed to get user profile image path: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Check if email is already in use by another user
     * 
     * @param string $email Email to check
     * @param int $excludeUserId User ID to exclude (for user's own email)
     * @return bool True if email is already in use
     */
    public function isEmailInUse(string $email, int $excludeUserId = 0): bool
    {
        try {
            $query = "SELECT COUNT(*) AS count FROM User WHERE user_email = :email AND id_user != :excludeUserId";
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':excludeUserId', $excludeUserId, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result && (int)$result['count'] > 0;
        } catch (PDOException $e) {
            error_log("Failed to check if email is in use: " . $e->getMessage());
            return false;
        }
    }


    /**
     * Retrieve user by many criterias with pagination and search
     * 
     * @param int $page Current page number
     * @param int $itemsPerPage Items per page
     * @param array $criteria Search criteria
     * @return array Users and total count
     */
    public function getUserByAccountType(int $page, int $itemsPerPage, array $criteria = []): array
    {
        try {
            $offset = ($page - 1) * $itemsPerPage;
            
            // Build the base query
            $baseQuery = "
            FROM User
            WHERE 1=1";
            
            $params = [];
            
            // Add search criteria if provided
            if (!empty($criteria['query'])) {
                $search = '%' . $criteria['query'] . '%';
                $baseQuery .= " AND (
                    user_name LIKE :search_name OR
                    user_fname LIKE :search_first_name OR
                    user_stype LIKE :search_type OR
                    id_enterprise LIKE :search_enterprise OR
                    user_email LIKE :search_email OR
                    id_acctype LIKE :search_acctype OR
                    user_phone LIKE :search_phone 
                )";
                $params[':search_name'] = $search;
                $params[':search_first_name'] = $search;
                $params[':search_type'] = $search;
                $params[':search_enterprise'] = $search;
                $params[':search_email'] = $search;
                $params[':search_acctype'] = $search;
                $params[':search_phone'] = $search;
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
            $query = "SELECT * " . $baseQuery . " ORDER BY user_name DESC LIMIT :limit OFFSET :offset";
            $stmt = $this->database->prepare($query);
            
            // Bind parameters
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return [
                'users' => $users,
                'totalRows' => $totalRows
            ];
        } catch (PDOException $e) {
            throw new ModelException("Unable to retrieve users: " . $e->getMessage());
        }
    }

    /**
     * Retrieve user by many criterias with pagination and search
     * 
     * @param int $page Current page number
     * @param int $itemsPerPage Items per page
     * @param string $promoCode promotion from where to fetch the use
     * @param array $criteria Search criteria
     * @return array Users and total count
     */
    public function getUserByAccountTypeFromPromotion(string $promoCode, int $page, int $itemsPerPage, array $criteria = []): array
    {
        try {
            $offset = ($page - 1) * $itemsPerPage;
            
            // Build the base query
            $baseQuery = "
            FROM User
            INNER JOIN Promo
            ON User.id_user = Promo.id_user
            WHERE Promo.promo_code = :promo_code";
            
            $params = [':promo_code' => $promoCode];
            
            // Add search criteria if provided
            if (!empty($criteria['query'])) {
                $search = '%' . $criteria['query'] . '%';
                $baseQuery .= " AND (
                    user_name LIKE :search_name OR
                    user_fname LIKE :search_first_name OR
                    user_stype LIKE :search_type OR
                    id_enterprise LIKE :search_enterprise OR
                    user_email LIKE :search_email OR
                    id_acctype LIKE :search_acctype OR
                    user_phone LIKE :search_phone 
                )";
                $params[':search_name'] = $search;
                $params[':search_first_name'] = $search;
                $params[':search_type'] = $search;
                $params[':search_enterprise'] = $search;
                $params[':search_email'] = $search;
                $params[':search_acctype'] = $search;
                $params[':search_phone'] = $search;
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
            $query = "SELECT User.* " . $baseQuery . " ORDER BY user_name DESC LIMIT :limit OFFSET :offset";
            $stmt = $this->database->prepare($query);
            
            // Bind parameters
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return [
                'users' => $users,
                'totalRows' => $totalRows
            ];
        } catch (PDOException $e) {
            throw new ModelException("Unable to retrieve users: " . $e->getMessage());
        }
    }
}
