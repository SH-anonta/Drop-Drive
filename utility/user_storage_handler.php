<?php
namespace utility\storage{
    require_once('utility/session_facade.php');

    // This class handels all file access and writing in the users' storage
    // A file path inside the users' storage will be mapped to the actual path in 
    class UserStorage{

        // json format: 
        public static function getFilesInFolder($dir){
            $dir = self::getRealPath($dir);

            // includes name of  files and folders in $dir
            $files = scandir($dir);

            $file_list = array();
            
            foreach($files as $f){
                // absolute path to path
                $full_path = sprintf('%s%s', $dir, $f);
                $fdetail = array();

                $fdetail['name'] = urldecode($f);
                $fdetail['encoded_name'] = $f;
                $fdetail['size'] = filesize($full_path);
                $fdetail['type'] = is_dir($full_path) ? 'folder': 'file';
                $file_list[] = $fdetail;
            }
            
            return $file_list;
        }

        public static function getFile($dir){
            $dir = self::getRealPath($dir);
            return scandir($dir);
        }

        public static function directoryIsValid($dir){
            $dir = self::getRealPath($dir);
            return is_dir($dir) || file_exists($dir);
        }

        public static function fileWithPathExists($dir){
            $dir = self::getRealPath($dir);
            return is_dir($dir) || file_exists($dir);
        }

        // This maps user storage paths to actual paths
        private static function getRealPath($dir){
            $user = \utility\session\Session::getUser();

            // directory should be : document_root/filehost/user_storage/<int:user_id>/<path to file>
            return sprintf('%s/filehost/user_storage/%s/%s', $_SERVER['DOCUMENT_ROOT'], $user->id, $dir);
        }

        public static function isFolder($path){
            $path = self::getRealPath($path);
            return is_dir($path);
        }

        // attaches a file to response
        // unescapes the file name characters using urldecode();
        public static function downloadFile($path){
            $path = self::getRealPath($path);

            $path_parts = explode('/', $path);
            $filename = end($path_parts);

            header("Content-Transfer-Encoding: Binary");
            header("Content-Length:".filesize($path));
            header(sprintf("Content-Disposition: attachment;filename=%s", urldecode($filename)));
            readfile($path);
        }

        // this will escape some characters in file name using urlencode
        public static function uploadFile($file, $parent_dir){
            $parent_dir = self::getRealPath($parent_dir);
            $new_file_path = sprintf('%s%s', $parent_dir, urlencode($file['name']));
            
            // var_dump($new_file_path);
            $success = move_uploaded_file($file["tmp_name"], $new_file_path);
            if(!$success){
                die('Upload failed');
            }

        }

        public static function createStorageForUser($user){
            $new_dir_path = sprintf('%s/filehost/user_storage/%s', $_SERVER['DOCUMENT_ROOT'], $user->id);

            if(self::directoryIsValid($new_dir_path)){
                die('Something went wrong. Storage folder of User ID already exists');
            }

            mkdir($new_dir_path);
        }

        public static function createDirectory($parent_dir, $folder_name){
            $parent_dir = self::getRealPath($parent_dir);
            $folder_name = urlencode($folder_name);

            mkdir($parent_dir . '/'. $folder_name);
        }

        //delete folder or file in user storage
        // keep running silently if said file not found
        public static function deleteFile($path){
            $path = self::getRealPath($path);
            if(!is_dir($path)){
                unlink($path);
            }
            else{
                echo 'can\'t delete folders yet';
            }
            // var_dump($path);
        }


    }
}

?>