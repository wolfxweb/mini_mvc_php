<?php

namespace App;

class Connection{

    public static function getConection(){
        try {
              //new PDO("pgsql:host=localhost;port=;dbname=bancoteste;user=root;password=123456");
        /*  $endereco = 'postgresqlaws.crrjtkq5nq1n.us-east-1.rds.amazonaws.com';
           $banco = 'postgres';
           $usuario_banco = 'postgres';
           $senha ='postgres';
           $porta= '5432'; */

           //$conexao =new \PDO("pgsql:host=$endereco;port=$porta;dbname=$banco;user=$usuario_banco;password=$senha");
           $endereco = 'database-app-mysql.crrjtkq5nq1n.us-east-1.rds.amazonaws.com';
           $banco = 'appMysql';
           $usuario_banco = 'root';
           $senha ='database-mysql';
           $porta= '3306'; 
           $conexao =new \PDO("mysql:host=$endereco;port=$porta;dbname=$banco;user=$usuario_banco;password=$senha");
           /*
           $conexao = new \PDO(
                "mysql:dbname=$banco;host=$ip",
                "mvc",
                "wolf"
            );
            */
           //echo "conn";
           return $conexao ;
            
        } catch (\PDOException $e) {
           
            echo 'Error Connection : ' . $e->getMessage();

        }
    }

   
}