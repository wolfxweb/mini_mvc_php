<?php


namespace MF\Model;

use App\Connection;

abstract class Model extends Connection {

    private $conn;
    function __construct() {
       $this->conn = new getPdo();
    }
 
     protected static function delete($tabela , $where ){

      try {
        $query = "SELECT count(*) as qtd FROM $tabela  WHERE $where";
        $data =  self::selectSql($query);
        if($data[0]['qtd'] > 0){
          $query = "DELETE FROM $tabela  WHERE $where ";
          return self::execSql($query);
        }else{
         echo "Item não encontrado.";
        }

      } catch (\PDOException $e) {
          echo  $e->getMessage();
      }
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
        return $conn->exec($query);
      } catch (\PDOException $e) {
          echo 'Error: ' . $e->getMessage();
      }
    }

    protected static function countTabela($tabela, $coluna){
      try {
        $query = "SELECT COUNT($coluna) as qtd FROM $tabela ";
        return  self::selectSql($query);
      } catch (\PDOException $e) {
          echo  $e->getMessage();
      }
    return  false;
  }
  protected static function getTabela($stmSQL,$request,$colunas){

    try {
      $searchTable = null;
      if(!empty($request['search']['value'])){
         $valueSearch = "'%".$request['search']['value']."%'";
        // $searchTable = " where prod.pro_id LIKE {$valueSearch} OR prod.prod_nome LIKE {$valueSearch}  OR cat.cat_nome LIKE {$valueSearch} OR unid.unid_nome LIKE {$valueSearch} OR prod.prod_preco LIKE {$valueSearch}";
        foreach($colunas as $key => $coluna){ 
          if($key == 0){
            $searchTable .= " where {$coluna} LIKE {$valueSearch}";
          }else{
            $searchTable .= " or {$coluna} LIKE {$valueSearch}";
          }
        }
      }
      $dataTableOrder = " ORDER BY {$colunas[$request['order'][0]['column']]}  {$request['order'][0]['dir']}  LIMIT {$request['start']} , {$request['length']} ";
      if(!empty($searchTable)){
        $stmSQL .= $searchTable;
      }
      if(!empty($dataTableOrder)){
        $stmSQL .= $dataTableOrder;
      }
      return self::selectSql($stmSQL);
    } catch (\PDOException $e) {
        echo  $e->getMessage();
    }
  return  false;
}
}