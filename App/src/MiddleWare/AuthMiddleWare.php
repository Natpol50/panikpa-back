<?php

/*

AuthMiddleWare class that uses TokenService and Cacheservice to : check the token, get the role linked to the token, uses CacheService to temporairly store the data so we can speed up the process

*/



class AuthMiddleware
{
    private CacheService $cacheService;
    private TokenService $tokenService;

    public function __construct()
    {
        $this->cacheService = new CacheService();
        $this->tokenService = new TokenService();
    }

    // The first function to be called, it'll see if the user is loged in (must be used before any handle permission, even if some checks are repeated)
    public function userLogin(): bool{

        if (!isset($_COOKIE[$this->tokenService->token_name])) {
            return false; // Ask for a login since there is no cookie in the user's cache
        }

        $token = $_COOKIE[$this->tokenService->token_name];

        // Validate the JWT token
        if (!$this->tokenService->validateAndRefreshToken($token)) {
            return false; // Ask for a login
        }

        return true; // Succesfully loged in, no need to check again

    }

    // Function to retrive the necessary elements to "feed" the request object
    public function retriveUserInfo($userId, $userRole){

        $permissions = $this->cacheService->getRolePermission($userRole);

        // Now time to get the integer that will represent the permitions of an user : using the binairy logic

        $permission_int = 0;

        $power = 0;

        // Iterate over the permissions, skipping the first two attributes
        foreach ($permissions as $index => $permission) {
             // Skip the first two attributes
                 if ($index < 2) {
                   continue;
                }

         // Check if the permission is set (assuming 1 means permission is granted)
          if ($permission == 1) {
              $permission_int += pow(2, $power);
           }

         $power++;
        }

        // Create a temporary object to fetch name, firstname and surname
        $userModel = new UserModel();

        $userData = $userModel->getUserById($userId);

        $name = $userData->user_name;

        $firstname = $userData->user_fname;

        $photo_url = $userData->user_photo_url;

        $answer = [
            "userId" => $userId,

            "userName" => $name,

            "userFirstName" => $firstname,

            "permissionInteger" => $permission_int,
        
            "userRole" => $userRole,

            "profilePictureUrl" => $photo_url
         ];

         return $answer;
    }

    // Middleware function to check authentication and authorization
    public function handle(): mixed
    {
        // Check if the JWT token is present in the request
        if (!isset($_COOKIE[$this->tokenService->token_name])) {
            return null; // as a failsafe, since in a nanosecond the cookie seems to be gone, we're just saying he doesn't have any permission no matter which
        }

        $token = $_COOKIE[$this->tokenService->token_name];

        // Validate the JWT token
        if (!$this->tokenService->validateAndRefreshToken($token)) {
            return null; // same thing
        }

        // Decode the token to get user details and know if a role x can access the request
        $decodedToken = $this->tokenService->DecodeJWT($token);
        $userId = $decodedToken->user_id;
        $userRole = $decodedToken->acctype;


        /* If all checks pass, the request is authorized and sent back to the routeur with an : "approuved by the back" and gives as said in the sequence diagram : 
        
        - The Id of the user

        - The list of permissions if needed (Authmodel is already checking them but i'll respect the diagram)

        - The id of the account type (can get the name sure, but i think this is all you need, or just delete the acctype_name and make in short that the id becomes the name)

        */

        $answer = $this->retriveUserInfo($userId, $userRole);

        
        return new \App\Core\RequestObject($answer);
    }
}