<?php
/*

Objetivos das traits e centralizar as funcionalidas de um determinada função
Desta forma poderemos da use nesta trait em qualquer parte do codigo que teremos as funcinalidades dispoinivel
*/
namespace App\Traits;

use App\Classes\StatusClass;
use App\Classes\UsuarioTipoClass;
use App\Classes\UsuariosClass;

use App\Traits\ValidacoesTrait;


trait UsuarioTrait {
    
use ValidacoesTrait;

    public  function getSelectUsuarioTipoStatus( $id = null ,$siglaStatus = null , $siglaTipo = null){
        /* 
          caso precise montar select na tela utlize esta função apra passa os paramentos para view, para aplicar algunm filtro utilize os paramentros.
          exemplo de uso na tela de cadastro de usuario.
        */
        $data['status'] = StatusClass::getStatus($id,$siglaStatus);
        $data['usuario_tipo'] = UsuarioTipoClass::getTipos($id , $siglaTipo);
        return  $data;
    }

    public function novoUsuarios(){
      $valido = false;
       if($this->isEmailValido()){
            if($this->isEmailCadastrado()){
                echo json_encode('email-informado-cadastrado');
                $valido = false;
                return  false;
            }
            if(!$this->minCaracteres($_POST['senha'], 5)){
                echo json_encode('senha-curta');
                $valido = false;
                return  false;
            }
            if(!$this->minCaracteres($_POST['nome'], 2)){
                echo json_encode('nome-curto');
                $valido = false;
                return  false;
            }
            $valido = true;
        } 
    if($valido){
        echo json_encode('valido');
        $user = new UsuariosClass();
        if($user->saveUsuario()){
            echo json_encode('cadastro-realizado');
        }else{
            echo json_encode('falha-cadastro');
        }
     
     }
    }
    

}