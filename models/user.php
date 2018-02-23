<?php
namespace models{
    require_once('db_connection.php');

    // Handels queries and updates involving the users table
    class User{
        public static function getAllUsers(){
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
        
    }
}
?>