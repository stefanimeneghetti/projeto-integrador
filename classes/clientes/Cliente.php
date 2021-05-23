<?php

class Cliente
{
    private $id;
    private $nome;
    private $telefone;
    private $historico;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
 
    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getTelefone() {
        return $this->telefone;
    } 

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function getHistorico() {
        return $this->historico;
    }

    public function setHistorico($historico) {
        $this->historico = $historico;
    }

    public function getObjectVars() {
        return get_object_vars($this);
    }

    public function validate(){
        $erros = array();
        if(empty($this->getNome()))
            $erros[] = "É necessário informar um nome";
        if(empty($this->getTelefone()))
            $erros[] = "É necessário informar um telefone";
        if(preg_match("/[^\p{L}\s'\-]/i", $this->getNome()))
            $erros[] = "Caracteres inválidos no campo nome. Utilize apenas letras maiúsculas e minúsculas";
        if(preg_match("/[^\d]/i", $this->getTelefone()))
            $erros[] = "Caracteres inválidos no campo telefone. Utilize apenas números";
        if(strlen($this->getNome()) > 50)
            $erros[] = "Campo nome muito longo. Máximo de 50 caracteres";
        if(strlen($this->getTelefone()) > 15)
            $erros[] = "Campo telefone muito longo. Máximo de 15 caracteres";
        return $erros;                                 
    }   
}