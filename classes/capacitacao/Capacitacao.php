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
        $erros = array();
        if($this->getProfissional()->getAtivo() == 0)
            $erros[] = "Profissional não encontrado";
        return $erros;                                 
    }   
}