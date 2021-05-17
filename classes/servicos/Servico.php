<?php
class Servico
{
    private $id;
    private $nome;
    private $duracao;
    private $preco;
    private $descricao;
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
        if(empty($this->getDuracao()))
            $erros[] = "É necessário informar uma duração";
        if(empty($this->getPreco()))
            $erros[] = "É necessário informar um preço";

        if(preg_match("/[\p{L}\s'-]*/i", $this->getNome()))
            $erros[] = "Caracteres inválidos no campo nome. Utilize apenas letras maiúsculas e minúsculas, ' e -";
        // TODO lembrar de formatar a entrada com os números e dois pontos faltantes
        if(preg_match("/\d\d:\d\d:00/", $this->getDuracao()))
            $erros[] = "Duração inválida. Apenas dígitos são aceitos";
        if(preg_match("/\d*/", $this->getPreco()))
            $erros[] = "Duração inválida. Apenas dígitos são aceitos";

        if(strlen($this->getNome()) > 50)
            $erros[] = "Campo nome muito grande. Máximo de 50 caracteres.";
        if(strlen($this->getDescricao()) > 250)
            $erros[] = "Campo descrição muito grande. Máximo de 250 caracteres.";
        return $erros;
    }     
}