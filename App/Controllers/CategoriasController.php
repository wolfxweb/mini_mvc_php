<?php
namespace App\Controllers;

use App\Traits\ValidacoesTrait;
use App\Traits\CategoriaTrait;

use App\Classes\CategoriasClass;

use MF\Controller\Action;

class CategoriasController  extends Action {

    use ValidacoesTrait;
    use CategoriaTrait;

    public function loadTelaCategoria(){
        $this->render('painel_adm/categoria_home');  
    }
    public function cadastroCategoria(){

       $data  = json_decode(file_get_contents('php://input'), true);
  
       if(!$this->minCaracteres($data['nome'], 2)){
        echo json_encode('Nome categoria deve ter no minimo 3 caracter.');
        return  false;
       }
       CategoriasClass::addCategoria($data);
   
       
    }
}