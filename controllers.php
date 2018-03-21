<?php
    // controllers are classes with get and post static methods
    // namespace Controllers;
    
namespace controllers{  
    require_once('utility/common.php');
    require_once('models/user.php');
    require_once('utility/session_facade.php');
    require_once('utility/user_storage_handler.php');
    
    // putting this here makes $_SESSION available to every request
    session_start();

    function postData($key){
        return isset($_POST[$key]) ? trim($_POST[$key]) : '';
    }

    class HomePage{
        public static function get(){
            require('templates/homepage.php');
            // $context = array();
            // return array('homepage.php', $context);
        }
    }

    class About{
        public static function get(){
            require('templates/about.php');
        }
    }

    class UserProfile{
        public static function get(){
            $uid = UserProfile::getUserId();

            $_user_id = $uid;
            $_user = \models\User::getByID($uid);

            if($_user){
                require('templates/user_profile.php');
            }
            else{
                require('templates/error404.php');
            }

            
        }

        private static function getUserId(){
            $pattern = '/user\/(\d+)/';
            $url = \utility\common\getRequestURI();

            preg_match($pattern, $url, $match);
            
            return $match[1];
        }
    }

    class UserList{
        public static function get(){
            require_once('models/user.php');
            
            $_user_list = \models\User::getAll();
            require('templates/user_list.php');
        }
    }

    //This dispatcher get executed if no patterns could match the request url
    class Error404{
        public static function get(){
            require('templates/error404.php');
        }

        public static function post(){
            require('templates/error404.php');
        }
    }

    class Login{
        //get the login page
        public static function get(){
            if(\utility\session\Session::userIsLoggedIn()){
                // if user is logged in, redirect them to homepage
                header('location:/filehost/');
                return;
            }

            require('templates/login.php');
        }

        //attempt to login a user given uesrname and password in post data
        public static function post(){
            $uname = postData('user_name');
            $pw = postData('password');
            
            $_page_message= '';
            // validate user

            $user = \models\User::authenticateUser($uname, $pw);
            if($user){
                \utility\session\Session::setUser($user);
                header('location:/filehost/files/');
            }
            else{
                $_page_message= 'Login failed';
                header('location:/filehost/login');
            }
            
            
        }
    }

    class Logout{
        public static function get(){
            \utility\session\Session::clearUser();
            header('location:/filehost/');
        }
    }

    class Register{
        public static function get(){
            if(\utility\session\Session::userIsLoggedIn()){
                // if user is logged in, redirect them to homepage
                header('location:/filehost/');
                return;
            }

            require('templates/register.php');
        }

        public static function post(){
            // these variables are also used in the register.php template
            // used to show previously posted data
            $uname =      \utility\common\getPostData('user_name');
            $email =      \utility\common\getPostData('email');
            $pw =         \utility\common\getPostData('password');
            $confirm_pw = \utility\common\getPostData('confirm_password');

            $errors= self::validateData($uname, $email, $pw, $confirm_pw);
            
            // if there are validation errors
            if(!empty($errors)){
                $_registeration_error_list = $errors;
                require('templates/register.php');
            }
            else{
                // if registration data is valid, create user entry in db, create folder for user storage folder and redirect to login page
                $user = \models\User::create($uname, $email, $pw);
                
                \utility\storage\UserStorage::createStorageForUser($user);
                header('location:/filehost/login');
            }
        }

        private static function validateData($uname, $email, $pw, $confirm_pw){
            $errors = array();

            $errors= array_merge($errors, self::validateUserName($uname));
            $errors= array_merge($errors, self::validateEmail($email));
            $errors= array_merge($errors, self::validatePassword($pw));
            $errors= array_merge($errors, self::validateConfirmPassword($pw, $confirm_pw));

            return $errors;
        }

        // data validators

        function validateUserName($uname){
            $errors = array();

            // a valid username is alphabetic characters of length 4-20
            $valid_pattern = '/^[a-zA-Z]{4,20}$/';

            if($uname == ''){
                $errors[]= 'User name is required';
            }
            else if(! preg_match($valid_pattern, $uname)){
                $errors[]= 'Username must be alphabet characters only and 4 to 20 characters long';
            }
            else if(\models\User::getByUserName($uname)){
                $errors[]= 'This user name is taken';
            }

            return $errors;
        }

