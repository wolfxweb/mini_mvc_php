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

        $this->view->dados = CategoriasClass::getCategorias();
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

    public function edicaoCategoria(){
       $data  = json_decode(file_get_contents('php://input'), true);
       if(!$this->minCaracteres($data['cat_nome'], 2)){
        echo json_encode('Nome categoria deve ter no minimo 3 caracter.');
        return  false;
       }
       CategoriasClass::updateCategoria($data);  
    }

    public function deleteCategoria(){
        $data  = json_decode(file_get_contents('php://input'), true);

        $categoria = CategoriasClass::getCategorias($data['cat_id']);
        if(!empty($categoria[0])){
            CategoriasClass::deleteCategoria($data);
        }else{
            echo json_encode('Categoria não encontrada.');
        } 
    }
    public function filtrarCategoria(){
       // $data  = json_decode(file_get_contents('php://input'), true);
       $catFiltro = $_REQUEST['catFiltro']??null;
        //$this->view->dados= CategoriasClass::getCategorias(5);
        echo json_encode(CategoriasClass::filtrarCategoria($catFiltro));
      //  $this->render('painel_adm/categoria_home');  
    }
    public function tabelaCategorias(){
    echo   CategoriasClass::tabelaCategorias();
       

      
     }
}