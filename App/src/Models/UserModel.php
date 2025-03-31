<?php


/////////////////////////////////////////////////////////
//
//      Pasta was here ...
//
/////////////////////////////////////////////////////////


/**
 * UserModel - User management in the database
 * 
 * This class handles the complete lifecycle of users (CRUD):
 * - User creation (createUser)
 * - Reading user information (getUserById, getAllUsers)
 * - Updating users (updateUser)
 * - Deleting users (deleteUser)
 * - Checking permissions (getUserPermission)
 * 
 * This class is a revision of the original class by our good friend TONIO.
 * 
 * This class uses the UserObject class to manipulate user data.
 */



class UserModel{
    private PDO $pdoInstance;      // Instance of the database class for database interactions, allows for singletons

    private const REQUIRED_FIELDS = [                          // Required fields for creating a user
        'user_name', 'user_fname', 'user_email', 'user_phash',
        'user_gender', 'user_phone', 'id_acctype'
    ];


    public function __construct(){
        $this->pdoInstance = Database::getInstance();              // Obtain the database instance for model interactions
        require_once(__DIR__ . '/UserObject.php');              // Ensure UserObject is included
        if (!class_exists('UserObject')) {
            throw new Exception("UserObject class not found. Please check the file path.");
        }
    }   


    /**
     * Retrieves user information by their ID
     * 
     * @param int $userId User's ID
     * @return UserObject|null User object or null if not found
     * @throws Exception In case of a database error
     */
    public function getUserById($user_id): bool|UserObject|null
    {
        try{
        $query = "SELECT * FROM User WHERE id_user = :user_id";
        $stmt = $this->pdoInstance->prepare($query);               // stmt means statement.
        $stmt->setFetchMode(PDO::FETCH_ASSOC);                  // Explicitly set fetch mode for clarity 
        $stmt->execute([":user_id" => $user_id]);

        $user = $stmt->fetchAll()[0] ?? null;
        $stmt->closeCursor();

        if (!$user) {
            return null;                                        // if no user, returns null
        } else {
            $promocodes = $this->getUserPromocodes($user_id);           // Get the user's promo codes
            $user['promocodes'] = $promocodes;                  // Add promo codes to the user data

            return new UserObject($user);                       // Return a UserObject instance with the fetched data
        }
        }

        catch(PDOException $e){
            echo "[getUserByID] Could not get user with ID $user_id: " . $e->getMessage();
            return false;
        }
    }


    /**
     * Retrieves the tags of a user
     * 
     * @param int $userId User's ID
     * @return array|null Array of promo codes empty if none found
     * @throws Exception In case of a database error (+ empty array)
     */
    private function getUserTags(int $userId): array
        {
        try{
           $query = "SELECT Tag.tag_name AS tag_name FROM User_tag JOIN Tag ON User_tag.id_tag = Tag.id_tag WHERE User_tag.id_user = :id_user";
           $stmt = $this->pdoInstance->prepare($query);
           $stmt->setFetchMode(PDO::FETCH_ASSOC); 
           $stmt->execute([":id_user" => $userId]);
           $result = $stmt->fetchAll()[0] ?? null;
           $stmt->closeCursor();
           return $result;
            } catch (PDOException $e) {
            // In case of an error, return an empty array instead of throwing an exception
            return [];
            }
        }
    


