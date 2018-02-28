<?php

namespace utility\session{
    // Session variables 
    // user -> \models\User object, only set if the user is logged in
    
    //class assumes session_start() has been invoked before it gets executed
    class Session{
        public static function setUser($user){
            $_SESSION['user'] = $user;
        }

        public static function getUser(){
            return $_SESSION['user'];
        }

        public static function clearUser(){
            return $_SESSION['user'] = null;
        }

        public static function userIsLoggedIn(){
            return isset($_SESSION['user']) && $_SESSION['user'] != null;
        }
    }
        
}
?>