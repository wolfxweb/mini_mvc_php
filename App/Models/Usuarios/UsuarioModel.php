<?php

namespace App\Models\Usuarios;

use App\Connection;

class UsuarioModel{
    

    public  $conn;

    public function __construct(){
        $this->conn = Connection::getConection();
    }
    public static function getUsuarios(){
        $conn = Connection::getConection();
        $query = "select * from usuario";
        $response =  $conn->query($query)->fetchAll();
      //  $conn->closeInstance();
        return $response;
    }
}