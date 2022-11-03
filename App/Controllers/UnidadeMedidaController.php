<?php
namespace App\Controllers;

use MF\Controller\Action;

class UnidadeMedidaController extends Action{
    

    public function loadTelaUnidadeMedida(){
        $this->render('painel_adm/unidade_medida');    
    }
    
}