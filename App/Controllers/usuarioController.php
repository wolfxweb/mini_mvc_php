<?php

namespace App\Controllers;

use MF\Controller\Action;
use  App\Traits\UsuarioTrait;

class usuarioController extends Action{

    use  UsuarioTrait;//todas as funcionalidades do usuário devem ser implentada na trait pois se precisa em outra classe e so utlizar o use e ja fica disponivel;

    

    public function getFomularioCadastro(){
       $data = $this->getSelectUsuarioTipoStatus("","","");// esta função pode ser passado filtros por parametros 
       /*
          Organizar o array da view conforme abaixo vai facilitar a montagem da tela
       */
       $dados['status']= $data['status']; 
       $dados['usuario_tipo']= $data['usuario_tipo']; 
       $this->view->dados = $dados  ;
       $this->render('usuarios/cadastro_usuario');    
    }
    public function getFormLogin(){
        $this->render('usuarios/login');
    }

    public function setUsuario(){

       $_POST = json_decode(file_get_contents('php://input'), true);
       $this->novoUsuarios();
        
   
    }


}