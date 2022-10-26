<?php

namespace App\Models\Usuarios;

use MF\Model\Model as Modelo;

class UsuarioModel extends Modelo{

    public static function getUsuarios($id = null){
       // este metodo pode ser passado o paramentro id para filtar pro um  usuario especifico
       $stmSQL  = "select usu.id, usu.usu_nome, usu.usu_email,usu_reset_token,  usu.sta_id, sta.sta_nome, sta.sta_sigla, usut.usut_id, usut.usut_nome, usut.usut_sigla
                    from usuarios usu
                        left  join status sta on sta.id = usu.sta_id
                        left join usuario_tipo usut on usut.usut_id = usu.usut_id";
        if($id){
            $stmSQL .= " where usu.id = $id ";
        }
        return self::selectSql($stmSQL);
    }

    public static function setUsuario($usuario){
       // echo $usuario;
      //  self::insertSql($usuario);
    }

    protected function insertUsuario($param){
        var_dump($param);
     $query = "INSERT INTO usuarios (usu_nome,usu_email,usu_password,usu_reset_token,sta_id,usut_id) VALUES (?,?,?,?,?,?)";
     $this->insertSql($query,$param);

    }


}