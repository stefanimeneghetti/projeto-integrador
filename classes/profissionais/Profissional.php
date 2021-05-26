<?php

class Profissional
{
    private $id;
    private $email;
    private $nome;
    private $senha;
    private $telefone;
    private $confirmaSenha;
    private $endereco;
    private $ativo;
    private $servicos;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

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

    public function getConfirmaSenha(){
        return $this->confirmaSenha;
    }

    public function setConfirmaSenha($senha) {
        $this->confirmaSenha = $senha;
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

    public function getServicos(){
        return $this->servicos;
    }

    public function setServicos($servicos) {
        $this->servicos = $servicos;
    }

    // $oldEmail é o email registrado no banco de dados do usuário em questão.
    // deve ser null caso a validação seja chamada para o cadastro de um novo
    // funciionário.
    public function validate($oldEmail){
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
        else if(empty($this->getConfirmaSenha()))
            $erros[] = "É necessário confirmar a senha";

        // característicos
        else if($this->getSenha() != $this->getConfirmaSenha())
            $erros[] = "Os campos senha e confirmar senha precisam sesr idênticos";
        if(preg_match("/[^\p{L}\s'-]/i", $this->getNome()))
            $erros[] = "Caracteres inválidos no campo nome. Utilize apenas letras maiúsculas e minúsculas, ' e -";
        if(preg_match("/[^\d]/", $this->getTelefone()))
            $erros[] = "Caracteres inválidos no campo telefone.".$this->getTelefone()." Utilize apenas números";
        if(!filter_var($this->getEmail(), FILTER_VALIDATE_EMAIL))
            $erros[] = "Campo email inválido";
        if(preg_match("/[^\p{L}]\d\s\-\(\)]+/i", $this->getEndereco()))
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
        
        $query = (new ProfissionalDAO())->findOne($this->getEmail());
        if(!is_null($query) && $query->getEmail() != $oldEmail)
            $erros[] = "Email já registrado";
        
        return $erros;                                 
    }   
}