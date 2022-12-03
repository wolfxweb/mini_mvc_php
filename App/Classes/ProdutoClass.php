<?php
namespace App\Classes;
use MF\Model\Model as Modelo;


class ProdutoClass  extends Modelo {


    public static function getProdutos($id = null ,$statusSigla = [] ,$dataTableOrder=null ,$searchTable =null ){

        $stmSQL  = " select pro_id, prod_nome , cat.cat_nome as cat_id , unid.unid_nome as unid_id , prod_preco from produto  prod  ";
        $stmSQL  .= " join  categorias cat on  cat.cat_id = prod.cat_id ";
        $stmSQL  .= " join  unidade_medida unid on  unid.unid_id = prod.unid_id ";

         if($id){
             $stmSQL .= " where pro_id = $id ";
         }
         if(!empty($searchTable)){
           $stmSQL .= $searchTable;
         }
         if(!empty($dataTableOrder)){
           $stmSQL .= $dataTableOrder;
         }
         return self::selectSql($stmSQL);
     }
     protected static function countProdutos(){
        try {
          $query = "SELECT COUNT(unid_id) as qtd FROM unidade_medida ";
          return  self::selectSql($query);
        } catch (\PDOException $e) {
            echo  $e->getMessage();
        }
      return  false;
    }

    public static function tabelaProdutos(){
        $request =  $_REQUEST;
        $colunas=[
          0=>'pro_id',
          1=>'prod_nome',
          2=>'cat_id',
          3=>'unid_id',
          4=>'prod_preco'
        ];
               //filtro
    
            $searchTable = null;
            if(!empty($request['search']['value'])){
            $valueSearch = "'%".$request['search']['value']."%'";
            $searchTable = " where pro_id LIKE {$valueSearch} OR prod_nome LIKE {$valueSearch}  OR cat_id LIKE {$valueSearch} OR unid_id LIKE {$valueSearch} OR prod_preco LIKE {$valueSearch}";

            }
        
         //   $dataTableOrder = " ORDER BY {$colunas[$request['order'][0]['column']]}  {$request['order'][0]['dir']}  LIMIT {$request['start']} , {$request['length']} ";
        $dataTableOrder = null;
            try {
            $dataUnidadeMedida = self::getProdutos(NULL,[],$dataTableOrder,$searchTable);
            $dataCount = self::countProdutos();

            
            foreach( $dataUnidadeMedida as $data){
                $registro=[];
                $registro['pro_id']=$data['pro_id'];
                $registro['prod_nome']=$data['prod_nome'];
                $registro['cat_id']=$data['cat_id'];
                $registro['unid_id']=$data['unid_id'];
                $registro['prod_preco']=$data['prod_preco'];

                $registro['acao'] = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">';
                $registro['acao'].= '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalprod'.$data["pro_id"].'"><i class="bi bi-trash"></i></button>';  
                $registro['acao'].= '<button type="button" class="btn btn-success"  onclick="editUnidadeMedida('.$data["pro_id"].')"><i class="bi bi-pencil"></i></button>';                
                $registro['acao'].= '</div>';
                $registro['acao'].= '<div class="modal fade" id="modalprod'.$data["pro_id"].'" data-bs-backdrop="static"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"  aria-hidden="true">';
                $registro['acao'].= '<div class="modal-dialog modal-dialog-centered">';
                $registro['acao'].= '<div class="modal-content">';
                $registro['acao'].= '<div class="modal-header"> <h5 class="modal-title" id="staticBackdropLabel">Excluir</h5>  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>';
                $registro['acao'].= '<div class="modal-body"><h6>Deseja mesmo excluir a unidade de medida '.$data['prod_nome'].'?</h6><p>Esta ação e ireversivel.</p></div>';
                $registro['acao'].= '<div class="modal-footer">';
                $registro['acao'].= '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>';
                $registro['acao'].= '<button type="button" class="btn btn-danger"  onclick="deletarUnidadeMedida('.$data["pro_id"]. ')">Excluir</button>';
                $registro['acao'].= '</div></div></div></div>';
                $registro['acao'].= ' <INPUT TYPE="hidden" id="prod_codigo'.$data["pro_id"].'" NAME="prodEdit" VALUE="'.$data["pro_id"].'" prod_nome="'.$data['prod_nome'].'" >';
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

}