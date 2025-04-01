<?php

    /**
     * Class/object representing a specific user in the system, contains all the informations about that specific user
     * 
     * Methods : 
     * 
     * getUserID() : returns the user ID of the user object
     * 
     */
    class UserObject{

        /**
         * All of the user information is stored in this object.
         * @var
         */
        public $id_user;
        public $user_phash;
        public $user_name;
        public $user_fname;
        public $user_stype;
        public $user_email;
        public $user_phone;
        public $user_gender;
        public $user_photo_url;
        public $user_creation_date;
        public $user_refresh_token_date;
        public $user_refresh_token;
        public $id_acctype; // 1 to 6
        public array $promotion_code;

        public function __construct(array $data){
            $this->id_user = $data['id_user'] ?? null;
            $this->user_phash = $data['user_phash'] ?? null;
            $this->user_name = $data['user_name'] ?? null;
            $this->user_fname = $data['user_fname'] ?? null;
            $this->user_stype = $data['user_stype'] ?? null;
            $this->user_email = $data['user_email'] ?? null;
            $this->user_phone = $data['user_phone'] ?? null;
            $this->user_gender = $data['user_gender'] ?? null;
            $this->user_photo_url = $data['user_photo_url'] ?? null;
            $this->user_creation_date = $data['user_creation_date'] ?? null;
            $this->user_refresh_token_date = $data['user_refresh_token_date'] ?? null;
            $this->user_refresh_token = $data['user_refresh_token'] ?? null;
            $this->id_acctype = $data['id_acctype'] ?? null;
            $this->promotion_code = $data['promotion_code'] ?? [];
            $this->user_stype = $data['userSType'] ?? null;
        }

        public function setUserID(int $user_id): null
        {
            $this->id_user = $user_id;
            return null;
        }
    }
?>