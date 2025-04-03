<?php
/*

    The administration Panel

*/

namespace App\Controllers;

use App\Core\RequestObject;
use App\Models\EnterpriseModel;
use App\Models\CityModel;
use App\Models\PromoModel;
use App\Models\TagModel;
use App\Services\Database;
use App\Models\InteractionModel;
use App\Models\OfferModel;
use App\Models\UserModel;
use App\Models\WishlistModel;
use App\Models\CacheModel;
use App\Services\CacheService;
use App\Models\UserObject;
use PDO;

class GestionController extends BaseController
{
    private PDO $database;
    private InteractionModel $interactionModel;
    private OfferModel $offerModel;
    private UserModel $userModel;
    private EnterpriseModel $enterpriseModel;
    private CityModel $cityModel;
    private TagModel $tagModel;
    private WishlistModel $wishlistModel;
    private CacheService $cacheService;

    private PromoModel $promoModel;

    private CacheModel $cacheModel; // To get the id_acctype from a acctype_name, and the acctype_name from a id_acctype

    /**
     * Constructor initializes dependencies
     */
    public function __construct()
    {
        $this->database = Database::getInstance();
        $this->interactionModel = new InteractionModel();
        $this->offerModel = new OfferModel();
        $this->userModel = new UserModel();
        $this->enterpriseModel = new EnterpriseModel();
        $this->cityModel = new CityModel();
        $this->tagModel = new TagModel();
        $this->wishlistModel = new WishlistModel();
        $this->cacheService = new CacheService();
        $this->promoModel = new PromoModel();
        $this->cacheModel = new CacheModel();
    }

