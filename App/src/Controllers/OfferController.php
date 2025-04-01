<?php
/*
     Offer controller, it has many function each to treat any queries from the routeur, the routeur reads the request, then check if the user is loged in, then look at the request, if it's about the offers he will instantiate the controller an use the corresponding function

    We send the Data using JSON format
*/

namespace App\Controller;

use App\Models\OfferModel; 
use App\Models\WishlistModel; 
use App\Models\UserModel; 
use App\Models\CityModel; 
use App\Models\EnterpriseModel; 
use App\Models\InteractionModel; 
use App\Models\TagModel;
use App\Controllers\BaseController;
use App\Services\CacheService; 
use App\Core\View; 
use App\Core\RequestObject; 

class OfferController extends BaseController {

    private WishlistModel $wishlistModel;
    private OfferModel $offerModel;
    private EnterpriseModel $enterpriseModel;
    private CityModel $cityModel;
    private CacheService $cacheService;
    private InteractionModel $interactionModel;
    private TagModel $tagModel;
    private UserModel $userModel;

    // The construct function 
    public function __construct() {
        // Instantiate the models we will use
        $this->wishlistModel = new WishlistModel();
        $this->offerModel = new OfferModel();
        $this->enterpriseModel = new EnterpriseModel();
        $this->cityModel = new CityModel();
        $this->cacheService = new CacheService();
        $this->tagModel = new TagModel();
        $this->interactionModel = new InteractionModel();
        $this->userModel = new UserModel();
    }

    public function renderOfferBase(RequestObject $request_object) {
        $offerUpdateAllowed = $this->cacheService->checkRolePermission($request_object->userRole, "perm_create_offer");

        // Rendering the correct View
        if ($offerUpdateAllowed) {
            $this->renderView('BaseOfferEnterpriseVersion', []);
        } else {
            $this->renderView('BaseOfferCasualVersion', []);
        }
    }

    public function renderInternshipOffer(RequestObject $request_object) {
        $this->renderOffer($request_object, 0);
    }

    public function renderAlternanceOffer(RequestObject $request_object) {
        $this->renderOffer($request_object, 1);
    }

    private function renderOffer(RequestObject $request_object, $type) {
        $offerApplyAllowed = $this->cacheService->checkRolePermission($request_object->userRole, "perm_offer_apply");
        $wishListAllowed = $this->cacheService->checkRolePermission($request_object->userRole, "perm_wishlist");

        $this->renderView('Offer', [
            "searchType" => $type,
            "wishlistActions" => $wishListAllowed,
            "offerApplyAllowed" => $offerApplyAllowed
        ]);
    }

    public function renderAddOffer(RequestObject $request_object) {
        $offerAddAllowed = $this->cacheService->checkRolePermission($request_object->userRole, "perm_create_offer"); 
        $offerUpdateAllowed = $this->cacheService->checkRolePermission($request_object->userRole, "perm_modify_offer");
        $offerDeleteAllowed = $this->cacheService->checkRolePermission($request_object->userRole, "perm_delete_offer");

        $offerAccessUpdateAllowed = $offerAddAllowed + $offerUpdateAllowed + $offerDeleteAllowed;

        // If the user can update in any way the offers, we render the enterprise version
        if ($offerAccessUpdateAllowed) {
            $this->renderView('BaseOfferEnterpriseVersion', [
                'create' => $offerAddAllowed,
                'update' => $offerUpdateAllowed,
                'delete' => $offerDeleteAllowed
            ]);
        } else {
            // Back to the OfferBase Page
            header('Location: /Offer');
            exit();
        }
    }

