<?php
    require_once('controllers.php');

    class Router{
        
        // routes are (regex pattern,controller) pairs
        private static $routes = array(
            array('/^$/',           \controllers\HomePage::class),      //
            array('/^login$/',      \controllers\Login::class),         // login
            array('/^logout$/',     \controllers\Logout::class),        // logout
            array('/^register$/',   \controllers\Register::class),      // register
            array('/^about$/',      \controllers\About::class),         // about
            array('/^user\/(\d+)$/',\controllers\UserProfile::class),   // user/<int:user_id>
            array('/^user\/all$/',  \controllers\UserList::class),      // user/all
            array('/^files\/([\w-_\/%+\.]*)$/',  \controllers\Files::class),  // files/home
            array('/^file-list$/',  \controllers\FileList::class),  // files-list
            array('/^upload$/',  \controllers\Upload::class),      // upload
            array('/^mkdir$/',  \controllers\MakeDirectory::class),      // upload
        );
               
        // find and return a matching controller for a given url
        public static function resolveUrl($uri){
            foreach(self::$routes as $route){
                if(preg_match($route[0],$uri)){
                    return $route[1];
                }
            }

            // no patterns match given url, show 404 msg page
            return controllers\Error404::class;
        }
    }
?>