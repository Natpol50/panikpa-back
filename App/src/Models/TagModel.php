<?php
namespace App\Models;

use App\Services\Database;
use App\Exceptions\ModelException;
use PDO;
use PDOException;

/**
 * TagModel - Handles tag-related database operations
 */
class TagModel
{
    private PDO $database;
    
    /**
     * Create a new TagModel instance
     */
    public function __construct()
    {
        $this->database = Database::getInstance();
    }
    
    /**
     * Get all tags
     * 
     * @return array List of all tags
     * @throws ModelException If fetching fails
     */
    public function getAllTags(): array
    {
        try {
            $query = "SELECT * FROM Tag ORDER BY tag_name";
            $stmt = $this->database->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new ModelException("Failed to fetch tags: " . $e->getMessage());
        }
    }
    
    /**
     * Add a tag by name, with improved duplicate detection
     * 
     * @param string $tagName Tag name
     * @return int ID of the tag
     * @throws ModelException If adding or fetching fails
     */
    public function addTag(string $tagName): int
    {
        try {
            // Normalize the tag name (trim, lowercase, and remove extra spaces)
            $normalizedTagName = strtolower(trim(preg_replace('/\s+/', ' ', $tagName)));
            
            if (empty($normalizedTagName)) {
                throw new ModelException("Tag name cannot be empty");
            }
            
            // First check for exact match (most efficient)
            $exactQuery = "SELECT id_tag FROM Tag WHERE LOWER(tag_name) = :exactName";
            $exactStmt = $this->database->prepare($exactQuery);
            $exactStmt->bindValue(':exactName', $normalizedTagName, PDO::PARAM_STR);
            $exactStmt->execute();
            $exactMatch = $exactStmt->fetch(PDO::FETCH_ASSOC);
            
            if ($exactMatch) {
                return (int) $exactMatch['id_tag'];
            }
            
            // Then check for case-insensitive pattern match
            $patternQuery = "SELECT id_tag, tag_name FROM Tag WHERE LOWER(tag_name) REGEXP :pattern";
            $patternStmt = $this->database->prepare($patternQuery);
            
            // Create pattern to match both singular and plural forms
            // This handles common variations like "PHP" vs "php" vs "Php"
            $pattern = '^' . preg_quote($normalizedTagName, '/') . 's?$';
            $patternStmt->bindValue(':pattern', $pattern, PDO::PARAM_STR);
            $patternStmt->execute();
            $patternMatch = $patternStmt->fetch(PDO::FETCH_ASSOC);
            
            if ($patternMatch) {
                return (int) $patternMatch['id_tag'];
            }
            
            // Check for similar tags using Levenshtein distance for common typos
            $similarQuery = "SELECT id_tag, tag_name FROM Tag";
            $similarStmt = $this->database->prepare($similarQuery);
            $similarStmt->execute();
            $allTags = $similarStmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($allTags as $tag) {
                $existingTagName = strtolower($tag['tag_name']);
                
                // Calculate similarity based on tag length
                $maxLength = max(strlen($normalizedTagName), strlen($existingTagName));
                $maxDistance = min(3, ceil($maxLength * 0.25)); // Allow 25% difference but max 3 chars
                
                if (levenshtein($normalizedTagName, $existingTagName) <= $maxDistance) {
                    return (int) $tag['id_tag'];
                }
            }
            
            // Handle common technology acronyms and variations
            $acronyms = [
                'js' => 'javascript',
                'ts' => 'typescript',
                'py' => 'python',
                'react' => 'reactjs',
                'reactjs' => 'react',
                'vue' => 'vuejs',
                'vuejs' => 'vue',
                'node' => 'nodejs',
                'nodejs' => 'node',
                'dotnet' => '.net',
                '.net' => 'dotnet',
                'oop' => 'object-oriented programming',
                'sql' => 'database',
                'db' => 'database',
                'ui' => 'user interface',
                'ux' => 'user experience',
                'front' => 'frontend',
                'frontend' => 'front-end',
                'front-end' => 'frontend',
                'back' => 'backend',
                'backend' => 'back-end',
                'back-end' => 'backend'
            ];
            
            // Check if the tag is an acronym or has common variations
            foreach ($acronyms as $variant => $standard) {
                if ($normalizedTagName === $variant || $normalizedTagName === $standard) {
                    // Check if the standard form or variant exists
                    $variantQuery = "SELECT id_tag FROM Tag WHERE LOWER(tag_name) IN (:variant, :standard)";
                    $variantStmt = $this->database->prepare($variantQuery);
                    $variantStmt->bindValue(':variant', $variant, PDO::PARAM_STR);
                    $variantStmt->bindValue(':standard', $standard, PDO::PARAM_STR);
                    $variantStmt->execute();
                    $variantMatch = $variantStmt->fetch(PDO::FETCH_ASSOC);
                    
                    if ($variantMatch) {
                        return (int) $variantMatch['id_tag'];
                    }
                    
                    break;
                }
            }

            // No similar tag found, insert the new tag with proper capitalization
            $formattedTagName = $this->formatTagName($normalizedTagName);
            $insertQuery = "INSERT INTO Tag (tag_name) VALUES (:tagName)";
            $insertStmt = $this->database->prepare($insertQuery);
            $insertStmt->bindValue(':tagName', $formattedTagName, PDO::PARAM_STR);
            $insertStmt->execute();
            
            return (int) $this->database->lastInsertId();
        } catch (PDOException $e) {
            throw new ModelException("Failed to add or fetch tag: " . $e->getMessage());
        }
    }

