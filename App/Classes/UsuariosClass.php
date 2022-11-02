<?php


namespace App\Classes;

use App\Models\Usuarios\UsuarioModel;

class UsuariosClass extends UsuarioModel{
   
    private $nome;
    private $email;
    private $senha;
    private $statusId;
    private $usuarioTipo;
    private $usuResetToken;

    public function __construct(){

    }
    public static function isValidoEmail($email){
        $stmSQL  = "select count(usu_email) as usu_email from usuarios usu  where usu_email ="."'".$email."'";
        return self::selectSql($stmSQL);
    }
    public  function saveUsuario(){
       return self::insertUsuario();  
     }


  
   

  

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of statusId
     */ 
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * Set the value of statusId
     *
     * @return  self
     */ 
    public function setStatusId($statusId)
    {
        $this->statusId = $statusId;

        return $this;
    }

    /**
     * Get the value of usuarioTipo
     */ 
    public function getUsuarioTipo()
    {
        return $this->usuarioTipo;
    }

    /**
     * Set the value of usuarioTipo
     *
     * @return  self
     */ 
    public function setUsuarioTipo($usuarioTipo)
    {
        $this->usuarioTipo = $usuarioTipo;

        return $this;
    }

    /**
     * Get the value of senha
     */ 
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     *
     * @return  self
     */ 
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get the value of usuResetToken
     */ 
    public function getUsuResetToken()
    {
        return $this->usuResetToken;
    }

    /**
     * Set the value of usuResetToken
     *
     * @return  self
     */ 
    public function setUsuResetToken($usuResetToken)
    {
        $this->usuResetToken = $usuResetToken;

        return $this;
    }
}