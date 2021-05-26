<?php
class Servico
{
    private $id;
    private $nome;
    private $duracao;
    private $preco;
    private $descricao;
    private $ativo;
    private $profissionais;

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

    public function getDuracao() {
        return $this->duracao;
    }

    public function setDuracao ($duracao) {
        $this->duracao = $duracao;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getAtivo() {
        return $this->ativo;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    public function getProfissionais() {
        return $this->profissionais;
    }

    public function setProfissionais($profissionais) {
        $this->profissionais = $profissionais;
    }

    public function validate(){
        $erros = array();
        if(empty($this->getNome()))
            $erros[] = "É necessário informar um nome";
        else if(preg_match("/[^\p{L}\s'\-]/i", $this->getNome()))
            $erros[] = "Caracteres inválidos no campo nome. Utilize apenas letras maiúsculas e minúsculas, ' e -";
        if(empty($this->getDuracao()))
            $erros[] = "É necessário informar uma duração";

        else if(!preg_match("/\d*:\d*:00/", $this->getDuracao()))
            $erros[] = "Duração inválida. Apenas dígitos são aceitos";
        if(empty($this->getPreco()))
            $erros[] = "É necessário informar um preço";
        else if(preg_replace("/^\d+((,\d{1,2})|(\.\d{1,2}))?$/", "", $this->getPreco()) == $this->getPreco())
            $erros[] = "Preço inválido. Apenas números, vírgulas e pontos são aceitos nos formatos \"xxxx,xx\", \"xxxx.xx\" e \"xx\"";

        if(strlen($this->getNome()) > 50)
            $erros[] = "Campo nome muito grande. Máximo de 50 caracteres.";
        if(strlen($this->getDescricao()) > 250)
            $erros[] = "Campo descrição muito grande. Máximo de 250 caracteres.";
        if(strlen($this->getPreco()) < 0)
            $erros[] = "Campo descrição muito grande. Máximo de 250 caracteres.";
        return $erros;
    }     

}