    public function answerGetOffer(RequestObject $request_object) {
        $userId = $request_object->userId;

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 5;
        $type = isset($_GET['type']) ? (int)$_GET['type'] : 0;

        $offers = ($type === 0) ? $this->offerModel->getAllInternshipOffers() : $this->offerModel->getAllAlternanceOffers();

        $offset = ($page - 1) * $limit;
        $totalOffers = count($offers);
        $totalPages = ceil($totalOffers / $limit);
        $offers_pagination = array_slice($offers, $offset, $limit);

        $wishlistOffers = $this->wishlistModel->getWishlistOffersFromUserId($userId);
        $wishlistOfferIds = array_column($wishlistOffers, 'id_offer');
        $appliedOffers = $this->interactionModel->getInteractionByUserId($userId);
        $appliedOffersIds = array_column($appliedOffers, 'id_offer');

        foreach ($offers_pagination as &$offer) {
            $offer["wishlisted"] = in_array($offer["id_offer"], $wishlistOfferIds) ? 1 : 0;
            $offer["applied"] = in_array($offer["id_offer"], $appliedOffersIds) ? 1 : 0;

            $enterprise_data = $this->enterpriseModel->getEnterpriseById($offer["id_enterprise"]);
            $offer["id_enterprise"] = $enterprise_data["enterprise_name"] ?? "Unknown";

            $city_data = $this->cityModel->getCityById($offer["id_city"]);
            $offer["id_city"] = $city_data["city_name"] ?? "Unknown";

            $tags = $this->tagModel->getTagsByOfferId($offer["id_offer"]);
            $tagNames = array_column($tags, 'tag_name');
            $offer['tags'] = $tagNames;
        }
        unset($offer);

        $formattedOffers = array_map(function ($offer) {
            return [
                "id" => $offer["id_offer"],
                "title" => $offer["offer_title"],
                "company" => $offer["id_enterprise"],
                "location" => $offer["id_city"],
                "published" => $offer["offer_publish_date"],
                "duration" => $offer["offer_duration"],
                "level" => $offer["offer_level"],
                "domain" => $offer["offer_domain"] ?? "",
                "startDate" => $offer["offer_start"],
                "remuneration" => $offer["offer_remuneration"],
                "wishlisted" => $offer["wishlisted"],
                "applicant" => $offer["applied"],
                "tags" => $offer["tags"]
            ];
        }, $offers_pagination);

        echo json_encode([
            "success" => true,
            "offers" => $formattedOffers,
            "count" => count($formattedOffers)
        ]);
    }

    public function answerUpdateOffer(RequestObject $request_object) {
        $userRole = $request_object->userRole;

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 5;

        $updateOfferAllowed = 
            $this->cacheService->checkRolePermission($userRole, "perm_create_offer") +
            $this->cacheService->checkRolePermission($userRole, "perm_modify_offer") +
            $this->cacheService->checkRolePermission($userRole, "perm_delete_offer");

        if (!$updateOfferAllowed) {
            header("Location: /Offer");
            exit();
        }

        $userId = $request_object->userId;
        $enterpriseId = $this->userModel->getEnterpriseIdByUser((int)$userId)["id_enterprise"];
        $offers = $this->offerModel->getOffersByEnterpriseId($enterpriseId);

        $offset = ($page - 1) * $limit;
        $totalOffers = count($offers);
        $totalPages = ceil($totalOffers / $limit);
        $offers_pagination = array_slice($offers, $offset, $limit);

        foreach ($offers_pagination as &$offer) {
            $enterprise_data = $this->enterpriseModel->getEnterpriseById($offer["id_enterprise"]);
            $offer["id_enterprise"] = $enterprise_data["enterprise_name"] ?? "Unknown";

            $city_data = $this->cityModel->getCityById($offer["id_city"]);
            $offer["id_city"] = $city_data["city_name"] ?? "Unknown";

            $tags = $this->tagModel->getTagsByOfferId($offer["id_offer"]);
            $tagNames = array_column($tags, 'tag_name');
            $offer['tags'] = $tagNames;
        }
        unset($offer);

        $formattedOffers = array_map(function ($offer) {
            return [
                "id" => $offer["id_offer"],
                "title" => $offer["offer_title"],
                "company" => $offer["id_enterprise"],
                "location" => $offer["id_city"],
                "published" => $offer["offer_publish_date"],
                "duration" => $offer["offer_duration"],
                "level" => $offer["offer_level"],
                "domain" => $offer["offer_domain"] ?? "",
                "startDate" => $offer["offer_start"],
                "remuneration" => $offer["offer_remuneration"],
                "tags" => $offer["tags"]
            ];
        }, $offers_pagination);

        echo json_encode([
            "success" => true,
            "offers" => $formattedOffers,
            "count" => count($formattedOffers)
        ]);
    }

