<?php
namespace App\Classes;

use MF\Model\Model as Modelo;


class CategoriasClass extends Modelo{


  public static function getCategorias($id = null ,$statusSigla = []){
       /*
        este metodo pode ser passado o paramentro id para filtar pro um  por uma categora em especifica
        ou filtrar pelo  status passando um array com as siglas a serem filtradas
        */
       $stmSQL  = "select cat.cat_id, cat.cat_nome, cat.cat_nivel , cat.sta_id , sta.sta_nome, sta.sta_sigla
                    from categorias cat
                        left  join status sta on sta.id = cat.sta_id ";
        if($id){
            $stmSQL .= " where usu.id = $id ";
        }
        if(!empty($statusSigla[0])){
            $modoFiltro  = " and ";
            if(empty($id)){
                $modoFiltro  = " where "; 
            }


            $stmSQL .= " $modoFiltro  sta.sta_sigla in ($statusSigla) ";
        }
        return self::selectSql($stmSQL);
    }
    public static function getStatus( String $statusSigla = ""){
        var_dump($statusSigla);
        /*
         este metodo pode ser passado o paramentro id para filtar pro um  por uma categora em especifica
         ou filtrar pelo  status passando um a sigla a ser filtrada
         */
        $stmSQL  = "select * from  status sta ";
         if(!empty($statusSigla[0])){
             $stmSQL .= " where sta.sta_sigla = "."'". $statusSigla."'";
            // $stmSQL .= " where sta.sta_sigla ='{$statusSigla}'";
         }
         return self::selectSql($stmSQL);
     }
}