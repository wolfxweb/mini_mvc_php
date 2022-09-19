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
       // echo "index controller";
  //   $users = new UsuarioModel();
   //   $this->view->dados =  $users->getUsuarios();
     $this->view->dados= UsuarioModel::getUsuarios();
   //   $data = Usuarios::getUsuarios();
    //  $this->view->dados= ['nome', 'sobre nome'];
     //  require_once"../App/View/index/index.phtml";
       $this->render('index/index');
    }

    public function sobreNos(){
     //   echo "sobre nos controller";
  //   $this->view->dados = ['nome', 'sobre nome'];
  //   require_once"../App/View/index/sobre_nos.phtml";
    // $this->render('sobre_nos');
    $this->render('index/sobre_nos');
    }

  
}