    public function offerWishlist(RequestObject $request_object) {
        $userId = $request_object->userId;
        $userRole = $request_object->userRole;

        $offerId = isset($_GET['offer']) ? (int)$_GET['offer'] : null;

        if (!$offerId) {
            echo json_encode(["success" => false, "message" => "Invalid offer ID"]);
            return;
        }

        $wishlist = $this->wishlistModel->getWishlistOffersFromUserId($userId);

        $flag = false;
        foreach ($wishlist as $offer) {
            if ($offer["id_offer"] == $offerId) {
                $flag = true;
                break;
            }
        }

        if ($flag) {
            $this->wishlistModel->removeFromWishlist($userId, $offerId);
            echo json_encode(["success" => true, "message" => "Removed from wishlist"]);
        } else {
            $this->wishlistModel->addToWishlist($userId, $offerId);
            echo json_encode(["success" => true, "message" => "Added to wishlist"]);
        }
    }

    public function apply(RequestObject $request_object) {
        $userRole = $request_object->userRole;

        $allowed = $this->cacheService->checkRolePermission($userRole, "perm_offer_apply");

        if (!$allowed) {
            echo json_encode(["success" => false, "message" => "Not authorized"]);
            return;
        }

        $interaction_cv = $_FILES['cv'] ?? null;
        $interaction_cl = $_FILES['cl'] ?? null;

        $allowedMimeTypes = ['application/pdf', 'application/vnd.oasis.opendocument.text'];

        if (!$interaction_cv || !$interaction_cl) {
            echo json_encode(["success" => false, "message" => "Missing files"]);
            return;
        }

        if (!in_array($interaction_cv['type'], $allowedMimeTypes) || 
            !in_array($interaction_cl['type'], $allowedMimeTypes)) {
            echo json_encode(["success" => false, "message" => "Invalid file type"]);
            return;
        }

        $userId = $request_object->userId;
        $offerId = isset($_GET['offerId']) ? (int)$_GET['offerId'] : null;

        if (!$offerId) {
            echo json_encode(["success" => false, "message" => "Invalid offer ID"]);
            return;
        }

        $filenameCv = "/CV/cv_" . $userId . "_" . $offerId;
        $filenameCl = "/CL/cl_" . $userId . "_" . $offerId;

        $url_cv = "https://static.panikpa.com" . $filenameCv;
        $url_cl = "https://static.panikpa.com" . $filenameCl;

        $data = [
            "id_offer" => $offerId,
            "id_user" => $userId,
            "interaction_cv_url" => $url_cv,
            "interaction_cover_letter_url" => $url_cl
        ];

        if (!move_uploaded_file($interaction_cv['tmp_name'], $filenameCv) ||
            !move_uploaded_file($interaction_cl['tmp_name'], $filenameCl)) {
            echo json_encode(["success" => false, "message" => "Error uploading files"]);
            return;
        }

        try {
            $this->interactionModel->createInteraction($data);
            echo json_encode(["success" => true, "message" => "Application submitted"]);
        } catch (\Exception $e) {
            echo json_encode(["success" => false, "message" => "Error creating interaction"]);
        }
    }

