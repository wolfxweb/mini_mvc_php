<?php
namespace App\Controllers;


use MF\Controller\Action;

class PainelAdmController extends Action{
    

    public function loadTelaAdm(){
        $this->render('painel_adm/home_adm');    
    }
}