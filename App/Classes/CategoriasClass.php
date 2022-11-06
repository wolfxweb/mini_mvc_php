<?php
namespace App\Classes;

use MF\Model\Model as Modelo;


class CategoriasClass extends Modelo{


  public static function getCategorias($id = null ,$statusSigla = []){
       /*
        este metodo pode ser passado o paramentro id para filtar pro um  por uma categora em especifica
        ou filtrar pelo  status passando um array com as siglas a serem filtradas
        */
       $stmSQL  = "select cat.cat_id, cat.cat_nome, cat.cat_descricao,cat.cat_padrao from categorias cat  ";
        if($id){
            $stmSQL .= " where cat.cat_id = $id ";
        }

        return self::selectSql($stmSQL);
    }
  public static function filtrarCategoria($string){
    $stmSQL  = "select cat.cat_id, cat.cat_nome, cat.cat_descricao,cat.cat_padrao from categorias cat  ";
    $stmSQL .= " where cat.cat_nome like '%$string%' ";
    return self::selectSql($stmSQL);
  }
  public static function addCategoria($data){
    $nome = $data['nome'];
    $descricao =$data['descricao'];
    //INSERT INTO appLista.categorias (cat_id, cat_nome, cat_descricao, cat_padrao) VALUES(0, '', '', false);
    try {
        $query = "INSERT INTO categorias(cat_nome,cat_descricao) VALUES ('$nome','$descricao')";
        self::insertSql($query);
      } catch (\PDOException $e) {
          echo  $e->getMessage();
      }
    echo json_encode($data);
    return  false;
  }

  public static function updateCategoria($data){
    $cat_id =$data['cat_id'];
    $cat_nome = $data['cat_nome'];
    $cat_descricao =$data['cat_descricao'];
    try {
      $query = "UPDATE categorias SET cat_nome = '{$cat_nome}',cat_descricao= '{$cat_descricao}'  WHERE cat_id = $cat_id ";
      self::execSql($query);
    } catch (\PDOException $e) {
        echo  $e->getMessage();
    }
  }
  public static function deleteCategoria($data){
    $cat_id = $data['cat_id'];
   
    try {
      $query = "DELETE FROM categorias  WHERE cat_id = $cat_id ";
      self::execSql($query);
    } catch (\PDOException $e) {
        echo  $e->getMessage();
    }
  }

}