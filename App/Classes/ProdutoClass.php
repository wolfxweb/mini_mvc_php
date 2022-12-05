<?php
namespace App\Classes;
use MF\Model\Model as Modelo;

use App\Classes\Components\AcaoTabelaComponent;


class ProdutoClass  extends Modelo {

   public  static function acaoProduto(){
      
    $data  = json_decode(file_get_contents('php://input'), true);
    $pro_id =$data['pro_id'];
    $prod_nome = $data['prod_nome'];
    $prod_descricao = $data['prod_descricao'];
    $prod_preco =$data['prod_preco'];
    $unid_id = $data['unid_id'];
    $cat_id =$data['cat_id'];
    if(!empty($data['pro_id'])){
      try {
        $query = "UPDATE produto SET prod_nome= '{$prod_nome}' ,prod_descricao= '{$prod_descricao}' , prod_preco = $prod_preco, unid_id = $unid_id , cat_id = $cat_id WHERE pro_id = $pro_id ";
        self::execSql($query); 
      } catch (\PDOException $e) {
          echo  $e->getMessage();
      }
    }else{
      try {
        $query = "INSERT INTO produto(prod_nome,prod_descricao,prod_preco,unid_id,cat_id) VALUES ('$prod_nome' ,'$prod_descricao',$prod_preco,$unid_id,$cat_id)";
        self::execSql($query); 
      } catch (\PDOException $e) {
          echo  $e->getMessage();
      }
    }

   }

    public static function getCategoriasUnidadesMedidasProduto(){
      $data  = json_decode(file_get_contents('php://input'), true);
     
        if($data['pro_id'] != "cadastro"){
          $id = $data['pro_id'];
          $response['produto'] = self::selectSql(" SELECT * FROM produto WHERE pro_id = $id ");
        }
        $response['categorias'] = self::selectSql('SELECT * FROM categorias');
        $response['unidadesMedidas'] = self::selectSql('SELECT * FROM unidade_medida');
        echo  json_encode($response);
       }
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