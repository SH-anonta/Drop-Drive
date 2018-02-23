<?php
    // controllers are classes with get and post static methods
    // namespace Controllers;
    
namespace controllers{  
    require('utility/common.php');
    require('models/user.php');

    function postData($key){
        return isset($_POST[$key]) ? trim($_POST[$key]) : '';
    }

    function getUsers(){
        $file = fopen('./data/users.txt', 'r') or die('Users.txt data file not found');
        
        $users = array();
        while($line = fgets($file)){
            $row= explode(' ', $line);
            $users[trim($row[0])] = trim($row[1]);  //store user name, pasword pairs
        }

        fclose($file);
        return $users;
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

            $_page_message = 'Profile of user '. $uid;
            require('templates/message_page.php');
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
            
            $_user_list = \models\User::getAllUsers();
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
            require('templates/login.php');
        }

        //attempt to login a user given uesrname and password in post data
        public static function post(){
            $uname = postData('user_name');
            $pw = postData('password');

            $users = getUsers();
            
            $_page_message= '';
            // validate user
            if(isset($users[$uname]) && $users[$uname] === $pw){
                $_page_message= 'Login was successful. Welcome '. $uname;
            }
            else{
                $_page_message= 'Login failed';
            }
            
            require('templates/message_page.php');
        }
    }

    class Register{
        public static function get(){
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
                $_page_message = 'All data are valid';
                require('templates/message_page.php');
                \models\User::createUser($uname, $email, $pw);

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

}
?>