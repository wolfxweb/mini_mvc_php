<?php
namespace App\Controllers;



use MF\Controller\Action;

class FabricanteController extends Action{

    public function loadTelaFabricante(){
        $this->render('painel_adm/fabricante');    
    }


}