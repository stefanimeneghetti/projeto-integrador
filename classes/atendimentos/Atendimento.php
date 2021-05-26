<?php

class Atendimento {

    private $id;
    private $data;
    private $preco;
    private $duracao;
    private $descricao;
    private $quantidade_paga;
    private $cliente;
    private $status;
    private $profissional;
    private $servico;

    private $data_formatada;
    private $horario_formatado;
    private $nomeCliente;
    private $telefoneCliente;

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

    public function setTelefone($telefone) {
        $this->telefoneCliente = $telefone;
    }
    
    public function getTelefone() {
        return $this->telefoneCliente;
    }
    
    public function setNome($nome) {
        $this->nomeCliente = $nome;
    }

    public function getNome() {
        return $this->nomeCliente;
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

    public function getDuracao() {
        $time = explode(":", $this->duracao);
        $formatted_time = $time[0]."h".$time[1]."min";
        return $formatted_time;
    }

    public function setDuracao ($time) {
        $this->duracao = $time;
    }

    public function validate() {
        $erros = array();
        // TODO validar serviço e profissional associado.
        $db_profissionais = new ProfissionalDAO();
        if(is_null($db_profissionais->findById($this->getProfissional())))
            $erros[] = "Profissional selecionado não encontrado";
        $db_servicos = new ServicoDAO();
        if(is_null($db_servicos->findOne($this->getServico())))
            $erros[] = "Serviço selecionado não encontrado";
        if(null !== $this->getCliente()) {
            echo "aaaaaa". $this->getCliente();
            $db_clientes = new ClienteDAO();
            $c = $db_clientes->findOne($this->getCliente());
            if(is_null($c))
                $erros[] = "Cliente selecionado não encontrado";
        } else {
            $c = new Cliente();
            $c->setNome($this->getNome());
            $c->setTelefone($this->getTelefone());
            $erros = array_merge($erros, $c->validate());
        }

        // vazios
        if(empty($this->getFullDate()))
            $erros[] = "É necessário informar uma data";
        if(empty($this->getProfissional()))
            $erros[] = "É necessário informar um profissional";
        if(empty($this->getServico()))
           $erros[] = "É necessário informar um serviço";       
        if(empty($this->getQuantidade_paga()))
            $erros[] = "É necessário informar um preço";
        else if(preg_replace("/^\d+((,\d{1,2})|(\.\d{1,2}))?$/", "", $this->getQuantidade_paga()) == $this->getQuantidade_paga())
            $erros[] = "Preço inválido. Apenas números, vírgulas e pontos são aceitos nos formatos \"xxxx,xx\", \"xxxx.xx\" e \"xx\"";
        if(empty($this->getStatus()))
            $erros[] = "É necessário informar um status";

        // característicos
        $data = explode(".", $this->getFormattedDate());
        if(!checkDate($data[0], $data[1], $data[2]))
            $erros[] = "Campo data inválido";
        
        // tamanho
        if(strlen($this->getDescricao()) > 250)
            $erros[] = "Campo descrição muito longo. Máximo de 250 caracteres";
        if($this->getStatus() < 0 || $this->getStatus() > 7)
            $erros[] = "Status de agendamento não reconhecido";
        return $erros;                                 
    }
}
