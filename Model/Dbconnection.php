<?php
class DbConnection{

    public function dbConnect(){

        $servername = "localhost";
        $dbname = "micole";
        $username = "benja";
        $password = "123";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e)
        {
            echo "Fallo ConexiÃ³n: " . $e->getMessage();
        }
    }
}