<?php
namespace App\Controllers;

use MF\Controller\Action;

use App\Classes\UnidadeMedidaClass;

class UnidadeMedidaController extends Action{
    

    public function loadTelaUnidadeMedida(){
        $this->render('painel_adm/unidade_medida');    
    }
    public function tabelaUnidadeMedida(){
       echo   UnidadeMedidaClass::tabelaUnidadeMedida();
    }
    
}