    /**
     * Display the gestion selection page
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function index(RequestObject $request): void
    {
        // Render the Gestion page only if the user can do buisness on it (it as at least one permission used in Gestion)


        // TODO

        if ($request->isAuthenticated()) {
            echo $this->render('gestion/index', [
                'request' => $request
            ]);
        }
    }


    // Render the /gestion/promo  page
    public function promo(RequestObject $request): void
    {
        // Check if the user as the right to see promotions
        if ($request->isAuthenticated()) {
            $canSeePromotion = $this->cacheService->checkRolePermission(
                $request->userRole,
                "perm_search_student"
            );
        }

        //render the promotion page
        echo $this->render('gestion/promotion', [
            'request' => $request,
            "canSeePromotion" => $canSeePromotion
        ]);

        //TODO
    }

    // Render the /gestion/user to search for users
    public function userGestion(RequestObject $request): void
    {
        // Check if the user as the right to see promotions
        $canSeeStudents = 0;
        $canSeeTutors = 0;
        $canSeeAdmins = 0;

        if ($request->isAuthenticated()) {
            $canSeeStudents = $this->cacheService->checkRolePermission(
                $request->userRole,
                "perm_search_student"
            );

            $canSeeTutors = $this->cacheService->checkRolePermission(
                $request->userRole,
                "perm_search_tutor"
            );

            $canSeeAdmins = $this->cacheService->checkRolePermission(
                $request->userRole,
                "perm_admin"
            );

        }

        //render the gestion page that list all users page
        echo $this->render('gestion/user', [
            'request' => $request,
            'canSeeStudent' => $canSeeStudents, // Used to know if you can see Students
            'canSeeTutors' => $canSeeTutors,    // Used to know if you can see Tutors
            'canSeeAdmin' => $canSeeAdmins      // Used to know if you can see Admins
        ]);

    }



    // The API function that should answer this route : /API/gestion/Promo ?page=x&limit=y&promotionCode=v&query=okdcehhergudcrvhcffhuqcvfcgqf
    public function apiGetPromoUsers(RequestObject $request): void
    {
        // Set response header to JSON
        header('Content-Type: application/json');

        // Get query parameters
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 10;
        $promotionCode = isset($_GET['promotion']) ? (int) $_GET['promotion'] : 0;
        $query = isset($_GET['query']) ? $_GET['query'] : '';

        // Prepare search criteria
        $searchCriteria = [];
        if (!empty($query)) {
            $searchCriteria['query'] = $query;
        }



        // Check if the user as the right to see promotions
        $canSeePromotion = $this->cacheService->checkRolePermission(
            $request->userRole,
            "perm_search_student"
        );

        // Then check if the user is admin if he is, we do not verify if he is inside the promo, else, we make it pass another test

        $doNotRequireToBelong = $canSeePromotion = $this->cacheService->checkRolePermission(
            $request->userRole,
            "perm_admin"
        );

        if (!$doNotRequireToBelong) {
            // checking if the user is able to check the students in his promotion
            $promotionList = $this->promoModel->getPromotionFromUserId($request->userId);

            $isInThePromotion = 0;

            foreach ($promotionList as $promotion) {
                if ($promotion["promo_code"] == $promotionCode) {
                    $isInThePromotion = 1;
                }
            }
        } else {
            // Admins are considered to be in all promotion
            $isInThePromotion = 1;
        }


        if ($isInThePromotion) {

            // Fetch the users for the specified promotion
            $student_result = $this->promoModel->getUsersFromPromo($promotion, $page, $limit);

            // Nb of student in the promotion
            $nbOfStudent = $student_result['totalRows'];

            // Get the number of max pages :

            $totalPages = ceil($nbOfStudent / $limit);

            $listStudent = $student_result['totalRows']['students'];


            // Formating the data correctly in a way so that Nathan won't work all night to correct it

            // Create a nicely formatted offer object
            $formattedStudents[] = [
                'id' => $listStudent['id_offer'],
                'name' => $listStudent['user_name'],
                'firstName' => $listStudent['user_fname'],
                'searchType' => $listStudent['user_stype'],
                'email' => $listStudent['user_email'],
                'gender' => $listStudent['user_gender'],
                'photoUrl' => $listStudent['user_photo_url'],
                'creationDate' => $listStudent['user_creation_date'],
                'id_acctype' => $listStudent['id_acctype']
            ];


            // Return JSON response
            echo json_encode([
                'success' => true,
                'students' => $formattedStudents,
                'totalPages' => $totalPages,
                'currentPage' => $page,
                'nbOfStudent' => $nbOfStudent,
                'query' => $query
            ]);
        }
    }

    // The API function that should  answer this route : /API/gestion/delete 
    public function apiCreateUser(RequestObject $request)
    {

        // We first check if the user can create the user with the right type

        // Extract form data
        $firstName = $_POST['firstName'] ?? '';
        $lastName = $_POST['lastName'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $AcctypeName = $_POST['type'] ?? 'student';
        $searchType = $_POST['searchType'] ?? 0;
        $email = $_POST['email'] ?? "";
        $gender = $_POST['gender'] ?? 0;
        $password = $_POST['password'] ?? "";




        $canCreate = 0;

        $canCreate = $this->cacheService->checkRolePermission(
            $request->userRole,
            "perm_admin"
        );

        if (!$canCreate) {

            if ($AcctypeName === "admin") {
                // Then, the user must have the permition to create the admin

                $canCreate = $this->cacheService->checkRolePermission(
                    $request->userRole,
                    "perm_create_admin"
                );



            } else if ($AcctypeName === "Tutor") {

                $canCreate = $this->cacheService->checkRolePermission(
                    $request->userRole,
                    "perm_create_tutor"
                );

            } else if ($AcctypeName === "student") {
                $canCreate = $this->cacheService->checkRolePermission(
                    $request->userRole,
                    "perm_create_student"
                );

            }
        }

        // Si l'utilisateur à les droits de créations alors, nous 
        if ($canCreate) {

            $idAcctype = $this->cacheModel->getRolePermissionByName($AcctypeName);

            // We don't let the admin take a photo for the user, it will use the default one temporairly, the user cans still modify it later
            $dataUser = [
                "userName" => $lastName,
                "userFirstnName" => $firstName,
                "userEmail" => $email,
                "userRoleId" => $idAcctype,
                "userSearchType" => $searchType,
                "userPhone" => $phone,
                "userGender" => $gender,
                "userPassword" => $password
            ];

            // Insert into the db
            $this->userModel->createUser($dataUser);


        } else {
            echo json_encode(["canCreate" => "0"]);
        }
        // End of function
    }






    // The API function that should  answer this route : /API/gestion/delete ?userId=x
    public function apiUpdateUser(RequestObject $request)
    {
        // Firstly, we check the acctype of the user to know the permission needed to update

        $userIdToUpdate = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        $userAcctypeIdToUpdate = $this->userModel->getUserById($userIdToUpdate)["id_acctype"];

        $acctypeName = $this->cacheModel->getRolePermission($userIdToUpdate)["acctype_name"];

        $canUpdate = 0;

        if ($acctypeName === "admin") {
            // Then, the user must have the permition to delete the admin

            $canUpdate = $this->cacheService->checkRolePermission(
                $request->userRole,
                "perm_modify_admin"
            );



        } else if ($acctypeName === "Tutor") {

            $canUpdate = $this->cacheService->checkRolePermission(
                $request->userRole,
                "perm_modify_tutor"
            );

        } else if ($acctypeName === "student") {
            // In that case, either you are an admin and it's been already checked, or you are a tutor within the promotion to succesfully

            //then you may be a tutor
            if (!$canUpdate) {
                // If you can delete a user
                if ($this->cacheService->checkRolePermission($request->userRole, "perm_delete_student")) {
                    // We check if you have the same Promotion as the user you want to delete
                    $userToUpdatePromotion = $this->userModel->getUserById($userIdToUpdate)["promo_code"];

                    // We check if you have the same Promotion as the user you want to delete
                    $userToUpdatePromotion = $this->userModel->getUserById($request->userId)["promo_code"];

                    // Check si les deux utilisateurs sont dans la même promotion et check si ils sont dans une promotion
                    if ($userToUpdatePromotion === $userToUpdatePromotion && $userToUpdatePromotion) {
                        $canUpdate = 1;
                    }

                }

            }

        }

        if($canUpdate){
            // The permission is checked, let's update the user

            //Get the parameters from the $_POST
            // Extract form data (we don't let the update change the user type nor change the User's password, we already have a forgotten password section so it isn't justified, not happy ? well just delete the user)
            $firstName = $_POST['firstName'] ?? '';
            $lastName = $_POST['lastName'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $searchType = $_POST['searchType'] ?? 0;
            $email = $_POST['email'] ?? "";
            $gender = $_POST['gender'] ?? 0; // Cause yes you can

            
            // We don't let the admin the photo of an user, only the user has the right to display his artistical preferences
            $dataUser = [
                "id_user" => $userIdToUpdate,
                "user_name" => $lastName,
                "user_fname" => $firstName,
                "user_email" => $email,
                "user_phone" => $phone,
                "userSType" => $searchType,
                "user_gender" => $gender
            ];

            // Create the userObject needed for the update function from the UserModel class 
            $user = new UserObject($dataUser);
            
            //Update the user inside the db
            $this->userModel->updateUser($user);


        } else {
            echo json_encode(["canCreate" => "0"]);
        }
        // End of function


        }

    
    // The API function that should  answer this route : /API/gestion/delete ?userId=x
    public function apiDeleteUser(RequestObject $request)
    {
        // Firstly, we check the acctype of the user to know the permission of
        $userIdToDelete = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        $userAcctypeIdToDelete = $this->userModel->getUserById($userIdToDelete)["id_acctype"];

        $acctypeName = $this->cacheModel->getRolePermission($userIdToDelete)["acctype_name"];

        $canDelete = 0;

        if ($acctypeName === "admin") {
            // Then, the user must have the permition to delete the admin

            $canDelete = $this->cacheService->checkRolePermission(
                $request->userRole,
                "perm_delete_admin"
            );



        } else if ($acctypeName === "Tutor") {

            $canDelete = $this->cacheService->checkRolePermission(
                $request->userRole,
                "perm_delete_tutor"
            );

        } else if ($acctypeName === "student") {
            // In that case, either you are an admin and that's it, or you are a tutor within the promotion to succesfully

            $canDelete = $this->cacheService->checkRolePermission(
                $request->userRole,
                "perm_admin"
            );

            //then you may be a tutor
            if (!$canDelete) {
                // If you can delete a user
                if ($this->cacheService->checkRolePermission($request->userRole, "perm_delete_student")) {
                    // We check if you have the same Promotion as the user you want to delete
                    $userToDeletePromotion = $this->userModel->getUserById($userIdToDelete)["promo_code"];

                    // We check if you have the same Promotion as the user you want to delete
                    $userToDeletePromotion = $this->userModel->getUserById($request->userId)["promo_code"];

                    // Check si les deux utilisateurs sont dans la même promotion et check si ils sont dans une promotion
                    if ($userToDeletePromotion === $userToDeletePromotion && $userToDeletePromotion) {
                        $canDelete = 1;
                    }

                }

            }

        }

        if ($canDelete) {
            $this->userModel->deleteUser($userIdToDelete);
        }

        //End of function


    }


    // The API function that should answer this route : /API/gestion/user ?query="usertypetoget"page=x&limit=y&query=okdcehhergudcrvhcffhuqcvfcgqf
    // Avec usertypetoget the name of the acctype
    public function apiGetUserController(): void
    {
        // Get query parameters
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 10;
        $promotionCode = isset($_GET['promotion']) ? (int) $_GET['promotion'] : 0;
        $query = isset($_GET['query']) ? $_GET['query'] : '';

    }
}
