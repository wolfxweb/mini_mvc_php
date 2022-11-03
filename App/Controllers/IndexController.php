<?php

namespace App\Controllers;

use App\Models\Usuarios\UsuarioModel;

use MF\Controller\Action;
  
    /*
      para passar informação para view basta adiciona a informação
      no obejto $this->view  este objeto e criado no contrutor da Action;
    */
   

class IndexController extends Action{


   
  
    public function index(){
   
     $this->view->dados= UsuarioModel::getUsuarios();
     $this->render('index/index');

    }

    public function sobreNos(){
    $user = "ca";
    UsuarioModel::setUsuario($user);
   // $this->render('index/sobre_nos');
    }
    public function page404(){
      $this->render('index/page404');
    }

  
}