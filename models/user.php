<?php
namespace models{
    require_once('db_connection.php');

    // Handels queries and updates involving the users table
    class User{
        //columns in the table
        public $id;
        public $user_name;
        public $email;

        //intentionally private constructor
        private function __construct($id, $uname, $email){
            $this->id = $id;
            $this->user_name = $uname;
            $this->email = $email;
        }

        // take asosciative array of uesr row, return equivilant user object
        private static function assocToObj($assoc){
            return new User($assoc['ID'], $assoc['UserName'], $assoc['Email']);
        }

        public static function getAll(){
            $conn = DBConnectionHandler::getConnection();
            $query = 'SELECT * from `user`';
            $result = $conn->query($query);

            $data = array();
            while($row = $result->fetch_assoc()){
                $data[] = self::assocToObj($row);
            }

            return $data;
        }

        public static function create($uname, $email, $pw){
            $query = sprintf('INSERT INTO user (UserName, Email, Password) VALUES(\'%s\',\'%s\',\'%s\')', $uname, $email, $pw);
            DBConnectionHandler::query($query);

            return self::getByUserName($uname);
        }

        public static function getByID($id){
            $query = sprintf('SELECT * from user where ID = \'%s\'', $id);

            $result = DBConnectionHandler::query($query);

            if($result->num_rows == 0){
                return null;
            }
            else{
                return self::assocToObj($result->fetch_assoc());
            }
        }

        // find user by UserName, return null if not found
        public static function getByUserName($uname){
            $query = sprintf('SELECT * from user where UserName = \'%s\'', $uname);
            $result = DBConnectionHandler::query($query);

            if($result->num_rows == 0){
                return null;
            }
            else{
                return self::assocToObj($result->fetch_assoc());
            }
        }

        // find user by Email, return null if not found
        public static function getByEmail($email){
            $query = sprintf('SELECT * from user where Email = \'%s\'', $email);
            $result = DBConnectionHandler::query($query);

            if($result->num_rows == 0){
                return null;
            }
            else{
                return self::assocToObj($result->fetch_assoc());
            }
        }

        // see if name and password match,
        // return user object if username and password are valid
        public static function authenticateUser($uname, $pw){
            $query = sprintf('SELECT * from user where UserName=\'%s\' and Password=\'%s\' ', $uname, $pw);
            
            $result = DBConnectionHandler::query($query);

            if($result->num_rows){
                return self::assocToObj($result->fetch_assoc());
            }

            return null;
        }
        
    }
}
?>