        function validateEmail($email){
            $errors = array();

            //valid email pattern
            $email_pattern = '/[a-z]+?\w*@\w+\.\w+/';

            if($email == ''){
                $errors[]= 'Email number is required';
            }
            else if(!preg_match($email_pattern, $email)){
                $errors[]= 'Invalid email address';
            }
            else if(\models\User::getByEmail($email)){
                $errors[]= 'This email is registered with another account';
            }

            // todo add check for existing email in db
            return $errors;
        }

        function validatePassword($password){
            $errors = array();
            $pw_len = strlen($password);

            if($password == ''){
                $errors[]= 'Password is required';
            }
            else if($pw_len < 8){
                $errors[]= 'Password must be atleast 8 characters long';
            }
            else if($pw_len > 512){
                $errors[]= 'Password can not be longer than 512 characters';
            }

            return $errors;
        }

        function validateConfirmPassword($pw, $confirm_pw){
            $errors = array();

            if($pw != $confirm_pw){
                $errors[]= 'Passwords do not match';
            }

            return $errors;
        }
        
    }

    // when users request to get some file or folder in their DropDrive storage
    class Files{
        public static function get(){
            if(! \utility\session\Session::userIsLoggedIn()){
                // if user is not logged in, redirect them to the login page
                header('location:/filehost/login');
                return;
            }

            $_current_dir = self::extractFileDir();
            $_current_dir = trim($_current_dir,'/');

            $user = \utility\session\Session::getUser();
            
            if(! \utility\storage\UserStorage::directoryIsValid($_current_dir)){
                // if file or directory does not exist, show error 404
                require('templates/error404.php');
                return;
            }


            if(! \utility\storage\UserStorage::isFolder($_current_dir)){
                // if the requested path is a file, download it
                // this will set header values and read the requested file
                \utility\storage\UserStorage::downloadFile($_current_dir);
                die();
            }

            $_file_list = \utility\storage\UserStorage::getFile($_current_dir);

            // var_dump($files);
            require('templates/files.php');
        }

        private static function extractFileDir(){
            $pattern = '/^files\/([\w-_\/%+\.]*)$/';
            $url = \utility\common\getRequestURI();

            preg_match($pattern, $url,$match);
            $path = $match[1];

            return $path;
        }
    }

    // handle requests for a detailed list of file in certain folder in the users' storage
    class FileList{

        // assumes the following POST data are set: 
        // parent_dir : directory to the folder of which the files will be listed, blank means root folder
        public static function post(){
            if(! \utility\session\Session::userIsLoggedIn()){
                // if user is not logged in, redirect them to the login page
                header('location:/filehost/login');
                return;
            }

            $user = \utility\session\Session::getUser();
            $dir = \utility\common\getPostData('current_dir');

            $file_list = \utility\storage\UserStorage::getFilesInFolder($dir);

            echo 'here ', $dir;
            var_dump($file_list);
            // var_dump($_POST);
            // echo '<br>';
            // echo 'hello';
        }

    }

    class Upload{
        public function post(){
            $parent_dir = $_POST['parent_folder_path'];
            $file = $_FILES['file'];

            // todo check for filename conflicts

            \utility\storage\UserStorage::uploadFile($file, $parent_dir);
            header(sprintf('location:/filehost/files/%s', $parent_dir));
        }
    }

    // handels request for creating folders in users' storage
    class MakeDirectory{
        public static function post(){
            $parent_dir = $_POST['parent_folder_path'];
            $folder_name = $_POST['folder_name'];

            if(! \utility\storage\UserStorage::directoryIsValid($parent_dir)){
                // if parent directory does not exist, show error 404
                $_page_message = 'Something went wrong, parent folder does not exist';
                require('templates/message_page.php');
                return;
            }

            $errors = self::validateFolderName($folder_name);
            
            if(!empty($errors)){
                // if folder name is invalid, show error message
                $_page_message = $errors[0];
                require('templates/message_page.php');
                return;
            }
            
            \utility\storage\UserStorage::createDirectory($parent_dir, $folder_name);
            header(sprintf('location:/filehost/files/%s', $parent_dir));
        }

        private static function validateFolderName($folder_name){
            $valid_folder_name_pattern = '/^[\w-_ ]+$/';
            
            $errors = array();
            
            if(!preg_match($valid_folder_name_pattern, $folder_name)){
                $errors[]  = 'Invalid folder name';
            }

            return $errors;
        }

    }
}
?>