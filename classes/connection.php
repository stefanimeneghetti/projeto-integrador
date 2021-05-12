<?php
    class Connection{
        // atributo
        public static $connection;
        private static $db_connection;
        private static $db_name;
        private static $db_host;
        private static $db_user;
        private static $db_password;
        
        public static function connect() {
            if(!isset(self::$connection)){
                try{
                    self::$db_connection = "mysql";
                    self::$db_name = "integrador";
                    self::$db_host = "localhost";
                    self::$db_user = "root";
                    self::$db_password = "";
                    $connection_string = self::$db_connection.":host=".self::$db_host."; dbname=".self::$db_name;
                    self::$connection = new PDO($connection_string, self::$db_user, self::$db_password);
                }
                catch(PDOException $e){
                    echo "Erro de conexão: ". $e->getMessage();
                    die();
                }
            }
            return self::$connection;
        }
    }
?>