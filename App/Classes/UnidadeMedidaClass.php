<?php
namespace App\Classes;

use MF\Model\Model as Modelo;



class UnidadeMedidaClass extends Modelo{

  public static function adicionarAtualizarUnidadeMedida($data){
    if(!empty($data['unid_id'])){
      self::atualizarUnidadeMedidada($data);
    }else{
      self::salvarUnidadeMedidada($data);
    }
  }
  private static function salvarUnidadeMedidada($data){
    $stmSQL  = " insert into unidade_medida set unid_nome = '{$data['unid_nome']}' ";
    return   self::execSql($stmSQL);
  }
  private static function atualizarUnidadeMedidada($data){
    $stmSQL  = " update unidade_medida set unid_nome = '{$data['unid_nome']}' where unid_id = {$data['unid_id']}";
    return   self::execSql($stmSQL);
  }
  public static function getUnidadeMedida($id = null ,$statusSigla = [] ,$dataTableOrder=null ,$searchTable =null ){

    $stmSQL  = " select unid_id, unid_slug , unid_nome ,usu_id from unidade_medida   ";
     if($id){
         $stmSQL .= " where unid_id = $id ";
     }
     if(!empty($searchTable)){
       $stmSQL .= $searchTable;
     }
     if(!empty($dataTableOrder)){
       $stmSQL .= $dataTableOrder;
     }
     return self::selectSql($stmSQL);
 }

 protected static function countUnidadeMedida(){
    try {
      $query = "SELECT COUNT(unid_id) as qtd FROM unidade_medida ";
      return  self::selectSql($query);
    } catch (\PDOException $e) {
        echo  $e->getMessage();
    }
  return  false;
}

 public static function tabelaUnidadeMedida(){
   
    $request =  $_REQUEST;
    $colunas=[
      0=>'unid_id',
      1=>'unid_nome',
      2=>'unid_id'
    ];
       //filtro
    $searchTable = null;
    if(!empty($request['search']['value'])){
      $valueSearch = "'%".$request['search']['value']."%'";
      $searchTable = " where unid_id LIKE {$valueSearch} OR unid_nome LIKE {$valueSearch} ";

    }
    // ordenação da tabela
    $dataTableOrder = " ORDER BY {$colunas[$request['order'][0]['column']]}  {$request['order'][0]['dir']}  LIMIT {$request['start']} , {$request['length']} ";
   $dataTableOrder = null;
    try {
      $dataUnidadeMedida = self::getUnidadeMedida(NULL,[],$dataTableOrder,$searchTable);
      $dataCount = self::countUnidadeMedida();

      //** montando a linha da tabela */
      foreach( $dataUnidadeMedida as $data){
        $registro=[];
        $registro['unid_id']=$data['unid_id'];
        $registro['unid_nome']=$data['unid_nome'];

        $registro['unid_acao'] = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">';
        $registro['unid_acao'].= '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalUni'.$data["unid_id"].'"><i class="bi bi-trash"></i></button>';  
        $registro['unid_acao'].= '<button type="button" class="btn btn-success"  onclick="editUnidadeMedida('.$data["unid_id"].')"><i class="bi bi-pencil"></i></button>';                
        $registro['unid_acao'].= '</div>';
        $registro['unid_acao'].= '<div class="modal fade" id="modalUni'.$data["unid_id"].'" data-bs-backdrop="static"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"  aria-hidden="true">';
        $registro['unid_acao'].= '<div class="modal-dialog modal-dialog-centered">';
        $registro['unid_acao'].= '<div class="modal-content">';
        $registro['unid_acao'].= '<div class="modal-header"> <h5 class="modal-title" id="staticBackdropLabel">Excluir</h5>  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>';
        $registro['unid_acao'].= '<div class="modal-body"><h6>Deseja mesmo excluir a unidade de medida '.$data['unid_nome'].'?</h6><p>Esta ação e ireversivel.</p></div>';
        $registro['unid_acao'].= '<div class="modal-footer">';
        $registro['unid_acao'].= '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>';
        $registro['unid_acao'].= '<button type="button" class="btn btn-danger"  onclick="deletarUnidadeMedida('.$data["unid_id"]. ')">Excluir</button>';
        $registro['unid_acao'].= '</div></div></div></div>';
        $registro['unid_acao'].= ' <INPUT TYPE="hidden" id="unid_codigo'.$data["unid_id"].'" NAME="unidEdit" VALUE="'.$data["unid_id"].'" unid_nome="'.$data['unid_nome'].'" >';
        $dados[]= $registro;
      }
     if(empty($dados)){
        $registro=[];
        $registro['unid_id']='';
        $registro['unid_nome']='';
        $registro['unid_acao'] = '';
        $dados[]= $registro;
     }
      $resultado =[
        "draw"=>intval($request['draw']),// enviado na requisição
        "recordsTotal"=>intval($dataCount[0]['qtd']),
        "recordsFiltered"=>intval($dataCount[0]['qtd']),
        "data"=>$dados

      ];
      return json_encode($resultado);
    } catch (\Throwable $e) {
      echo  $e->getMessage();
    }
  }

  public static function deleteUnidadeMedida($data){
    $unid_id = $data['unid_id'];   
    try {
      $query = "DELETE FROM unidade_medida  WHERE unid_id = $unid_id ";
      self::execSql($query);
    } catch (\PDOException $e) {
        echo  $e->getMessage();
    }
  }


}