    /**
     * Retrieves the promo codes of a user
     * 
     * @param int $userId User's ID
     * @return array|null Array of promo codes empty if none found
     * @throws Exception In case of a database error (+ empty array)
     */
    private function getUserPromoCodes(int $userId): array
    {
        try {
            $query = "SELECT promo_code FROM Promo WHERE id_user = :user_id";
            $stmt = $this->pdoInstance->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_ASSOC); 
            $stmt->execute([":user_id" => $userId]);
            
            $result = $stmt->fetch();
            $stmt->closeCursor();
            
            // If promo codes exist, fetch all and return them as an array
            if ($result) {
                $promoCodes = [];
                do {
                    if (!empty($result['promo_code'])) {
                        $promoCodes[] = $result['promo_code'];
                    }
                } while ($result = $stmt->fetch());
                return $promoCodes;
            } else {
                return [];
            }            
        } catch (PDOException $e) {
            // In case of an error, return an empty array instead of throwing an exception
            return [];
        }
    }

    /**
     * Retrieves the permissions of a user
     * 
     * @param int $userId User's ID
     * @return array|null User's permissions or null if not found
     * @throws Exception In case of a database error
     */
    public function getUserPermission($user_id): array|null
    {
        try{

            $query = "
            SELECT Acctype.*
            FROM User JOIN Acctype ON User.id_acctype = Acctype.id_acctype
            WHERE User.id_user = :user_id
            ";

            $stmt = $this->pdoInstance -> prepare($query);
            $stmt->execute([":user_id"=> $user_id]);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $result = $stmt->fetchAll();
            return $result ?: null;
            
        }catch(PDOException $e){
            echo "[getUserPermission] Error: Unable to retrieve user permissions for user ID $user_id due to: " . $e->getMessage();
            return null;
        }

    }


    /**
     * Retrieves all users from the database, usefule for statistics purposes in the future, but not right now. DO NOT USE IN PRODUCTION.
     * @return mixed
     * @throws Exception In case of a database error
     */

    public function getAllUsers(): mixed
    {

        try{
        $query = "SELECT * FROM User";

        $stmt = $this->pdoInstance->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = $stmt->fetchAll();
        $stmt->closeCursor();

        return $result;
        }catch(PDOException $e){
            echo "[getAllUsers] Error: Unable to retrieve all users due to: " . $e->getMessage();
            return false;
        }
    }


    /**
     * Creates a new user in the database
     * 
     * @param UserObject $userObject User object to create
     * @return UserObject Created user object with updated ID
     * @throws Exception If the data is incomplete or in case of a database error
     */
    public function createUser(UserObject $userObject): UserObject
    {
        // Converting userObject to array, for easier validation
        $data = $this->userObjectToArray($userObject);
        
        // Validating required Fields
        $this->validateRequiredFields($data);
        
        // Set defautl values if not set
        $data = $this->setDefaultValues(data: $data);
        
        try {
            $query = "
                INSERT INTO User (
                    user_phash, user_name, user_fname, user_stype, 
                    user_email, user_phone, user_gender, user_photo_url,
                    user_creation_date, id_acctype
                )
                VALUES (
                    :phash, :name, :fname, :stype, :email, 
                    :phone, :gender, :photo, :creation_date, :acctype
                )
            ";
            
            $stmt = $this->pdoInstance->prepare($query);
            
            $stmt->execute([
                ":name" => $userObject->user_name,
                ":fname" => $userObject->user_fname,
                ":phash" => $userObject->user_phash,
                ":stype" => $userObject->user_stype,
                ":email" => $userObject->user_email,
                ":phone" => $userObject->user_phone,
                ":gender" => $userObject->user_gender,
                ":creation_date" => date(format: 'Y-m-d', timestamp: time()),
                ":acctype" => $userObject->id_acctype,
                ":photo" => $userObject->user_photo_url,
            ]);
            
            // Get updated user ID
            $userId = $this->pdoInstance->lastInsertId();
            $userObject->id_user = $userId;
            
            return $userObject;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la création de l'utilisateur: " . $e->getMessage());
        }
    }




    /**
     * Updates user information
     * 
     * @param UserObject $userObject User object to update
     * @return UserObject Updated user object
     * @throws Exception If the user does not exist or in case of a database error
     */
    public function updateUser(UserObject $userObject): UserObject
    {
        if (!$userObject->id_user) {
            throw new Exception(message: "Impossible to update user, no ID provided [updateUser]");
        }
        
        try {
            // Vérifier si l'utilisateur existe
            $existingUser = $this->getUserById($userObject->id_user);
            
            if (!$existingUser) {
                throw new Exception(message: "user with ID {$userObject->id_user} doesn't exists");
            }
            
            $query = "
                UPDATE User SET 
                    user_phash = :phash,
                    user_name = :name,
                    user_fname = :fname,
                    user_stype = :stype,
                    user_email = :email,
                    user_phone = :phone,
                    user_gender = :gender,
                    user_photo_url = :photo_url,
                    user_creation_date = :creation_date,
                    id_acctype = :acctype,
                    user_refresh_token_date = :refresh_token_date,
                    user_refresh_token = :refresh_token,
            ";
            $stmt = $this->pdoInstance->prepare($query);
            
            $stmt->execute([
                ":user_id" => $userObject->id_user,
                ":name" => $userObject->user_name,
                ":fname" => $userObject->user_fname,
                ":phash" => $userObject->user_phash,
                ":stype" => $userObject->user_stype,
                ":email" => $userObject->user_email,
                ":phone" => $userObject->user_phone,
                ":gender" => $userObject->user_gender,
                ":creation_date" => $userObject->user_creation_date,
                ":acctype" => $userObject->id_acctype,
                ":refresh_token" => $userObject->user_refresh_token,
                ":refresh_token_date" => $userObject->user_refresh_token_date,
                ":photo_url" => $userObject->user_photo_url,
            ]);
            
            return $userObject;
        } catch (PDOException $e) {
            throw new Exception(message: "Error while updating user {$userObject->id_user}: " . $e->getMessage());
        }
    }


    /**
     * Deletes a user from the database
     * 
     * @param int $userId ID of the user to delete
     * @return bool true if the deletion was successful
     * @throws Exception In case of a database error
     */
    public function deleteUser(int $userId): bool
    {
        try {
            $query = "DELETE FROM User WHERE id_user = :user_id";
            $stmt = $this->pdoInstance->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute([":user_id" => $userId]);            
            $stmt->closeCursor();

            return true;
        } catch (PDOException $e) {
            throw new Exception(message: "[deleteUser] Error while delete user $userId : " . $e->getMessage());
        }
    }



    /**
     * Converts a UserObject into an associative array
     * 
     * @param UserObject $userObject Object to convert
     * @return array Associative array of properties
     */
    private function userObjectToArray(UserObject $userObject): array
    {
        return [
            'id_user' => $userObject->id_user,
            'user_phash' => $userObject->user_phash,
            'user_name' => $userObject->user_name,
            'user_fname' => $userObject->user_fname,
            'user_stype' => $userObject->user_stype,
            'user_email' => $userObject->user_email,
            'user_phone' => $userObject->user_phone,
            'user_gender' => $userObject->user_gender,
            'user_photo_url' => $userObject->user_photo_url,
            'user_creation_date' => $userObject->user_creation_date,
            'user_refresh_token_date' => $userObject->user_refresh_token_date,
            'user_refresh_token' => $userObject->user_refresh_token,
            'id_acctype' => $userObject->id_acctype
        ];
    }

    /**
     * Validates that all required fields are present and not empty
     * 
     * @param array $data Data to validate
     * @throws Exception If any required fields are missing or empty
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
            throw new Exception(
                message: "User data missing [validateRequiredFields] : " . 
                implode(separator: ", ", array: $missingFields)
            );
        }
    }

    /**
     * Sets default values for optional fields
     * 
     * @param array $data Initial data
     * @return array Data with default values added if necessary
     */
    private function setDefaultValues(array $data): array
    {
        global $static_url;
        
        // Photo de profil par défaut si non fournie
        if (!isset($data["user_photo"]) || !$data["user_photo"]) {
            $data["user_photo"] = $static_url . "/pp/default.webp";
        }
        
        // Type de recherche par défaut si non fourni
        if (!isset($data["user_stype"]) || $data["user_stype"] === "") {
            $data["user_stype"] = "none";
        }
        
        return $data;
    }
}