<?php
namespace App\Controllers;

use MF\Controller\Action;

class ProdutoController extends Action{

    public function loadTelaProduto(){
        $this->render('painel_adm/produto');    
    }


}