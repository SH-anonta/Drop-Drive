<?php
namespace models{
    require_once('db_connection.php');

    // Handels queries and updates involving the users table
    class User{
        public static function getAll(){
            $conn = DBConnectionHandler::getConnection();
            $query = 'SELECT * from `user`';
            $result = $conn->query($query);

            $data = array();
            while($row = $result->fetch_assoc()){
                $data[] = array($row['UserName'], $row['Email'], $row['ID']);
            }
            //todo return array of User objects 

            return $data;
        }

        public static function create($uname, $email, $pw){
            $query = sprintf('INSERT INTO user (UserName, Email, Password) VALUES(\'%s\',\'%s\',\'%s\')', $uname, $email, $pw);
            DBConnectionHandler::query($query);
        }

        public static function getByID($id){
            $query = sprintf('SELECT * from user where ID = \'%s\'', $id);

            $result = DBConnectionHandler::query($query);

            if($result->num_rows == 0){
                return null;
            }
            else{
                return $result->fetch_assoc();
            }
        }

        public static function authenticateUser($uname, $pw){
            $query = sprintf('SELECT ID from user where UserName=\'%s\' and Password=\'%s\' ', $uname, $pw);
            
            $result = DBConnectionHandler::query($query);

            return $result->num_rows != 0;
        }
        
    }
}
?>