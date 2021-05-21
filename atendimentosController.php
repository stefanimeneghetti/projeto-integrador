<?php 

require_once "./classes/profissionais/Profissional.php";
require_once "./classes/profissionais/ProfissionalDAO.php";
require_once "./classes/capacitacao/Capacitacao.php";
require_once "./classes/capacitacao/CapacitacaoDAO.php";
require_once "./classes/servicos/Servico.php";
require_once "./classes/servicos/ServicoDAO.php";
require_once "./classes/atendimentos/Atendimento.php";
require_once "./classes/atendimentos/AtendimentoDAO.php";

class atendimentosController {
    public function newAppointment(){
        $atendimento = new Atendimento();
        if(isset($_POST["cliente-id"])) {
            // tratar recuperação de cliente do bd aqui
        }
        else {
            // tratar criação de cliente aqui
        }

        // fazer tratamento do status aqui. fazer tratamento da qtd paga baseada no status
        $atendimento->setStatus($_POST["status"]);
        $atendimento->setQuantidade_paga($_POST["pago"]);

        $atendimento->setData($_POST["date"] . " " . $_POST["time"]);
        $atendimento->setProfissional($_POST["professional"]);
        $atendimento->setDescricao($_POST["description"]);

        $erros = $atendimento->validate(null);
        
        $capacitacoesValidadas = array();
        foreach($_POST as $key => $value) {
            if (explode("-", $key)[0] == "serviceSelected"){
                $serviceId = explode("-",$key)[1];
                
                $capacitation = new Capacitacao();
                $capacitation->setServico($serviceId);
                $capacitation->setProfissional(0);
                $capacitacoesValidadas[] = $capacitation;
                $erros = array_merge($erros, $capacitation->validate(true));
            }
        }

        if(count($erros) != 0) {
            include "views/layout/header.php";
            include "views/layout/side-bar.php";?>
            <main>
            <?php include "views/profissionais/cadastrar.php";?>
            </main>
            <?php include "views/layout/footer.php";
        }
        else
        {
            $db = new ProfissionalDAO();
            $db->create($profissional);
            $profissionalId = $db->db_connection->lastInsertId();
            foreach($capacitacoesValidadas as $val) {
                $db = new CapacitacaoDAO();
                $val->setProfissional($profissionalId);
                $db->create($val);
            }

            header('Location: index.php?acao=profissionais/listar');
        }
    }

    public function getProfessionals() {
        $db = new ProfissionalDAO();
        $professionals = $db->all();

        $db = new CapacitacaoDAO();
        foreach ($professionals as $professional) {
            $services = $db->findByProfessional($professional->getId());
            $professional->setServicos($services);
        }

        return $professionals;
    }

    public function deleteAppointment($email){
        require_once("./classes/profissionais/ProfissionalDAO.php");
        $db = new ProfissionalDAO();
        $db->delete($email);
        header('Location: index.php?acao=profissionais/listar');
    }

    public function editAppointment($email) {
        if(!isset($_POST['altera']))
        {
            require_once("./classes/profissionais/ProfissionalDAO.php");
            $db = new ProfissionalDAO();
            $professional = $db->findOne($email);
            include_once "views/layout/header.php";
            include_once "views/layout/side-bar.php";?>
            <main>
            <?php include_once "views/profissionais/editar.php";?>
            </main>
            <?php include_once "views/layout/footer.php";
        }
        else
        {
            $profissional = new Profissional();
            $profissional->setNome($_POST["name"]);
            $profissional->setSenha($_POST["password"]);
            $profissional->setConfirmaSenha($_POST["password-confirm"]);
            $profissional->setEmail($_POST["email"]);
            $profissional->setEndereco($_POST["address"]);
            $profissional->setTelefone(preg_replace('/[\(\)\-\s]/', '', $_POST["phone"]));
            $profissional->setAtivo(1);
            $erros = $profissional->validate($email);
            $capacitacoesValidadas = array();
            foreach($_POST as $key => $value) {
                if (explode("-",$key)[0] == "serviceSelected"){
                    $serviceId = explode("-",$key)[1];
                    
                    $professionalId = (new ProfissionalDAO())->findOne($email)->getId();
                    
                    $capacitation = new Capacitacao();
                    $capacitation->setProfissional($professionalId);
                    $capacitation->setServico($serviceId);
                    $capacitacoesValidadas[] = $capacitation;
                    $erros = array_merge($erros, $capacitation->validate(false));
                }
            }
            if(count($erros) != 0) {
                include_once "views/layout/header.php";
                include_once "views/layout/side-bar.php";?>
                <main>
                <?php include_once "views/profissionais/editar.php";?>
                </main>
                <?php include_once "views/layout/footer.php";
            }
            else
            {
                $db = new ProfissionalDAO();
                $db->removeServicos($profissional->getEmail());
                $db->update($profissional, $email);
                foreach($capacitacoesValidadas as $val) {
                    $db = new CapacitacaoDAO();
                    $db->create($val);
                }
                
                header('Location: index.php?acao=profissionais/listar');
            }
        }
    }
}

$action = explode("/", $_GET['acao']);
switch($action[0]) {
    case 'excluir': 
        echo $action[1];
        $controller = new atendimentosController();
        $controller->deleteAppointment($action[1]); 
        break;
    case 'cadastrar': 
        $controller = new atendimentosController();
        $controller->newAppointment();
        break;
    case 'editar': 
        $controller = new atendimentosController();
        $controller->editAppointment($action[1]);
        break;
}
