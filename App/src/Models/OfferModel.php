<?php

/*

    The OfferModel Class, with it, you can get all the offers from a specified type

    - Create / Update / destroy an Offer

*/

namespace App\Models;

use App\Services\Database;
use App\Exceptions\ModelException;
use App\Exceptions\AuthenticationException;
use PDO;
use PDOException;


class OfferModel {
    private PDO $database;

    public function __construct() {
        $this->database = Database::getInstance();
    }

    // Retrieve all offers from a specific enterprise
    public function getOffersByEnterpriseId($enterpriseId) {
        try {
            $query = "SELECT * FROM Offer WHERE id_enterprise = :id_enterprise";
            $stmt = $this->database->prepare($query);
            $stmt->execute([':id_enterprise' => $enterpriseId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new ModelException("Unable to get the offers from an enterprise: " . $e->getMessage());
        }
    }

    // Retrieve a specific offer by its ID
    public function getOfferByOfferId($offerId) {
        try {
            $query = "SELECT * FROM Offer WHERE id_offer = :id_offer";
            $stmt = $this->database->prepare($query);
            $stmt->execute([':id_offer' => $offerId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new ModelException("Unable to get the specified offer: " . $e->getMessage());
        }
    }

    // Retrieve all internship offers
    public function getAllInternshipOffers() {
        return $this->getOffersByType(0);
    }

    // Retrieve all alternance offers
    public function getAllAlternanceOffers() {
        return $this->getOffersByType(1);
    }

    private function getOffersByType(int $type) {
        try {
            $query = "SELECT * FROM Offer WHERE offer_type = :offer_type";
            $stmt = $this->database->prepare($query);
            $stmt->execute([':offer_type' => $type]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new ModelException("Unable to retrieve offers: " . $e->getMessage());
        }
    }

    // Create a new offer
    public function createOffer(array $data) {
        $requiredFields = ['offer_title', 'offer_remuneration', 'offer_level', 'offer_duration', 
                           'offer_start', 'offer_type', 'offer_content_url', 'id_enterprise', 'id_city'];

        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                throw new ModelException("Missing required field: $field");
            }
        }

        try {
            $query = "INSERT INTO Offer (offer_title, offer_remuneration, offer_level, offer_duration, 
                      offer_start, offer_type, offer_publish_date, offer_content_url, offer_applicant_nb, 
                      id_enterprise, id_city) 
                      VALUES (:offer_title, :offer_remuneration, :offer_level, :offer_duration, :offer_start, 
                      :offer_type, :offer_publish_date, :offer_content_url, :offer_applicant_nb, :id_enterprise, :id_city)";

            $stmt = $this->database->prepare($query);
            $stmt->execute([
                ':offer_title'        => $data['offer_title'],
                ':offer_remuneration' => $data['offer_remuneration'],
                ':offer_level'        => $data['offer_level'],
                ':offer_duration'     => $data['offer_duration'],
                ':offer_start'        => $data['offer_start'],
                ':offer_type'         => $data['offer_type'],
                ':offer_publish_date' => date("Y-m-d"),
                ':offer_content_url'  => $data['offer_content_url'],
                ':offer_applicant_nb' => 0,
                ':id_enterprise'      => $data['id_enterprise'],
                ':id_city'            => $data['id_city']
            ]);
        } catch (PDOException $e) {
            throw new ModelException("Unable to create the offer: " . $e->getMessage());
        }
    }

    // Update an offer
    public function updateOffer(array $data, $offerId) {
        $existingData = $this->getOfferByOfferId($offerId);
        if (!$existingData) {
            throw new ModelException("Offer not found.");
        }

        $updatedData = array_merge($existingData, $data);

        try {
            $query = "UPDATE Offer SET offer_title = :offer_title, offer_remuneration = :offer_remuneration, 
                      offer_level = :offer_level, offer_duration = :offer_duration, offer_start = :offer_start, 
                      offer_content_url = :offer_content_url, offer_applicant_nb = :offer_applicant_nb
                      WHERE id_offer = :id_offer";

            $stmt = $this->database->prepare($query);
            $stmt->execute([
                ':offer_title'        => $updatedData['offer_title'],
                ':offer_remuneration' => $updatedData['offer_remuneration'],
                ':offer_level'        => $updatedData['offer_level'],
                ':offer_duration'     => $updatedData['offer_duration'],
                ':offer_start'        => $updatedData['offer_start'],
                ':offer_content_url'  => $updatedData['offer_content_url'],
                ':offer_applicant_nb' => $updatedData['offer_applicant_nb'],
                ':id_offer'           => $offerId
            ]);
        } catch (PDOException $e) {
            throw new ModelException("Unable to update the offer: " . $e->getMessage());
        }
    }

    // Delete an offer
    public function deleteOffer($offerId) {
        try {
            $query = "DELETE FROM Offer WHERE id_offer = :id_offer";
            $stmt = $this->database->prepare($query);
            $stmt->execute([':id_offer' => $offerId]);
        } catch (PDOException $e) {
            throw new ModelException("Unable to delete the offer: " . $e->getMessage());
        }
    }

    // Retrieve offer tags
    public function getOfferTags($offerId) {
        try {
            $query = "SELECT t.tag_name, ot.optional FROM Offer_tag ot
                      JOIN Tag t ON ot.id_tag = t.id_tag WHERE ot.id_offer = :id_offer";
            $stmt = $this->database->prepare($query);
            $stmt->execute([':id_offer' => $offerId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new ModelException("Unable to get the tags of the offer: " . $e->getMessage());
        }
    }

    // Retrieve the title of an offer by its ID
    public function getOfferTitle($offerId) {
        try {
            $query = "SELECT offer_title FROM Offer WHERE id_offer = :id_offer";
            $stmt = $this->database->prepare($query);
            $stmt->execute([':id_offer' => $offerId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['offer_title'] : null;
        } catch (PDOException $e) {
            throw new ModelException("Unable to get the offer title: " . $e->getMessage());
        }
    }

    // Retrieve the company name associated with an offer by its ID
    public function getCompanyName($offerId) {
        try {
            $query = "SELECT e.company_name FROM Enterprise e
                      JOIN Offer o ON e.id_enterprise = o.id_enterprise
                      WHERE o.id_offer = :id_offer";
            $stmt = $this->database->prepare($query);
            $stmt->execute([':id_offer' => $offerId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['company_name'] : null;
        } catch (PDOException $e) {
            throw new ModelException("Unable to get the company name: " . $e->getMessage());
        }
    }
}