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

    // novo deve ser true caso a validação em questão esteja sendo feita para um
    // profissional ou serviço ainda não existente no BD.
    public function validate($novo){
        require_once "./classes/profissionais/ProfissionalDAO.php";
        require_once "./classes/servicos/ServicoDAO.php";
        $erros = array();
        $profissional = (new ProfissionalDAO())->findById($this->getProfissional());
        $servico = (new ServicoDAO())->findOne($this->getServico());
        if((is_null($profissional) || $profissional->getAtivo() == 0) && !$novo)
            $erros[] = "Profissional não encontrado";
        if((is_null($servico) || $servico->getAtivo() == 0) && !$novo)
            $erros[] = "Serviço não encontrado";
        return $erros;
    }   
}