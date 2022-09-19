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
           
            echo "ops sem conecção com banco de dados";

        }
    }
}