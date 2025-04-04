<?php

namespace App\Controllers;

use App\Core\RequestObject;
use App\Models\UserModel;
use App\Models\TagModel;
use App\Services\FileService;
use App\Services\CacheService;
use App\Exceptions\FileSystemException;
use App\Exceptions\ValidationException;

/**
 * UserController - Handles user profile operations
 * 
 * This controller manages user profile operations such as viewing,
 * editing profile information, and uploading profile pictures.
 */
class UserController extends BaseController
{
    private UserModel $userModel;
    private TagModel $tagModel;
    private FileService $fileService;
    private CacheService $cacheService;
    
    /**
     * Constructor initializes required services
     */
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->fileService = new FileService();
        $this->cacheService = new CacheService();
        $this->tagModel = new TagModel();
    }
    
    /**
     * Display user profile page
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function profile(RequestObject $request): void
    {
        // Check if user is authenticated
        if (!$request->isAuthenticated()) {
            header('Location: /login');
            exit;
        }
        
        // Get user data
        $user = $this->userModel->getUserById($request->userId);
        
        if (!$user) {
            // User not found (should not happen since they're authenticated)
            header('Location: /login');
            exit;
        }
        
        // Render the profile page
        echo $this->render('user/profile', [
            'request' => $request,
            'user' => $user,
            'success' => $_SESSION['success'] ?? [],
            'error' => $_SESSION['error'] ?? []
        ]);
        
        // Clear session messages
        unset($_SESSION['success'], $_SESSION['error']);
    }
    
    /**
     * Process profile update
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function updateProfile(RequestObject $request): void
    {
        // Check if user is authenticated
        if (!$request->isAuthenticated()) {
            header('Location: /login');
            exit;
        }
        
        // Get current user data
        $user = $this->userModel->getUserById($request->userId);
        
        if (!$user) {
            header('Location: /login');
            exit;
        }
        
        // Initialize messages and form data
        $messages = ['success' => [], 'error' => []];
        $formData = $_POST;

        // Validate and process form data
        try {
            // Extract form data
            $firstName = $_POST['firstName'] ?? '';
            $lastName = $_POST['lastName'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $searchType = $_POST['searchType'] ?? $user->userSearchType;
            
            // Validate required fields
            if (empty($firstName) || empty($lastName) || empty($email) || empty($phone)) {
                throw new ValidationException("All fields are required");
            }
            
            // Validate email format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new ValidationException("Invalid email format");
            }
            
            // Check if email is already used by another user
            if ($email !== $user->userEmail) {
                $existingUser = $this->userModel->getUserByEmail($email);
                if ($existingUser && $existingUser->userId !== $user->userId) {
                    throw new ValidationException("Email is already in use by another account");
                }
            }
            
            // Update user data
            $user->userFirstName = $firstName;
            $user->userName = $lastName;
            $user->userEmail = $email;
            $user->userPhone = $phone;
            $user->userSearchType = $searchType;
            
            // Save changes to database
            $updatedUser = $this->userModel->updateUser($user);
            
            // Add success message
            $messages['success'][] = 'Your profile has been updated successfully';
            
        } catch (ValidationException $e) {
            // Add error message
            $messages['error'][] = $e->getMessage();
        } catch (\Exception $e) {
            // Add error message for other exceptions
            $messages['error'][] = 'An error occurred while updating your profile: ' . $e->getMessage();
        }
        
        // Render the profile page with messages and form data
        echo $this->render('user/profile', [
            'request' => $request,
            'user' => $user,
            'success' => $messages['success'],
            'error' => $messages['error'],
            'formData' => $formData
        ]);
    }
    
    /**
     * Process profile picture upload
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function uploadProfilePicture(RequestObject $request): void
    {
        // Set response headers for JSON response
        header('Content-Type: application/json');
        
        // Check if user is authenticated
        if (!$request->isAuthenticated()) {
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Authentication required']);
            exit;
        }
        
        try {
            // Check if file was uploaded
            if (!isset($_FILES['profilePicture']) || $_FILES['profilePicture']['error'] !== UPLOAD_ERR_OK) {
                throw new FileSystemException("File upload failed");
            }
            
            // Validate file type
            $fileInfo = getimagesize($_FILES['profilePicture']['tmp_name']);
            if (!$fileInfo || !in_array($fileInfo[2], [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF])) {
                throw new FileSystemException("Invalid image format. Only JPEG, PNG, and GIF are allowed");
            }
            
            // Get crop coordinates
            $cropX = isset($_POST['cropX']) ? (int)$_POST['cropX'] : 0;
            $cropY = isset($_POST['cropY']) ? (int)$_POST['cropY'] : 0;
            $cropWidth = isset($_POST['cropWidth']) ? (int)$_POST['cropWidth'] : $fileInfo[0];
            $cropHeight = isset($_POST['cropHeight']) ? (int)$_POST['cropHeight'] : $fileInfo[1];
            
            // Ensure minimum dimensions
            if ($cropWidth < 50 || $cropHeight < 50) {
                throw new FileSystemException("The cropped image is too small");
            }
            
            // Create destination folder if it doesn't exist
            $uploadDir = dirname(__DIR__, 2) . '/public/assets/pp/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0775, true);
            }
            
            // Generate filename based on user ID
            $filename = $request->userId . '.png';
            $filePath = $uploadDir . $filename;
            
            // Process and save the image
            $this->processAndSaveImage(
                $_FILES['profilePicture']['tmp_name'],
                $filePath,
                $cropX,
                $cropY,
                $cropWidth,
                $cropHeight
            );
            
            // Update user's profile picture URL in database
            $user = $this->userModel->getUserById($request->userId);
            $user->profilePictureUrl = '/assets/pp/' . $filename;
            $this->userModel->updateUser($user);
            
            // Return success response
            echo json_encode([
                'success' => true,
                'message' => 'Profile picture updated successfully',
                'url' => '/assets/pp/' . $filename
            ]);
            
        } catch (FileSystemException $e) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Process and save image with centered cropping
     * 
     * This method ensures that the image is cropped from the center of the selected area,
     * maintaining aspect ratio and preventing off-center cropping.
     * 
     * @param string $sourcePath Source image path
     * @param string $destinationPath Destination image path
     * @param int $cropX X-coordinate of crop start point
     * @param int $cropY Y-coordinate of crop start point
     * @param int $cropWidth Width of crop area
     * @param int $cropHeight Height of crop area
     * @return bool True on success
     * @throws FileSystemException If image processing fails
     */
    private function processAndSaveImage(
        string $sourcePath,
        string $destinationPath,
        int $cropX,
        int $cropY,
        int $cropWidth,
        int $cropHeight
    ): bool {
        // Get image information
        $sourceInfo = getimagesize($sourcePath);
        
        if (!$sourceInfo) {
            throw new FileSystemException("Could not determine image size");
        }
        
        // Create source image based on file type
        switch ($sourceInfo[2]) {
            case IMAGETYPE_JPEG:
                $sourceImage = imagecreatefromjpeg($sourcePath);
                break;
            case IMAGETYPE_PNG:
                $sourceImage = imagecreatefrompng($sourcePath);
                break;
            case IMAGETYPE_GIF:
                $sourceImage = imagecreatefromgif($sourcePath);
                break;
            default:
                throw new FileSystemException("Unsupported image format");
        }
        
        if (!$sourceImage) {
            throw new FileSystemException("Failed to create image from source");
        }
        
        // Calculate the actual crop area to ensure centered cropping
        $sourceWidth = imagesx($sourceImage);
        $sourceHeight = imagesy($sourceImage);
        
        // Determine the source crop area
        $sourceCropWidth = min($sourceWidth, $sourceHeight);
        $sourceCropHeight = $sourceCropWidth;
        
        // Calculate centered crop coordinates
        $sourceCropX = ($sourceWidth - $sourceCropWidth) / 2;
        $sourceCropY = ($sourceHeight - $sourceCropHeight) / 2;
        
        // Create destination image
        $destinationImage = imagecreatetruecolor($cropWidth, $cropHeight);
        
        // Preserve transparency for PNG
        imagealphablending($destinationImage, false);
        imagesavealpha($destinationImage, true);
        $transparent = imagecolorallocatealpha($destinationImage, 255, 255, 255, 127);
        imagefilledrectangle($destinationImage, 0, 0, $cropWidth, $cropHeight, $transparent);
        
        // Crop and resize the image from the center
        imagecopyresampled(
            $destinationImage,    // Destination image
            $sourceImage,         // Source image
            0,                    // Destination X
            0,                    // Destination Y
            $sourceCropX,         // Source X (centered)
            $sourceCropY,         // Source Y (centered)
            $cropWidth,           // Destination width
            $cropHeight,          // Destination height
            $sourceCropWidth,     // Source width
            $sourceCropHeight     // Source height
        );
        
        // Save as PNG
        $result = imagepng($destinationImage, $destinationPath, 9); // 9 = maximum compression
        
        // Free memory
        imagedestroy($sourceImage);
        imagedestroy($destinationImage);
        
        if (!$result) {
            throw new FileSystemException("Failed to save processed image");
        }
        
        return true;
    }
    /**
     * Change user password
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function changePassword(RequestObject $request): void
    {
        // Check if user is authenticated
        if (!$request->isAuthenticated()) {
            header('Location: /login');
            exit;
        }
        
        $messages = ['success' => [], 'error' => []];
        
        // Extract form data
        $currentPassword = $_POST['currentPassword'] ?? '';
        $newPassword = $_POST['newPassword'] ?? '';
        $confirmPassword = $_POST['confirmPassword'] ?? '';
        
        // Validate required fields
        if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
            $messages['error'][] = "All password fields are required";
        }
        
        // Validate password match
        if ($newPassword !== $confirmPassword) {
            $messages['error'][] = "New passwords do not match";
        }
        
        // Validate minimum password length
        if (strlen($newPassword) < 8) {
            $messages['error'][] = "Password must be at least 8 characters long";
        }
        
        // If no errors so far, proceed with password change
        if (empty($messages['error'])) {
            $user = $this->userModel->getUserById($request->userId);
            
            if (!password_verify($currentPassword, $user->passwordHash)) {
                $messages['error'][] = "Current password is incorrect";
            } else {
                // Hash new password
                $user->user_phash = password_hash($newPassword, PASSWORD_DEFAULT);
                
                // Update user in database
                $this->userModel->updateUserPassword($user);
                
                // Add success message
                $messages['success'][] = 'Your password has been changed successfully';
            }
        }
        
        // Render the profile page with messages
        echo $this->render('user/profile', [
            'request' => $request,
            'user' => $this->userModel->getUserById($request->userId),
            'success' => $messages['success'],
            'error' => $messages['error']
        ]);
    }

    /**
     * Delete user account
     * 
     * This API endpoint deletes the account of the authenticated user.
     * 
     * @param RequestObject $request Current request information
     * @return void
     */
    public function apiDeleteUser(RequestObject $request): void
    {
        // Set response headers for JSON response
        header('Content-Type: application/json');
        
        // Check if user is authenticated
        if (!$request->isAuthenticated()) {
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Authentication required']);
            exit;
        }
        
        try {
            // Get the authenticated user
            $user = $this->userModel->getUserById($request->userId);
            
            if (!$user) {
                throw new \Exception("User not found");
            }
            
            // Delete the user account
            $this->userModel->deleteUser($user->userId);
            
            // Return success response
            echo json_encode(['success' => true, 'message' => 'Your account has been deleted successfully']);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    /**
     * API endpoint to get user's tags
     * 
     * @param RequestObject $request Current request information
     * @return void Outputs JSON response
     */
    public function apiGetUserTags(RequestObject $request): void
    {
        // Set response header to JSON
        header('Content-Type: application/json');
        
        // Check if user is authenticated
        if (!$request->isAuthenticated()) {
            http_response_code(401);
            echo json_encode([
                'success' => false,
                'message' => 'Authentication required'
            ]);
            return;
        }
        
        try {
            $tagModel = new TagModel();
            $tags = $tagModel->getTagsByUserId($request->userId);
            
            echo json_encode([
                'success' => true,
                'tags' => $tags
            ]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Failed to fetch tags: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * API endpoint to add a tag to the user
     * 
     * @param RequestObject $request Current request information
     * @return void Outputs JSON response
     */
    public function apiAddUserTag(RequestObject $request): void
    {
        // Set response header to JSON
        header('Content-Type: application/json');
        
        // Check if user is authenticated
        if (!$request->isAuthenticated()) {
            http_response_code(401);
            echo json_encode([
                'success' => false,
                'message' => 'Authentication required'
            ]);
            return;
        }
        
        // Get tag name from request
        $data = json_decode(file_get_contents('php://input'), true);
        $tagName = $data['tagName'] ?? '';
        
        if (empty($tagName)) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Tag name is required'
            ]);
            return;
        }
        
        try {
            $tagModel = new TagModel();
            
            // Get or create the tag
            $tagId = $tagModel->addTag($tagName);
            
            // Add tag to user
            $success = $tagModel->addTagToUser($request->userId, $tagId);
            
            if ($success) {
                $tag = $tagModel->getTagById($tagId);
                echo json_encode([
                    'success' => true,
                    'message' => 'Tag added successfully',
                    'tag' => $tag
                ]);
            } else {
                throw new \Exception('Failed to add tag to user');
            }
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Failed to add tag: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * API endpoint to remove a tag from the user
     * 
     * @param RequestObject $request Current request information
     * @return void Outputs JSON response
     */
    public function apiRemoveUserTag(RequestObject $request): void
    {
        // Set response header to JSON
        header('Content-Type: application/json');
        
        // Check if user is authenticated
        if (!$request->isAuthenticated()) {
            http_response_code(401);
            echo json_encode([
                'success' => false,
                'message' => 'Authentication required'
            ]);
            return;
        }
        
        // Get tag ID from request
        $data = json_decode(file_get_contents('php://input'), true);
        $tagId = $data['tagId'] ?? 0;
        
        if ($tagId <= 0) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Valid tag ID is required'
            ]);
            return;
        }
        
        try {
            $tagModel = new TagModel();
            
            // Remove tag from user
            $success = $tagModel->removeTagFromUser($request->userId, $tagId);
            
            echo json_encode([
                'success' => $success,
                'message' => $success ? 'Tag removed successfully' : 'Tag not found or already removed'
            ]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Failed to remove tag: ' . $e->getMessage()
            ]);
        }
    }
}