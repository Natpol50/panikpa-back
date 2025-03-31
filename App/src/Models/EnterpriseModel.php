<?php
/*

 Use Guide :

 Here is the Enterprise model class

 without an id, you can :

 - create an enterprise by giving an array : createEnteprise(data) /!\ You must include critical informations, more details on the function itself
 
 - get all the datas of all the enterprises : getAllEnterprise


 With an id, you can :

 By giving and id of the enterprise :
 
 - Return an array with all of it's data : getEnterpriseById(id)

 - Modify it's data, by also giving an array (please you must make sure your array fielnames are coherent with the BDD) : updateEnterprise(id,array)

 - Delete one Enterprise : deleteEnterprise(id)

 



*/
class EnterpriseModel{
    private Database $database;

    public function __construct(){
        $this->database = Database::getInstance(); // We get the instance of our database
    } 

    /* La fonction de création de l'entreprise, ne dois être utilisable que par un admin
    //
    // Structure du tableau d'entrée : (doit repecter les noms de la table de la BDD)
    //
    //
    //  "enterprise_name"
    //  "enterprise_phone"
    //  "enterprise_description_url" // Optionnel pas de description par défaux
    //  "enterprise_email"
    //  "enterprise_photo_url" // Optionnel pas d'images par défaux
    //  "enterprise_site"      // Optionnel pas de site par défaux
    //
    // 
    // 
    */
    public function createEnterprise(array $data){

        // Needed

        if(empty($data["enterprise_name"]) || empty($data["enterprise_phone"]) || empty($data["enterprise_email"])){
            throw new Exception("Le formulaire de création donné est incomplet");
        }

        else{

        $name_to_register = $data["enterprise_name"];

         $email_to_register = $data["enterprise_email"];

         $phone_to_register = $data["enterprise_phone"];
        }

        // Optionnal

        if(!empty($data["enterprise_description_url"])){
            $description_url_to_register = $data["enterprise_description_url"];
        }
        else{
            $description_url_to_register = "";
        }

        if(!empty($data["enterprise_photo_url"])){
            $photo_url_to_register = $data["enterprise_photo_url"];
        }
        else{
            $photo_url_to_register = "";
        }

        if(!empty($data["enterprise_site"])){
            $site_to_register = $data["enterprise_site"];
        }
        else{
            $site_to_register = "";
        }

        // The query

        try{
        $query = "
        INSERT INTO Enterprise(enterprise_name,enterprise_phone,enterprise_description_url,enterprise_email,enterprise_photo_url,enterprise_site)
        VALUES(:enterprise_name,:enterprise_phone,:enterprise_description_url,:enterprise_email,:enterprise_photo_url,:enterprise_site)
        ";

        $stmt = $this->database->prepare($query);

        $stmt->execute([
            ":enterprise_name"=> $name_to_register,
            ":enterprise_phone"=> $phone_to_register,
            ":enterprise_description_url"=> $description_url_to_register,
            ":enterprise_email"=> $email_to_register,
            ":enterprise_photo_url"=> $photo_url_to_register,
            ":enterprise_site"=> $site_to_register
        ]);

        }catch(PDOException $e){
            throw new Exception("Fatal error when creating the enterprise :".$e->getMessage());
        }


        }


    public function getEnterpriseById($enterprise_id){
        try{
            $query = "SELECT * FROM Enterprise WHERE id_enterprise = :enterprise_id";

            $stmt = $this->database->prepare($query);

            $stmt->execute([":enterprise_id"=> $enterprise_id]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt->closeCursor();

            return $result;

        }catch(PDOException $e){
            throw new Exception("error, the enterprise couldn't be fetched".$e->getMessage());
        }
    }

    public function getAllEnterprise(){
        try{
            $query = "SELECT * FROM Enterprise";

            $stmt = $this->database->prepare($query);

            $stmt->execute([]);

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt->closeCursor(); // Closes the connection and free it for another request

            return $result;

        }catch(PDOException $e){
            throw new Exception("error, the enterprises couldn't be fetched ".$e->getMessage());
        }
    }

    // The array in parameter must respect the database fields
    
    public function updateEnterprise(int $enterprise_id, array $data_to_modify){

        $previous_data = $this->getEnterpriseById($enterprise_id);  

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

         $query = "
         UPDATE Enterprise SET
         enterprise_name = :enterprise_name,
         enterprise_phone = :enterprise_phone,
         enterprise_description_url = :enterprise_description_url,
         enterprise_site = :enterprise_site,
         enterprise_email = :enterprise_email,
         enterprise_photo_url = :enterprise_photo_url
         WHERE id_enterprise = :enterprise_id";

         $stmt = $this->database->prepare($query);

         $stmt->execute(
            [
              ":enterprise_name"=>            $updated_data["enterprise_name"],
              ":enterprise_phone"=>           $updated_data["enterprise_phone"],
              ":enterprise_description_url"=> $updated_data["enterprise_description_url"],
              ":enterprise_site"=>            $updated_data["enterprise_site"],
              ":enterprise_email"=>           $updated_data["enterprise_email"],
              ":enterprise_photo_url"=>       $updated_data["enterprise_photo_url"],
              ":enterprise_id"=>              $updated_data["id_enterprise"]
            ]);

            return true;
        }catch(PDOException $e){
            throw new Exception("error in updating the enterprise :". $e->getMessage());
        }
    }

    public function deleteEnterprise(int $enterprise_id){
       
        // If the enterprise isn't within our database
        if(!$this->getEnterpriseById($enterprise_id)){
            throw new Exception("The enterprise doesn't exist, dumping the request");
        }


        try{
        $query = "
        DELETE FROM Enterprise
        WHERE id_enterprise = :enterprise_id";

        $stmt = $this->database->prepare($query);


        $stmt->execute([":enterprise_id"=> $enterprise_id]);

        return true;
        }catch(PDOException $e){
            throw new Exception("Unable to delete the enterprise". $e->getMessage());
        }


    }



}