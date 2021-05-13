<?php

class Atendimento {

    private $id;
    private $data;
    private $preco;
    private $descricao;
    private $quantidade_paga;
    private $cliente;
    private $status;
    private $profissional;
    private $servico;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getPreco()
    {
        return $this->preco;
    }

    public function setPreco($preco)
    {
        $this->preco = $preco;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getQuantidade_paga()
    {
        return $this->quantidade_paga;
    }

    public function setQuantidade_paga($quantidade_paga)
    {
        $this->quantidade_paga = $quantidade_paga;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getProfissional()
    {
        return $this->profissional;
    }

    public function setProfissional($profissional)
    {
        $this->profissional = $profissional;
    }

    public function getServico()
    {
        return $this->servico;
    }

    public function setServico($servico)
    {
        $this->servico = $servico;
    }

    public function validate(){
        $erros = array();
        // validações                  
        return $erros;                                 
    }
}
