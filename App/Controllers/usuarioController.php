<?php

namespace App\Controllers;

use App\Models\Usuarios\UsuarioModel;

use App\Classes\UsuariosClass;

use MF\Controller\Action;


class usuarioController extends Action{

    public function getFomularioCadastro(){
        $this->render('usuarios/cadasto');
    }
    public function getFormLogin(){
        $this->render('usuarios/login');
    }

    public function setUsuario(){
        $camposObrigatorios = ['nome', 'email','cep','senha'];
      
        var_dump($_POST);
        if($_POST['nome'] == ""){
            echo "Campo nome é obrigatorio";
            return;
        }
        if($_POST['email'] == ""){
            echo "Campo e-mail obrigatorio";
            return;
        }
        if($_POST['cep'] == ""){
            echo "Campo senha obrigatorio";
            return;
        }
        if($_POST['senha'] == ""){
            echo "Campo senha obrigatorio";
            return;
        }
        $user  = new UsuariosClass($_POST);
       // echo "usewr";
       $user->saveUsuario();
      
       // echo $_POST;
    }


}