    public function createOffer(RequestObject $request_object) {
        $userRole = $request_object->userRole;
        $userId = $request_object->userId;

        $allowed = $this->cacheService->checkRolePermission($userRole, "perm_create_offer");

        if (!$allowed) {
            echo json_encode(["success" => false, "message" => "Not authorized"]);
            return;
        }

        $offerTitle = $_POST['title'] ?? null;
        $offerRemuneration = $_POST['remuneration'] ?? null;
        $offerLevel = $_POST['level'] ?? null;
        $offerDuration = $_POST['duration'] ?? null;
        $offerType = isset($_POST['type']) ? (int)$_POST['type'] : null;
        $offerStart = $_POST['start'] ?? null;
        $offerContent = $_POST['description'] ?? null;
        $cityName = $_POST['city'] ?? null;
        $postalCode = $_POST['postal'] ?? null;

        // Validate required fields
        if (!$offerTitle || !$offerRemuneration || !$offerLevel || !$offerDuration || 
            $offerType === null || !$offerStart || !$offerContent || !$cityName || !$postalCode) {
            echo json_encode(["success" => false, "message" => "Missing required fields"]);
            return;
        }

        // Handle tags
        $tags = [];
        $optional = [];
        $index = 1;
        while (isset($_POST["tag$index"]) && $_POST["tag$index"] !== null) {
            $tags["tag$index"] = $_POST["tag$index"]; // The tags
            $optional["option_tag$index"] = $_POST["optional_tag$index"] ?? 0; // If they are optional
            $index++;
        }

        $enterpriseId = $this->userModel->getEnterpriseIdByUser((int)$userId)["id_enterprise"];

        // Find or create city
        $cityList = $this->cityModel->getAllCities();
        $cityId = null;
        
        foreach ($cityList as $city) {
            if ($city["city_name"] == $cityName && $city["city_postal"] == $postalCode) {
                $cityId = $city["id_city"];
                break;
            }
        }

        if (!$cityId) {
            $cityData = ["city_name" => $cityName, "city_postal" => $postalCode];
            $cityId = $this->cityModel->addCity($cityData);
        }

        // Save offer content to file
        $filename = $enterpriseId . $offerTitle . ".txt";
        $path = "contents/" . $filename;

        if (file_put_contents($path, $offerContent) === false) {
            echo json_encode(["success" => false, "message" => "Error saving offer content"]);
            return;
        }

        $offerUrl = "https://static.panikpa.com/" . $path;

        $dataOffer = [
            "offer_title" => $offerTitle,
            "offer_remuneration" => $offerRemuneration,
            "offer_level" => $offerLevel,
            "offer_duration" => $offerDuration,
            "offer_start" => $offerStart,
            "offer_type" => $offerType,
            "offer_content_url" => $offerUrl,
            "id_enterprise" => $enterpriseId,
            "id_city" => $cityId
        ]; 

        // Create offer and get its ID
        $offerId = $this->offerModel->createOffer($dataOffer);

        // Register tags
        foreach ($tags as $index => $tagName) {
            // Add or get existing tag
            $tagId = $this->tagModel->addTag($tagName);
            
            // Determine if tag is optional
            $isOptional = $optional["option_tag$index"] ?? 0;
            
            // Link tag to offer
            $this->tagModel->addTagToOffer($offerId, $tagId, $isOptional);
        }

        echo json_encode(["success" => true, "message" => "Offer created successfully", "offerId" => $offerId]);
    }

