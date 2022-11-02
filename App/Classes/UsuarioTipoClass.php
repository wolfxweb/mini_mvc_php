<?php
namespace App\Classes;

use MF\Model\Model as Modelo;

class UsuarioTipoClass  extends Modelo{
    private $usut_id;
    private $usut_nome;
    private $usut_sigla;
    private $stmSQL  = " select usut_id, usut_nome, usut_sigla from usuario_tipo where 1=1 ";


    public static function getTipos($id = null ,$sigla = array()){
        /*
            este metodo pode ser passado o paramentro id para filtar pro um  por uma tipo em especifico ou filtrar pela sigla 
         */
        $stmSQL  = " select usut_id, usut_nome, usut_sigla from usuario_tipo where 1=1 ";
         if($id){
             $stmSQL .= " and usut_id = $id ";
         }
         if(!empty($sigla)){
            $stmSQL .= " and usut_sigla in ($sigla) ";
         }
         return self::selectSql($stmSQL);
     }

    public  function getTipo($id = null ,$sigla = null){
        /*
          nesta função um dos dois paramentros deve ser enviado caso não seja enviado o sistema não fará a consulta
        */
        if(!empty($id) || !empty($sigla)){
            if($id){
                $this->stmSQL .= " and usut_id = $id ";
            }
            if(!empty($sigla)){
                $this->stmSQL .= " and usut_sigla = $sigla ";
            }
            return self::selectSql($stmSQL);
        }

    }


    /**
     * Get the value of usut_id
     */ 
    public function getUsut_id()
    {
        return $this->usut_id;
    }

    /**
     * Set the value of usut_id
     *
     * @return  self
     */ 
    public function setUsut_id($usut_id)
    {
        $this->usut_id = $usut_id;

        return $this;
    }

    /**
     * Get the value of usut_nome
     */ 
    public function getUsut_nome()
    {
        return $this->usut_nome;
    }

    /**
     * Set the value of usut_nome
     *
     * @return  self
     */ 
    public function setUsut_nome($usut_nome)
    {
        $this->usut_nome = $usut_nome;

        return $this;
    }

    /**
     * Get the value of usut_sigla
     */ 
    public function getUsut_sigla()
    {
        return $this->usut_sigla;
    }

    /**
     * Set the value of usut_sigla
     *
     * @return  self
     */ 
    public function setUsut_sigla($usut_sigla)
    {
        $this->usut_sigla = $usut_sigla;

        return $this;
    }
}