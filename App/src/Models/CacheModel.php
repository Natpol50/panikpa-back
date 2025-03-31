<?php
/*

        The Class to get information usefull for the Cache from the database (list of permissions per role)


*/

class CacheModel{
    private PDO $database;

    public function __construct(){
        $this->database = Database::getInstance();
    }

    // Returns an array looking like this : [user,pilote,enterprise,...] to list the diffrent roles

    public function fetchRoles(){

        //Will store the roles
        $return_array = [];
        $query = "
        SELECT acctype_name 
        FROM Acctype";

        $stmt = $this->database->prepare($query);

        $stmt->execute();

        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt->closeCursor();

        foreach ($list as $role) {
            $return_array[] = $role["acctype_name"];
        }
    
        return $return_array;
    }

    //   Used to get the permissions of a said role

    public function getRolePermission($role_id){

      try{
        $query = "
        SELECT * 
        FROM Acctype
        WHERE id_acctype = :id_acctype";

        $stmt = $this->database->prepare($query);

        $stmt->execute([
            ":acctype_name"=> $role_id
        ]);

        $role_list = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt->closeCursor();

        if($role_list){
            //Returns the list of permissions fetched 
            return $role_list;
        }

        else {
            throw new Exception("The role doesn't seems to exist");
        }
      }catch(PDOException $e){
         throw new Exception("Error while fetching the permission for the role number  ". $role_id ." : ". $e->getMessage());
    }
    }

    // Now fetchs the information that will be calculated for the cache, such as the number of comments, their rating, the number of people that have applied for an offer

    public function getNumberOfApplicant($offer_id){

        try{
        $query = "
        SELECT COUNT(*) as interaction_count
        FROM Interaction
        WHERE id_offer = :id_offer";

        $stmt = $this->database->prepare($query);


        $stmt->execute([':id_offer' => $offer_id]);
        $number_of_applicant = $stmt->fetchColumn(); // Récupère directement la valeur du C

        return $number_of_applicant;
        }catch(PDOException $e){
            throw new Exception("Unable to fetch the number of applicants :" . $e->getMessage());
        }
    }

    // For the average grade of an enterprise
    public function getEnterpriseReview($Enterprise_id){

        $query = "
        SELECT grade_UE
        FROM Comment
        WHERE id_enterprise = :id_enterprise";

        $stmt = $this->database->prepare($query);

        $stmt->execute(
            [
                ":id_enterprise" => $Enterprise_id
        ]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($result){
            return $result;
        }
        else{
            return false; // Pas encore de commentaires
        }
    }


    


}