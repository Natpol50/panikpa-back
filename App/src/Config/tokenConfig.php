<?php

// This the root class from which TokenService will inherit, it contain values to decide of the parameters for the tokens

/*


    You can change :

    - The secret key used to encode decode our JWT

    - The name of the coockie stored

    - the life expectancy of a JWT

    - From when a JWT is close from be considered as expiring in a short moment

    - How long a refresh token i considered as alive


*/

class TokenConfig{

    protected $secretKey = null; // The key to code and decode our JWT
    public $token_name = null; // The name for our token


     // Variables for deciding how long our JWT can survive

     protected $day = 0;
     protected $hours = 4;
     protected $minutes = 0;
     protected $life_expectancy = null;


     // Variables for the time given before a token is considered close from expirering

     protected $token_expiration_closeness_day = 0;
     protected $token_expiration_closeness_hours = 0;
     protected $token_expiration_closeness_minutes = 30;
     protected $time_limit_before_refresh = null;

     // Variables for the time given before a refresh token is considered as expired

     protected $refresh_day = 30;
     protected $time_limit_before_refresh_expires = null;
}