<?php

namespace App\Models\Usuarios;

use MF\Model\Model as Modelo;
use App\Classes\UsuariosClass;
use App\Connection;

class UsuarioModel extends Modelo{
    private $conn;
    public function __construct(){}

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
    
    public  function verificaEmailCadastrado($email){
        $stmSQL  = "select count(usu_email) as usu_email from usuarios usu  where usu_email ="."'".$email."'";
        return self::selectSql($stmSQL);
    }

  


    protected function insertUsuario(){

      try {
        $query = "INSERT INTO usuarios (usu_nome,usu_email,usu_password, sta_id, usut_id) VALUES (?,?,?,?,?)";
        $conn = Connection::getConection();  
        $stmt   = $conn->prepare($query);
        $stmt->bindParam(1, $_POST['nome']);
        $stmt->bindParam(2, $_POST['email']);
        $stmt->bindParam(3, $_POST['senha']);
        $stmt->bindParam(4, $_POST['status'],\PDO::PARAM_INT);
        $stmt->bindParam(5, $_POST['usuarioTipo'],\PDO::PARAM_INT);
        return  $stmt->execute();
        
      } catch (\PDOException $e) {
          echo 'Error: ' . $e->getMessage();
      }
    }



}