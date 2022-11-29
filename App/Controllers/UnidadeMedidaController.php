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
    public function deleteUnidadeMedida(){
        $data  = json_decode(file_get_contents('php://input'), true);

        $unidade = UnidadeMedidaClass::getUnidadeMedida($data['unid_id']);
        if(!empty($unidade[0])){
            UnidadeMedidaClass::deleteUnidadeMedida($data);
        }else{
            echo json_encode('Categoria não encontrada.');
        } 
    }

    public function adicionarAtualizarUnidadeMedida(){
        $data  = json_decode(file_get_contents('php://input'), true);
        UnidadeMedidaClass::adicionarAtualizarUnidadeMedida($data);
    }

}