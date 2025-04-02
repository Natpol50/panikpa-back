<?php

/**
 * The CityModel class allows you to:
 * 
 * - Create a city
 * - Modify a city (useful if the name changes or if an earthquake moves it)
 */


namespace App\Models;

use App\Services\Database;
use App\Exceptions\ModelException;
use App\Exceptions\AuthenticationException;
use PDO;
use PDOException;

class CityModel {
    private PDO $database;

    public function __construct() {
        $this->database = Database::getInstance();
    }

    /**
     * Retrieve all cities.
     * Useful if you want to display a map with all registered cities.
     */
    public function getAllCities() {
        try {
            $query = "SELECT * FROM City";
            $stmt = $this->database->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            return $result;
        } catch (PDOException $e) {
            throw new ModelException("Unable to fetch cities: " . $e->getMessage());
        }
    }

    /**
     * Retrieve a city by its ID.
     */
    public function getCityById($cityId) {
        try {
            $query = "SELECT * FROM City WHERE id_city = :id_city";
            $stmt = $this->database->prepare($query);
            $stmt->execute([":id_city" => $cityId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            return $result;
        } catch (PDOException $e) {
            throw new ModelException("Unable to get the city: " . $e->getMessage());
        }
    }

    // Modified CityModel::addCity method
    public function addCity(array $data)
    {
        try {
            // Required fields
            if (empty($data["city_name"]) || empty($data["city_postal"])) {
                throw new ModelException("Not enough data to add the city.");
            }

            // Assign values (default values for optional fields)
            $city_name = $data["city_name"];
            $city_postal = $data["city_postal"];

            // Modified INSERT query without RETURNING clause
            $query = "
                INSERT INTO City (city_name, city_postal)
                VALUES (:city_name, :city_postal)
            ";

            $stmt = $this->database->prepare($query);
            $stmt->execute([
                ":city_name"   => $city_name,
                ":city_postal" => $city_postal,
            ]);

            // Get the inserted ID using lastInsertId() method
            $id_city = $this->database->lastInsertId();
            
            return $id_city;

        } catch (PDOException $e) {
            throw new ModelException("Unable to add the city: " . $e->getMessage());
        }
    }
    /**
     * Update a city's information based on provided data.
     */
    public function updateCity(array $data_to_modify, $cityId) {
        try {
            $previous_data = $this->getCityById($cityId);
            if (!$previous_data) {
                throw new ModelException("City not found.");
            }

            // Merge new data with existing data
            $updated_data = array_merge($previous_data, array_filter($data_to_modify, fn($value) => $value !== null));

            // Update query
            $query = "
                UPDATE City SET
                city_name   = :city_name,
                city_postal = :city_postal,
                WHERE id_city = :id_city
            ";

            $stmt = $this->database->prepare($query);
            $stmt->execute([
                ":city_name"   => $updated_data["city_name"],
                ":city_postal" => $updated_data["city_postal"],
                ":id_city"     => $cityId
            ]);
        } catch (PDOException $e) {
            throw new ModelException("Unable to modify the city: " . $e->getMessage());
        }
    }

    /**
     * Delete a city by its ID.
     */
    public function deleteCity($cityId) {
        try {
            $query = "DELETE FROM City WHERE id_city = :id_city";
            $stmt = $this->database->prepare($query);
            $stmt->execute([":id_city" => $cityId]);

            if ($stmt->rowCount() === 0) {
                throw new ModelException("No city found with ID: " . $cityId);
            }
        } catch (PDOException $e) {
            throw new ModelException("Unable to delete the city: " . $e->getMessage());
        }
    }
}
