<?php

class Capacitacao
{
    private $profissional;
    private $servico;

    public function getProfissional() {
        return $this->profissional;
    }

    public function setProfissional($profissional) {
        $this->profissional = $profissional;
    }

    public function getServico() {
        return $this->servico;
    }
     
    public function setServico($servico) {
        $this->servico = $servico;
    }

    public function validate(){
        require_once "./classes/profissionais/ProfissionalDAO.php";
        require_once "./classes/servicos/ServicoDAO.php";
        $erros = array();
        $profissional = (new ProfissionalDAO())->findOne($this->getProfissional());
        $servico = (new ServicoDAO())->findOne($this->getServico());
        if(is_null($profissional) || $profissional->getAtivo() == 0)
            $erros[] = "Profissional não encontrado";
        if(is_null($servico))
            $erros[] = "Serviço não encontrado";
        return $erros;
    }   
}