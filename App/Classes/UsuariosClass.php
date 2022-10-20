<?php


namespace App\Classes;

use App\Models\Usuarios\UsuarioModel;

class UsuariosClass extends UsuarioModel{
   
    private $nome;
    private $email;
    private $celular;
    private $telefone_fixo;
    private $cep;
    private $rua;
    private $bairro;
    private $cidade;
    private $estado;
    private $numero;
    private $complemento;
    private $senha;

    function __construct($post) {
        $this->nome = $post['nome'];
        $this->email = $post['email'];
        $this->celular = $post['celular'];
        $this->telefone_fixo = $post['telefone_fixo'];
        $this->cep = $post['cep'];
        $this->rua = $post['rua'];
        $this->bairro = $post['bairro'];
        $this->cidade = $post['cidade'];
        $this->estado = $post['estado'];
        $this->numero = $post['numero'];
        $this->complemento = $post['complemento'];
        $this->senha = $post['senha'];
    } 

    public function saveUsuario(){

        $query = "INSERT INTO usuario (nome,email,celular,telefone_fixo,cep,rua,bairro,cidade,estado,numero,complemento,senha) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        $param =[
            $this->getNome(),
            $this->getEmail(),
            $this->getCelular(),
            $this->getTelefone_fixo(),
            $this->getCep(),
            $this->getRua(),
            $this->getBairro(),
            $this->getCidade(),
            $this->getEstado(),
            $this->getNumero(),
            $this->getComplemento(),
            $this->getSenha(),
        ];
        $this->insertUsuario($query,$param);
      

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
     * Get the value of celular
     */ 
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set the value of celular
     *
     * @return  self
     */ 
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get the value of telefone_fixo
     */ 
    public function getTelefone_fixo()
    {
        return $this->telefone_fixo;
    }

    /**
     * Set the value of telefone_fixo
     *
     * @return  self
     */ 
    public function setTelefone_fixo($telefone_fixo)
    {
        $this->telefone_fixo = $telefone_fixo;

        return $this;
    }

    /**
     * Get the value of cep
     */ 
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set the value of cep
     *
     * @return  self
     */ 
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get the value of bairro
     */ 
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set the value of bairro
     *
     * @return  self
     */ 
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */ 
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of complemento
     */ 
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * Set the value of complemento
     *
     * @return  self
     */ 
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;

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
     * Get the value of rua
     */ 
    public function getRua()
    {
        return $this->rua;
    }

    /**
     * Set the value of rua
     *
     * @return  self
     */ 
    public function setRua($rua)
    {
        $this->rua = $rua;

        return $this;
    }

    /**
     * Get the value of cidade
     */ 
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set the value of cidade
     *
     * @return  self
     */ 
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }
}