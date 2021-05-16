<?php

class Profissional
{
    private $email;
    private $nome;
    private $senha;
    private $telefone;
    private $endereco;
    private $ativo;

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
   
    public function getNome() {
        return $this->nome;
    }
    
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }
 
    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getAtivo(){
        return $this->ativo;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    public function validate(){
        $erros = array();
        // vazios
        if(empty($this->getNome()))
            $erros[] = "É necessário informar um nome";
        if(empty($this->getTelefone()))
            $erros[] = "É necessário informar um telefone";
        if(empty($this->getEmail()))
            $erros[] = "É necessário informar um email";
        if(empty($this->getSenha()))
            $erros[] = "É necessário informar uma senha";
        if(empty($this->getConfirmarSenha()))
            $erros[] = "É necessário confirmar a senha";

        // característicos
        if(preg_match("/[\p{L}\s'-]*/i", $this->getNome()))
            $erros[] = "Caracteres inválidos no campo nome. Utilize apenas letras maiúsculas e minúsculas, ' e -";
        if(preg_match("/\d*/i", $this->getTelefone()))
            $erros[] = "Caracteres inválidos no campo telefone. Utilize apenas números";
        if($this->getSenha() != $this->getConfirmarSenha())
            $erros[] = "Os campos senha e confirmar senha precisam ser idênticos";
        if(filter_var($this->getEmail(), FILTER_VALIDATE_EMAIL))
            $erros[] = "Campo email inválido";
        if(preg_match("/[\p{L}]\d\s-]*/", $this->getEndereco()))
            $erros[] = "Caracteres inválidos no campo endereço. Utilize apenas caracteres alfanuméricos, ' e -";
        
        // tamanho
        if(strlen($this->getNome()) > 50)
            $erros[] = "Campo nome muito longo. Máximo de 50 caracteres";
        if(strlen($this->getTelefone()) > 15)
            $erros[] = "Campo telefone muito longo. Máximo de 15 caracteres";
        if(strlen($this->getTelefone()) < 8)
            $erros[] = "Campo telefone muito curto. Mínimo de 8 caracteres";
        if(strlen($this->getEndereco()) > 250)
            $erros[] = "Campo endereço muito longo. Máximo de 250 caracteres";
        if(strlen($this->getEmail()) > 254)
            $erros[] = "Campo email muito longo. Máximo de 254 caracteres";
        if(strlen($this->getSenha()) > 50)
            $erros[] = "Campo senha muito longo. Máximo de 50 caracteres";
        if(strlen($this->getSenha()) < 8)
            $erros[] = "Campo senha muito curto. Mínimo de 8 caracteres";
            
        return $erros;                                 
    }   
}