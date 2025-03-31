<?php

/*

The class that will take out the data from the Interaction Joint Table

*/


class InteractionModel{

    private PDO $database;

    public function __construct(){
        $this->database = Database::getInstance();
    }


    // For the user side of the interaction, so he can get all of it's informations conserning his interaction for his internship
    public function getInteractionByUserId($userId){
        
        try{
        $query = "SELECT * 
        FROM Interaction
        WHERE id_user = :id_user
        ";

        $stmt = $this->database->prepare($query);

        $stmt->execute(
            [":id_user"=> $userId]
        );

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt->closeCursor();

        return $result;
        }catch(PDOException $e){
            throw new Exception("Unable to get the interaction(s) from the user, ". $e->getMessage());
        }
    }

    public function getInteractionByOfferId($offerId){

        try{
            $query = "SELECT * 
            FROM Interaction
            WHERE id_offer = :id_offer
            ";
    
            $stmt = $this->database->prepare($query);
    
            $stmt->execute(
                [":id_offer"=> $offerId]
            );
    
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $stmt->closeCursor();
    
            return $result;
            }catch(PDOException $e){
                throw new Exception("Unable to get the interaction(s) from the offer, ". $e->getMessage());
            }


    }

    public function getInteractionByInteractionId($interactionId){

        try{
            $query = "SELECT * 
            FROM Interaction
            WHERE id_interaction = :id_interaction
            ";
    
            $stmt = $this->database->prepare($query);
    
            $stmt->execute(
                [":id_interaction"=> $interactionId]
            );
    
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $stmt->closeCursor();
    
            return $result;
            }catch(PDOException $e){
                throw new Exception("Unable to get the interaction(s) from the offer, ". $e->getMessage());
            }

    }

    function createInteraction(array $data){
        // checking the fields for $data

        // Required

        if(empty($data["id_offer"]) || empty($data["id_user"]) || empty($data["interaction_cv_url"] || empty($data["interaction_cover_letter_url"]))){
        throw new Exception("error, there isn't the requiried fields to creat an interaction");
        }
        
        $id_offer_to_register = $data["id_offer"];

        $id_user_to_register = $data["id_user"];

        $id_interaction_to_register = $id_offer_to_register . $id_user_to_register;

        $interaction_cv_url_to_register = $data["interaction_cv_url"];

        $interaction_cover_letter_url = $data["interaction_cover_letter_url"];

        

        
        // Optional

        //None, since it's created by the user and not the enterprise, so the rest is null

        try{
        // Prepare the SQL query
    $sql = "INSERT INTO Interaction (
        id_offer,
        id_user,
        id_interaction,
        interaction_type,
        interaction_cv_url,
        interaction_first_date,
        interaction_followup_interview_date,
        interaction_cover_letter_url,
        interaction_followup_reply
    ) VALUES (
        :id_offer,
        :id_user,
        :id_interaction,
        :interaction_type,
        :interaction_cv_url,
        :interaction_first_date,
        :interaction_followup_interview_date,
        :interaction_cover_letter_url,
        :interaction_followup_reply
    )";

        // Prepare the statement
        $stmt = $this->database->prepare($sql);

        $stmt->execute(
            [

        ":id_offer"                            => $id_offer_to_register,
        ":id_user"                             => $id_user_to_register,
        ":id_interaction"                      => $id_interaction_to_register,
        ":interaction_type"                    => null,
        ":interaction_cv_url"                  => $interaction_cv_url_to_register,
        ":interaction_first_date"              => date("Y-m-d",time()),
        ":interaction_followup_interview_date" => null,
        ":interaction_cover_letter_url"        => $interaction_cover_letter_url,
        ":interaction_followup_reply"          => null,
               

        ]);
    }catch(PDOException $e){
        throw new Exception("unable to start the interaction, internal error".$e->getMessage());
    }


    }


    // Function used to modify an interaction
    public function updateInteraction(array $data_to_modify, $id_interaction){


        $previous_data = $this->getInteractionByInteractionId($id_interaction);

        // merging the arrays to update

         // The base
         $updated_data = $previous_data;

         // If the value isn't null in a said field, it replaces it
         foreach ($data_to_modify as $key => $value) {
                if ($value !== null) {
                       $updated_data[$key] = $value;
                     }
            }

    try{
        // Of course, i will prevent anyone from switching ids may they be id_user, id_offer or id_interaction, but you may modify anything else
        $query = "
        UPDATE Interaction SET
        interaction_cv_url                  = :interaction_cv_url,  
        interaction_first_date              = :interaction_first_date,
        interaction_followup_date           = :interaction_followup_date,
        interaction_followup_interview_date = :interaction_followup_interview_date,
        interaction_cover_letter_url        = :interaction_cover_letter_url,
        interaction_followup_reply_type     = :interaction_followup_reply_type,
        interaction_followup_reply          = :interaction_followup_reply
        WHERE id_interaction = :id_interaction";

        $stmt = $this->database->prepare($query);

        $stmt->execute([
            ":interaction_cv_url"                   => $updated_data["interaction_cv_url"],
            ":interaction_first_date"               => $updated_data["interaction_first_date"],
            ":interaction_followup_date"            => date("Y-m-d",time()),
            ":interaction_followup_interview_date"  => $updated_data["interaction_followup_interview_date"],
            ":interaction_cover_letter_url"         => $updated_data["interaction_cover_letter_url"],
            ":interaction_followup_reply_type"      => $updated_data["interaction_followup_reply_type"],
            ":interaction_followup_reply"           => $updated_data["interaction_followup_reply"]
        ]);

    }catch(PDOException $e){
        throw new Exception("Unable to modify the interaction, internal error ".$e->getMessage());
    }


    }

    function deleteInteraction($id_interaction){

        try{
        $query = "
        DELETE FROM interaction
        WHERE id_interaction = :id_interaction
        ";

        $stmt = $this->database->prepare($query);

        $stmt->execute([
            ":id_interaction"=> $id_interaction
        ]);
    }catch(PDOException $e){
        throw new Exception("Unable to delete the interaction ".$e->getMessage());
    }

    }
}