    /**
     * Format tag name with proper capitalization
     * 
     * @param string $tagName Normalized tag name (lowercase)
     * @return string Properly formatted tag name
     */
    private function formatTagName(string $tagName): string
    {
        // List of special case tags that have specific capitalization
        $specialCases = [
            'php' => 'PHP',
            'css' => 'CSS',
            'html' => 'HTML',
            'sql' => 'SQL',
            'mysql' => 'MySQL',
            'postgresql' => 'PostgreSQL',
            'javascript' => 'JavaScript',
            'typescript' => 'TypeScript',
            'nodejs' => 'Node.js',
            'vuejs' => 'Vue.js',
            'reactjs' => 'React.js',
            'angularjs' => 'AngularJS',
            'c#' => 'C#',
            'c++' => 'C++',
            '.net' => '.NET',
            'asp.net' => 'ASP.NET',
            'ui/ux' => 'UI/UX',
            'api' => 'API',
            'rest' => 'REST',
            'json' => 'JSON',
            'xml' => 'XML',
            'aws' => 'AWS',
            'azure' => 'Azure',
            'gcp' => 'GCP',
            'devops' => 'DevOps',
            'ci/cd' => 'CI/CD'
        ];
        
        // Check if tag is a special case
        if (array_key_exists($tagName, $specialCases)) {
            return $specialCases[$tagName];
        }
        
        // For compound words (separated by space, hyphen, or slash)
        if (preg_match('/[\s\-\/]/', $tagName)) {
            // Capitalize each word in a compound tag
            return implode(' ', array_map('ucfirst', explode(' ', str_replace(['-', '/'], ' ', $tagName))));
        }
        
        // For regular words, just capitalize the first letter
        return ucfirst($tagName);
    }

    /**
     * Get a tag by ID
     * 
     * @param int $tagId Tag ID
     * @return array|null Tag data or null if not found
     * @throws ModelException If fetching fails
     */
    public function getTagById(int $tagId): ?array
    {
        try {
            $query = "SELECT * FROM Tag WHERE id_tag = :tagId";
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':tagId', $tagId, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (PDOException $e) {
            throw new ModelException("Failed to fetch tag: " . $e->getMessage());
        }
    }
    
    /**
     * Get tags for a specific offer
     * 
     * @param int $offerId Offer ID
     * @return array Tags associated with the offer
     * @throws ModelException If fetching fails
     */
    public function getTagsByOfferId(int $offerId): array
    {
        try {
            $query = "
                SELECT t.id_tag, t.tag_name, ot.optional 
                FROM Tag t
                JOIN Offer_tag ot ON t.id_tag = ot.id_tag
                WHERE ot.id_offer = :offerId
                ORDER BY t.tag_name
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':offerId', $offerId, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new ModelException("Failed to fetch offer tags: " . $e->getMessage());
        }
    }
    
    /**
     * Add a tag to an offer
     * 
     * @param int $offerId Offer ID
     * @param int $tagId Tag ID
     * @param bool $optional Whether the tag is optional
     * @return bool Success status
     * @throws ModelException If adding fails
     */
    public function addTagToOffer(int $offerId, int $tagId, bool $optional = false): bool
    {
        try {
            $query = "
                INSERT INTO Offer_tag (id_offer, id_tag, optional)
                VALUES (:offerId, :tagId, :optional)
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':offerId', $offerId, PDO::PARAM_INT);
            $stmt->bindValue(':tagId', $tagId, PDO::PARAM_INT);
            $stmt->bindValue(':optional', $optional, PDO::PARAM_BOOL);
            $stmt->execute();
            
            return true;
        } catch (PDOException $e) {
            throw new ModelException("Failed to add tag to offer: " . $e->getMessage());
        }
    }
    
    /**
     * Remove a tag from an offer
     * 
     * @param int $offerId Offer ID
     * @param int $tagId Tag ID
     * @return bool Success status
     * @throws ModelException If removing fails
     */
    public function removeTagFromOffer(int $offerId, int $tagId): bool
    {
        try {
            $query = "
                DELETE FROM Offer_tag 
                WHERE id_offer = :offerId AND id_tag = :tagId
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':offerId', $offerId, PDO::PARAM_INT);
            $stmt->bindValue(':tagId', $tagId, PDO::PARAM_INT);
            $stmt->execute();
            
            return true;
        } catch (PDOException $e) {
            throw new ModelException("Failed to remove tag from offer: " . $e->getMessage());
        }
    }
    
    /**
     * Get tags for a specific user
     * 
     * @param string $userId User ID
     * @return array Tags associated with the user
     * @throws ModelException If fetching fails
     */
    public function getTagsByUserId(string $userId): array
    {
        try {
            $query = "
                SELECT t.id_tag, t.tag_name
                FROM Tag t
                JOIN User_tag ut ON t.id_tag = ut.id_tag
                WHERE ut.id_user = :userId
                ORDER BY t.tag_name
            ";
            
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_STR);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new ModelException("Failed to fetch user tags: " . $e->getMessage());
        }
    }
}