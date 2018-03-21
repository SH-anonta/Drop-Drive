<?php
namespace models{
    class DBConnectionHandler{
        private static $servername = "localhost";
        private static $username = 'root';
        private static $password = '';
        private static $dbname = 'filehoster';
        
        private static $db_connection = null;

        public function connect_to_db(){
            self::$db_connection = new \mysqli(
                self::$servername,
                self::$username,
                self::$password,
                self::$dbname
            );

            if(self::$db_connection->connect_error){
                die('Connection failed: '. $db_connection->connect_error);
            }
        }

        public static function getConnection(){
            if(self::$db_connection === null){
                self::connect_to_db();
            }

            return self::$db_connection;
        }

        public static function query($query){
            $conn = self::getConnection();
            $result = $conn->query($query);

            if(!$result){
                echo "Error: " . $query . "<br>" . $conn->error;
            }

            return $result;
        }
    }
}
    
?>