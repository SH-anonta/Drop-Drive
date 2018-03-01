<?php
namespace utility\storage{
    require_once('utility/session_facade.php');

    // This class handels all file access and writing in the users' storage
    // A file path inside the users' storage will be mapped to the actual path in 
    class UserStorage{

        public static function getFile($dir){
            $dir = self::getRealPath($dir);
            return scandir($dir);
        }

        public static function directoryIsValid($dir){
            $dir = self::getRealPath($dir);
            return is_dir($dir) || file_exists($dir);
        }

        // This maps user storage paths to actual paths
        private static function getRealPath($dir){
            $user = \utility\session\Session::getUser();

            return sprintf('%s/filehost/user_storage/%s/%s', $_SERVER['DOCUMENT_ROOT'], $user->id, $dir);
        }

        public static function isFolder($path){
            $path = self::getRealPath($path);
            return is_dir($path);
        }

        public static function downloadFile($path){
            $path = self::getRealPath($path);

            $path_parts = explode('/', $path);
            $filename = end($path_parts);

            header("Content-Transfer-Encoding: Binary");
            header("Content-Length:".filesize($path));
            header(sprintf("Content-Disposition: attachment;filename=%s", $filename));
            readfile($path);
            die();
        }
    }
}

?>