    public function updateOffer(RequestObject $request_object) {
        $userRole = $request_object->userRole;
        $userId = $request_object->userId;

        $allowed = $this->cacheService->checkRolePermission($userRole, "perm_modify_offer");

        if (!$allowed) {
            echo json_encode(["success" => false, "message" => "Not authorized"]);
            return;
        }

        $offerId = $_GET['offerId'] ?? null;
        if (!$offerId) {
            echo json_encode(["success" => false, "message" => "No offer ID provided"]);
            return;
        }

        // Retrieve and validate input data
        $offerNewTitle = $_POST['title'] ?? null;
        $offerNewRemuneration = $_POST['remuneration'] ?? null;
        $offerNewLevel = $_POST['level'] ?? null;
        $offerNewDuration = $_POST['duration'] ?? null;
        $offerNewStart = $_POST['start'] ?? null;
        $offerNewContent = $_POST['description'] ?? null;
        $cityNewName = $_POST['city'] ?? null;
        $postalNewCode = $_POST['postal'] ?? null;

        // Validate required fields
        if (!$offerNewTitle || !$offerNewRemuneration || !$offerNewLevel || 
            !$offerNewDuration || !$offerNewStart || !$offerNewContent || 
            !$cityNewName || !$postalNewCode) {
            echo json_encode(["success" => false, "message" => "Missing required fields"]);
            return;
        }

        // Handle tags
        $tags = [];
        $optional = [];
        $index = 1;
        while (isset($_POST["tag$index"]) && $_POST["tag$index"] !== null) {
            $tags["tag$index"] = $_POST["tag$index"];
            $optional["option_tag$index"] = $_POST["optional_tag$index"] ?? 0;
            $index++;
        }

        // Get previous offer data
        $previousOfferData = $this->offerModel->getOfferByOfferId($offerId);
        if (!$previousOfferData) {
            echo json_encode(["success" => false, "message" => "Offer not found"]);
            return;
        }

        // Handle city
        $cityList = $this->cityModel->getAllCities();
        $cityNewId = null;
        
        foreach ($cityList as $city) {
            if ($city["city_name"] == $cityNewName && $city["city_postal"] == $postalNewCode) {
                $cityNewId = $city["id_city"];
                break;
            }
        }

        if (!$cityNewId) {
            $cityData = ["city_name" => $cityNewName, "city_postal" => $postalNewCode];
            $cityNewId = $this->cityModel->addCity($cityData);
        }

        // Update content file
        $previousPath = "contents/" . $previousOfferData["id_enterprise"] . $previousOfferData["offer_title"] . ".txt";
        $newPath = "contents/" . $previousOfferData["id_enterprise"] . $offerNewTitle . ".txt";

        // Rename file if needed
        if (file_exists($previousPath) && $previousPath !== $newPath) {
            rename($previousPath, $newPath);
        }

        // Update file content
        file_put_contents($newPath, $offerNewContent);

        $offerNewUrl = "https://static.panikpa.com/" . $newPath;

        $dataOffer = [
            "offer_title" => $offerNewTitle,
            "offer_remuneration" => $offerNewRemuneration,
            "offer_level" => $offerNewLevel,
            "offer_duration" => $offerNewDuration,
            "offer_start" => $offerNewStart,
            "offer_content_url" => $offerNewUrl,
            "id_city" => $cityNewId
        ]; 

        // Update offer
        $this->offerModel->updateOffer($dataOffer, $offerId);

        // Remove old tags
        $oldTags = $this->tagModel->getTagsByOfferId($offerId);
        foreach ($oldTags as $toDelete) {
            $this->tagModel->removeTagFromOffer($offerId, $toDelete["id_tag"]);
        }

        // Add new tags
        foreach ($tags as $index => $tagName) {
            $tagId = $this->tagModel->addTag($tagName);
            $isOptional = $optional["option_tag$index"] ?? 0;
            $this->tagModel->addTagToOffer($offerId, $tagId, $isOptional);
        }

        echo json_encode(["success" => true, "message" => "Offer updated successfully"]);
    }

    public function deleteOffer(RequestObject $request_object) {
        $userRole = $request_object->userRole;

        $allowed = $this->cacheService->checkRolePermission($userRole, "perm_delete_offer");

        if (!$allowed) {
            echo json_encode(["success" => false, "message" => "Not authorized"]);
            return;
        }

        $offerId = isset($_GET['offer_id']) ? (int)$_GET['offer_id'] : null;

        if (!$offerId) {
            echo json_encode(["success" => false, "message" => "Invalid offer ID"]);
            return;
        }

        try {
            $offerData = $this->offerModel->getOfferByOfferId($offerId);

            if (!$offerData) {
                echo json_encode(["success" => false, "message" => "Offer not found"]);
                return;
            }

            // Delete offer from database
            $this->offerModel->deleteOffer($offerId);

            // Delete associated file
            $path = "contents/" . $offerData["id_enterprise"] . $offerData["offer_title"] . ".txt";
            if (file_exists($path)) {
                unlink($path);
            }

            // Delete associated tags
            $oldTags = $this->tagModel->getTagsByOfferId($offerId);
            foreach ($oldTags as $toDelete) {
                $this->tagModel->removeTagFromOffer($offerId, $toDelete["id_tag"]);
            }

            echo json_encode(["success" => true, "message" => "Offer deleted successfully"]);
        } catch (\Exception $e) {
            echo json_encode(["success" => false, "message" => "Error deleting offer: " . $e->getMessage()]);
        }
    }
}