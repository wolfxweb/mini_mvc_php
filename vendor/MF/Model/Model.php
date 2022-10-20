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
          var_dump('insertSql');
          $conn = Connection::getConection();
          $stmt   = $conn->prepare($query);

          foreach ($param as $key => $value) {
             $keyAjust =$key+1;
             $stmt->bindParam($keyAjust, $value);
          }
          
          var_dump( $stmt );
       //   var_dump($param);


          /*
            $conn = Connection::getConection();
            $stmt   = $conn->prepare("INSERT INTO usuario (usu_name) VALUES (?)");
            $stmt->bindParam(1, $query);
            $stmt->execute();
          */
        //  $conn->close();
        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
     
    }
}