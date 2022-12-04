<?php
namespace App\Controllers;

use MF\Controller\Action;


use App\Classes\ProdutoClass;
class ProdutoController extends Action{

    public function loadTelaProduto(){
        $this->render('painel_adm/produto');    
    }

    public function tabelaProdutos(){
        echo  ProdutoClass::tabelaProdutos();
    }

    public function deletarProduto(){
        
        $data  = json_decode(file_get_contents('php://input'), true);
        ProdutoClass::deletarProduto($data['pro_id']);
    } 
    public function categoriasUnidadesMedidasProduto(){
        ProdutoClass::getCategoriasUnidadesMedidasProduto();
    }



}