<?php
    // controllers are classes with get and post static methods
    // namespace Controllers;

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
            $context = array();
            return array('templates/user_profile.php', $context);
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
        public static function get(){
            require('templates/login.php');
        }

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

        }
    }
?>