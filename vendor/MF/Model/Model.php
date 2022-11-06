<?php


namespace MF\Model;

use App\Connection;

abstract class Model extends Connection {

    private $conn;
    function __construct() {
       $this->conn = new getPdo();
    }
 
    

    protected static function selectSql($query){
       /** utilizar para select */
        $conn = Connection::getConection();
        $response =  $conn->query($query)->fetchAll(\PDO::FETCH_ASSOC);
        return $response;
    }
    protected static function insertSql($query){
      /** esta função e generica 
       * no Usuario model tem um exemplo com prepare 
       * melhoria para esta função criar o prepare dinamicamente
       */
        try {
          $conn = Connection::getConection();  
          $conn->exec($query);
        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }

    protected static function execSql($query){
      /** excuta qualquer sql */
      try {
        $conn = Connection::getConection();  
        $conn->exec($query);
      } catch (\PDOException $e) {
          echo 'Error: ' . $e->getMessage();
      }
    }
}