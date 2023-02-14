<?php
namespace App;
use PDO;
use PDOException;

class Connection{
        
        public function getDb(){
            $servername = "localhost";
            $username = "newuser";
            $password = "password";
            $dbname='twitter_clone';
            
            try {
              $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
              // set the PDO error mode to exception
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              return $conn;
            } catch(PDOException $e) {
              echo "Connection failed: " . $e->getMessage();
            }
        }

}