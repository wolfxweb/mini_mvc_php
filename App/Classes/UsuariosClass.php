<?php


namespace App\Classes;

use App\Models\Usuarios\UsuarioModel;

class UsuariosClass extends UsuarioModel{
   
    private $nome;
    private $email;
    private $password;
    private $statusId;
    private $usuarioTipo;


    function __construct($post) {
   
        
    } 

    public function saveUsuario(){

       // $query = "INSERT INTO usuario (nome,email,celular,telefone_fixo,cep,rua,bairro,cidade,estado,numero,complemento,senha) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        $param =[
           
        ];
        $this->insertUsuario($param);
      

        var_dump('save');
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
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

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
}