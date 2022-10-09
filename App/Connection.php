<?php

namespace App;

class Connection{

    public static function getConection(){
        try {
              
            $conn = new \PDO(
                "mysql:host=localhost;dbname=mcv;charset=utf8",
                "root",
                ""
            );
            return $conn;
            
        } catch (\PDOException $e) {
           
            echo 'Error Connection : ' . $e->getMessage();

        }
    }

   
}