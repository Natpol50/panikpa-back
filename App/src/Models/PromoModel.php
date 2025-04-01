<?php

    use App\Services\Database;
    
    class PromoModel{
        public $promotion_code;
        public $id_user;
        private PDO $database;

        public function __construct(){
            $this->database = Database::getInstance();
        }
        
        public function getUserPromo(){
            // Show the Promotion's users
            try{
                $sql = "SELECT id_user FROM Promotion WHERE promotion_code = :promotion_code";
                $stmt = $this->database->prepare($sql);;
                $stmt->execute(['promotion_code' => $this->promotion_code]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            catch(PDOException $e){
                echo "Erreur : " . $e->getMessage();
                return [];
            }
        }

        public function createPromo($code_promo){
            // Create a new promotion
            $this->promotion_code = $code_promo;

            try{
                $sql = "INSERT INTO Promotion (promotion_code) VALUES (:promotion_code)";
                $stmt = $this->database->prepare($sql);
                $stmt->bindParam(":prmotion_code", $$this->promotion_code, PDO::PARAM_STR);
                if($stmt->execute()){
                    echo "La promotion" . htmlspecialchars($$this->promotion_code) ." a été créée.<br>";
                }
            }
            catch(PDOException $e){
                echo "Erreur lors de la création de la promotion : ". $e->getMessage() . "<br>";
            }
        }

        public function linkUserPromo($promo_code, $user_id){
            // Link a user to a promotion
            $this->promotion_code = $promo_code;
            $this->id_user = $user_id;

            try{
                $sql = "INSERT INTO Promotion (promotion_code, id_user) VALUES (:promotion_code, :id_user)";
                $stmt = $this->database->prepare($sql);
                $stmt->bindParam(":promotion_code", $this->promotion_code, PDO::PARAM_STR);
                $stmt->bindParam(":id_user", $this->id_user, PDO::PARAM_INT);
                if( $stmt->execute()){
                    echo "L'utilisateur $this->id_user a été lié à la promotion $this->promotion_code.<br>";
                }
            }
            catch(PDOException $e){
                echo "Erreur lors de l'association de l'utilisateur : ". $e->getMessage() . "<br>";
            }
        }

        public function unlinkUserPromo($promo_code, $user_id){
            // Unlink a user of a promotion
            $this->promotion_code = $promo_code;
            $this->id_user = $user_id;
            
            try{
                $sql = "DELETE FROM Promotion WHERE promotion_code = :promotion_code AND id_user = :id_user";
                $stmt = $this->database->prepare($sql);
                $stmt->bindParam(":promotion_code", $promo_code, PDO::PARAM_STR);
                $stmt->bindParam(":id_user", $user_id, PDO::PARAM_INT);
                if( $stmt->execute()){
                    echo "L'utilisateur $this->id_user a été retiré de la promotion $this->promotion_code";
                }
            }
            catch(PDOException $e){
                echo "Erreur lors de la suppression de l'utilisateur : " . $e->getMessage() . "<br>";
            }
        }

        public function deletePromo(){
            // Delete a promotion
            try{
                if( $this->promotion_code){
                    $sql = "DELETE FROM Promotion WHERE promotion_code = :promotion_code";
                    $stmt = $this->database->prepare($sql);
                    $stmt->bindParam(":promotion_code", $this->promotion_code, PDO::PARAM_STR);
                    if($stmt->execute()){
                        echo "La promotion $this->promotion_code a été supprimée.<br>";
                    }
                }
                else{
                    echo "Cette promotion n'existe pas.<br>";
                }
            }
            catch(PDOException $e){
                echo "Erreur lors de la suppressions de la promotion : " . $e->getMessage() . "<br>";
            }
        }
    }
?>