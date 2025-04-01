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
            
            // Convert to object
            return $this->arrayToUserObject($user);
        } catch (PDOException $e) {
            throw new ModelException("Failed to get user by ID: " . $e->getMessage());
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
     * Delete a user
     * 
     * @param int $userId User ID to delete
     * @return bool True on success
     * @throws ModelException If deletion fails
     */
    public function deleteUser(int $userId): bool
    {
        try {
            $query = "DELETE FROM User WHERE id_user = :userId";
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            
            // Check if a row was affected
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            throw new ModelException("Failed to delete user: " . $e->getMessage());
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

            // Check if the user is already linked to an enterprise
            $queryCheck = "SELECT * FROM companyusers WHERE id_user = :id_user";
            $stmt = $this->database->prepare($queryCheck);
            $stmt->execute([':id_user' => $userId]);
            $existingLink = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            // If there is already an entry, delete the previous one
            if ($existingLink) {
                $queryCleanup = 'DELETE FROM companyusers WHERE id_user = :id_user';
                $stmt = $this->database->prepare($queryCleanup);
                $stmt->execute([':id_user' => $userId]);
                $stmt->closeCursor();
            }

            // The enterprise exists, proceed with linking
            $query = "INSERT INTO companyusers (id_enterprise, id_user) VALUES (:id_enterprise, :id_user)";
            $stmt = $this->database->prepare($query);
            $stmt->execute([
                ':id_enterprise' => $enterpriseId,
                ':id_user' => $userId
            ]);
            
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
            $query = "SELECT id_enterprise FROM companyusers WHERE id_user = :id_user";
            $stmt = $this->database->prepare($query);
            $stmt->execute([':id_user' => $userId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            return $result ?: []; // Return empty array if no result
        } catch (PDOException $e) {
            throw new ModelException("Unable to fetch the id linked to the user: " . $e->getMessage());
        }
    }
}
