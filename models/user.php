<?php
namespace models{
    require_once('db_connection.php');

    // Handels queries and updates involving the users table
    class User{
        public static function getAll(){
            $conn = DBConnectionHandler::getConnection();
            $query = 'SELECT UserName, Email from `user`';
            $result = $conn->query($query);

            $data = array();
            while($row = $result->fetch_assoc()){
                $data[] = array($row['UserName'], $row['Email']);
            }
            //todo return array of User objects 

            return $data;
        }

        public static function create($uname, $email, $pw){
            $conn = DBConnectionHandler::getConnection();
            $query = sprintf('INSERT INTO user (UserName, Email, Password) VALUES(\'%s\',\'%s\',\'%s\')', $uname, $email, $pw);

            if (!$conn->query($query)) {
                echo "Error: " . $query . "<br>" . $conn->error;
            }
        }
        
    }
}
?>