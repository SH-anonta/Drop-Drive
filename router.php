<?php
    require_once('controllers.php');

    class Router{
        
        // routes are (regex pattern,controller) pairs
        private static $routes = array(
            array('/^$/', HomePage::class),                 //home page
            array('/^login$/', Login::class),               //login
            array('/^register$/', Register::class),         //register
            array('/^about$/', About::class),               //about
            array('/^user\/(\d+)$/', UserProfile::class),   //user/<int:user_id>
        );
               
        // find and return a matching controller for a given url
        public static function resolveUrl($uri){
            foreach(self::$routes as $route){
                if(preg_match($route[0],$uri)){
                    return $route[1];
                }
            }

            // no patterns match given url, show 404 msg page
            return Error404::class;
        }
    }
?>