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




}