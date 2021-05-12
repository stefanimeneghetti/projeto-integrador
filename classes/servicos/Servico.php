<?php
class Servico
{
    private $id;
    private $nome;
    private $duracao;
    private $preco;
    private $descricao;

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

    public function validate(){
        $erros = array();
        // validações                  
        return $erros;                                 
    }     
}