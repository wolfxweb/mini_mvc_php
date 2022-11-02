<?php
namespace App\Classes;
use MF\Model\Model as Modelo;

class StatusClass extends Modelo{

    public static function getStatus( $id =null, $statusSigla = ""){
        /*
          Este metodo é para listar os status caso deseje algum especifico utilize os filtros.
         */
        $stmSQL  = "select * from  status sta where 1=1 ";
        if(!empty($id)){
            $stmSQL .= " and sta.sta_is =  $id";
       }
        if(!empty($statusSigla)){
             $stmSQL .= " and sta.sta_sigla = "."'". $statusSigla."'";
        }
         return self::selectSql($stmSQL);
     }
}