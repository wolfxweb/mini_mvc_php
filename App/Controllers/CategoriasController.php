<?php
namespace App\Controllers;



use MF\Controller\Action;

class CategoriasController  extends Action {

    public function loadTelaCategoria(){
        $this->render('painel_adm/categoria_home');  
    }
    public function cadastroCategoria(){
        $_POST = json_decode(file_get_contents('php://input'), true);
        $_POST ;
        return true;
    }
}