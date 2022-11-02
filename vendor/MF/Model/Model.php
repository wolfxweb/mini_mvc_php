<?php


namespace MF\Model;

use App\Connection;

abstract class Model extends Connection {

    private $conn;
    function __construct() {
       $this->conn = new getPdo();
    }
    protected static function conn(){
      //  return Connection::getConection();
    }
   
    

    protected static function selectSql($query){
        $conn = Connection::getConection();
        $response =  $conn->query($query)->fetchAll();
        return $response;
    }
    protected static function insertSql($query,$param){
        try {
          $conn = Connection::getConection();  
          $stmt   = $conn->prepare($query);
          $stmt->execute();
        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
     
    }
}