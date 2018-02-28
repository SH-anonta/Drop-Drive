<?php
namespace utility\session{
    // Session variables 
    // user -> \models\User object, only set if the user is logged in
    
        class Session{
            public static function setUser($user){
                session_start();
                $_SESSION['user'] = $user;
            }

            public static function getUser(){
                session_start();
                return $_SESSION['user'];
            }

            public static function clearUser(){
                session_start();
                return $_SESSION['user'] = null;
            }

            public static function userIsLoggedIn(){
                return isset($_SESSION['user']) && $_SESSION['user'] != null;
            }
        }
        
}
?>