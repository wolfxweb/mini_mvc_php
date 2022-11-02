<?php
namespace App\Traits;

use App\Classes\UsuariosClass;

trait ValidacoesTrait{

    public function isEmailValido(){
        $valido = true;
        if(!filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL)){
            echo json_encode('formato-email-invalido');
            $valido = false;
         }
        return $valido;
    }
    public function isEmailCadastrado(){
        /**
         * verifica se o email esta cadastro se tiver retorna true 
         */
        $emailCadastro = UsuariosClass::isValidoEmail($_POST['email']);
        return $emailCadastro[0]['usu_email']>0?true:false;
    }
    
    public function minCaracteres($string, $quantidade){

        return strlen($string)>$quantidade?true:false;

    }

}