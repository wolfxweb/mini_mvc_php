<?php
namespace App\Classes;

use MF\Model\Model as Modelo;


class CategoriasClass extends Modelo{


  public static function getCategorias($id = null ,$statusSigla = [] ,$dataTableOrder=null ,$searchTable =null ){
       /*
        este metodo pode ser passado o paramentro id para filtar pro um  por uma categora em especifica
        ou filtrar pelo  status passando um array com as siglas a serem filtradas
        */
       $stmSQL  = "select cat.cat_id, cat.cat_nome, cat.cat_descricao,cat.cat_padrao from categorias cat  ";
        if($id){
            $stmSQL .= " where cat.cat_id = $id ";
        }
        if(!empty($searchTable)){
          $stmSQL .= $searchTable;
        }
      //  $stmSQL .= " ORDER BY cat.cat_id DESC ";
        if(!empty($dataTableOrder)){
          $stmSQL .= $dataTableOrder;
        
        }

        return self::selectSql($stmSQL);
    }

  public static function filtrarCategoria($string){
  
    $stmSQL  = "select cat.cat_id, cat.cat_nome, cat.cat_descricao from categorias cat  ";
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
  protected static function countCategorias(){
    try {
      $query = "SELECT COUNT(cat_id) as qtd_categorias FROM categorias ";
      return  self::selectSql($query);
    } catch (\PDOException $e) {
        echo  $e->getMessage();
    }
  return  false;
}
  public static function tabelaCategorias(){
   
    $request =  $_REQUEST;
     
    $colunas=[
      0=>'cat_id',
      1=>'cat_nome',
      2=>'cat_descricao',
      3=>'cat_id'
    ];
   
    //filtro
    $searchTable = null;
    if(!empty($request['search']['value'])){
      $valueSearch = "'%".$request['search']['value']."%'";
      $searchTable = " where cat.cat_id LIKE {$valueSearch} OR cat.cat_nome LIKE {$valueSearch} OR cat.cat_descricao LIKE {$valueSearch}";

    }
    // ordenação da tabela
    $dataTableOrder = " ORDER BY {$colunas[$request['order'][0]['column']]}  {$request['order'][0]['dir']}  LIMIT {$request['start']} , {$request['length']} ";

    try {
      $dataCategorias = self::getCategorias(NULL,[],$dataTableOrder,$searchTable);
      $dataCountCategoria = self::countCategorias();

      //** montando a linha da tabela */
      foreach($dataCategorias as $dataCategoria){
        $registro=[];
        $registro['cat_id']=$dataCategoria['cat_id'];
        $registro['cat_nome']=$dataCategoria['cat_nome'];
        $registro['cat_descricao']=$dataCategoria['cat_descricao'];
        $registro['cat_acao'] = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">';
        $registro['cat_acao'].= '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalCat'.$dataCategoria["cat_id"].'"><i class="bi bi-trash"></i></button>';  
        $registro['cat_acao'].= '<button type="button" class="btn btn-success"  onclick="editCategoria('.$dataCategoria["cat_id"].')"><i class="bi bi-pencil"></i></button>';                
        $registro['cat_acao'].= '</div>';
        $registro['cat_acao'].= '<div class="modal fade" id="modalCat'.$dataCategoria["cat_id"].'" data-bs-backdrop="static"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"  aria-hidden="true">';
        $registro['cat_acao'].= '<div class="modal-dialog modal-dialog-centered">';
        $registro['cat_acao'].= '<div class="modal-content">';
        $registro['cat_acao'].= '<div class="modal-header"> <h5 class="modal-title" id="staticBackdropLabel">Excluir categoria</h5>  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>';
        $registro['cat_acao'].= '<div class="modal-body"><h6>Deseja mesmo excluir a categoria '.$dataCategoria['cat_nome'].'?</h6><p>Esta ação e ireversivel.</p></div>';
        $registro['cat_acao'].= '<div class="modal-footer">';
        $registro['cat_acao'].= '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>';
        $registro['cat_acao'].= '<button type="button" class="btn btn-danger"  onclick="deletarCategoria('.$dataCategoria["cat_id"]. ')">Excluir</button>';
        $registro['cat_acao'].= '</div></div></div></div>';
        $registro['cat_acao'].= ' <INPUT TYPE="hidden" id="cat_id'.$dataCategoria["cat_id"].'" NAME="catEdit" VALUE="'.$dataCategoria["cat_id"].'" catNome="'.$dataCategoria['cat_nome'].'" catDescricao="'.$dataCategoria['cat_descricao'].'">';
        $dados[]= $registro;
      }
     if(empty($dados)){
        $registro=[];
        $registro['cat_id']='';
        $registro['cat_nome']='';
        $registro['cat_descricao']='Nenhuma categoria encontrada.';
        $registro['cat_acao'] = '';
        $dados[]= $registro;
     }
      $resultado =[
        "draw"=>intval($request['draw']),// enviado na requisição
        "recordsTotal"=>intval($dataCountCategoria[0]['qtd_categorias']),
        "recordsFiltered"=>intval($dataCountCategoria[0]['qtd_categorias']),
        "data"=>$dados

      ];
      return json_encode($resultado);
 
    } catch (\Throwable $e) {
      echo  $e->getMessage();
    }



 //  echo "TABELA CATEGORIAS weqw";
  }

 
}