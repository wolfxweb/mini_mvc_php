<?php


namespace MF\Model;

use App\Connection;

abstract class Model{

   
    protected static function conn(){
        return Connection::getConection();
    }
   

    protected static function selectSql($query){
        $conn = self::conn();
        $response =  $conn->query($query)->fetchAll();
        return $response;
    }
    protected static function insertSql($query){
      $conn = self::conn();
      $sql  = "INSERT INTO usuario  (usu_name) VALUES ('query')";
      $conn->query($sql);
    }
}