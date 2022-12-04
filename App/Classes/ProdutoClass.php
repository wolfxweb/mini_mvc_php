<?php
namespace App\Classes;
use MF\Model\Model as Modelo;

use App\Classes\Components\AcaoTabelaComponent;


class ProdutoClass  extends Modelo {


    public static function deletarProduto($id){
       $tabela = "produto";
       $where  = "pro_id = {$id} ";
       self::delete($tabela , $where);

    } 

    protected static function getTabelaProduto(){
      $request =  $_REQUEST;
      $colunas=[
        0=>'pro_id',
        1=>'prod_nome',
        2=>'unid_nome',
        3=>'cat_nome',
        4=>'prod_preco'
      ];
      /** montagen do sql da tabela produto */
      $stmSQL   = " select prod.pro_id, prod.prod_nome , cat.cat_nome as cat_id , unid.unid_nome as unid_id , prod.prod_preco from produto  prod  ";
      $stmSQL  .= " join  categorias cat on  cat.cat_id = prod.cat_id ";
      $stmSQL  .= " join  unidade_medida unid on  unid.unid_id = prod.unid_id ";

      return self::getTabela($stmSQL,$request,$colunas);
    }
    public static function tabelaProdutos(){
      
        $request =  $_REQUEST;
        try {
          
            $dataTabela = self::getTabelaProduto();
            $dataCount = self::countTabela('produto','pro_id');
           
            foreach( $dataTabela as $data){
                $registro=[];
                $registro['pro_id']=$data['pro_id'];
                $registro['prod_nome']=$data['prod_nome'];
                $registro['cat_id']=$data['cat_id'];
                $registro['unid_id']=$data['unid_id'];
                $registro['prod_preco']=$data['prod_preco'];
                $registro['acao'] = AcaoTabelaComponent::acaoTabela('prod',$data['pro_id'],$data['prod_nome'],'Produto');
              // $registro['acao'] = 'acao';
                /*
                $registro['acao'] = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">';
                $registro['acao'].= '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalprod'.$data["pro_id"].'"><i class="bi bi-trash"></i></button>';  
                $registro['acao'].= '<button type="button" class="btn btn-success"  onclick="editProduto('.$data["pro_id"].')"><i class="bi bi-pencil"></i></button>';                
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
                */
               // $registro['acao'].= ' <INPUT TYPE="hidden" id="prod_codigo'.$data["pro_id"].'" NAME="prodEdit" VALUE="'.$data["pro_id"].'" prod_nome="'.$data['prod_nome'].'" >';
                

                $dados[]= $registro;
            }
            if(empty($dados)){
                $registro=[];
                $registro['pro_id']='';
                $registro['prod_nome']='';
                $registro['cat_id'] = '';
                $registro['unid_id'] = '';
                $registro['prod_preco'] = '';
                $registro['acao'] = '';
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