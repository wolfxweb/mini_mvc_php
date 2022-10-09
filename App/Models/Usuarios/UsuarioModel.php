<?php

namespace App\Models\Usuarios;

use MF\Model\Model as Modelo;

class UsuarioModel extends Modelo{




    public static function getUsuarios(){
        return self::selectSql("select * from usuario");
    }

    public static function setUsuario($usuario){
       // echo $usuario;
      //  self::insertSql($usuario);
    }

    protected function insertUsuario($query,$param){

     $this->insertSql($query,$param);

    }


}