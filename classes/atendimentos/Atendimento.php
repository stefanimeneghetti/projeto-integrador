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

    private $data_formatada;
    private $horario_formatado;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    // retorna DD/MM/AAAA HH:MM:SS
    public function getFullDate()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
        $this->data_formatada = date('n.j.Y', strtotime($data));
        $this->horario_formatado = date("h:i", strtotime($data));
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

    // retorna HH:MM
    public function getFormattedTime()
    {
        return $this->horario_formatado;
    }

    public function setFormattedTime($horario)
    {
        $this->horario_formatado = $horario;
        if(isset($this->data))
            $this->data = preg_match("/\d{1,4}\-\d{1,2}\-\d{1,2}/", $this->data) . " " . $horario;
    }

    public function setFormattedDate($data)
    {
        $this->data_formatada = $data;
        if(isset($this->data))
            $this->data = $data . " " .preg_match("/\d{1,2}:\d{1,2}:\d{1,2}/", $this->data);
    }

    // retorna DD//MM//AAAA
    public function getFormattedDate()
    {
        return $this->data_formatada;
    }

    public function setSplitDate($data, $time)
    {
        $this->data_formatada = $data;
        $this->horario_formatado = $time;
        $this->data = $data . " " . $time;
    }


    public function validate(){
        $erros = array();
        // TODO validar serviço e profissional associado.

        // vazios
        if(empty($this->getFormattedDate()))
            $erros[] = "É necessário informar uma data";
        if(empty($this->getPreco()))
            $erros[] = "É necessário informar um preço";

        // característicos
        $data = explode("-", $this->getFormattedDate());
        if(!checkDate($data[1], $data[0], $data[2]))
            $erros[] = "Campo data inválido";
        if(preg_match("/\d*/", $this->getQuantidade_paga()))
            $erros[] = "Quantidade paga inválida. Apenas dígitos são aceitos";
        
        // tamanho
        if(strlen($this->getDescricao()) > 250)
            $erros[] = "Campo descrição muito longo. Máximo de 250 caracteres";
        if($this->getStatus() < 0 || $this->getStatus() > 7)
            $erros[] = "Status de agendamento não reconhecido";
        return $erros;                                 
    }
}
