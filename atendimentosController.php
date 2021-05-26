<?php 
require_once "./classes/profissionais/Profissional.php";
require_once "./classes/profissionais/ProfissionalDAO.php";
require_once "./classes/capacitacao/Capacitacao.php";
require_once "./classes/capacitacao/CapacitacaoDAO.php";
require_once "./classes/clientes/Cliente.php";
require_once "./classes/clientes/ClienteDAO.php";
require_once "./classes/servicos/Servico.php";
require_once "./classes/servicos/ServicoDAO.php";
require_once "./classes/atendimentos/Atendimento.php";
require_once "./classes/atendimentos/AtendimentoDAO.php";
require_once  "authController.php";

class atendimentosController {
    public function newAppointment(){
        var_dump($_POST);

        $atendimento = new Atendimento();
        $erros = array();

        if(
           isset($_POST['date']) && 
           isset($_POST['service']) && 
           isset($_POST['professional']) &&
           !isset($_POST['time'])
          )
        {
            $appointment_times = (new AtendimentoDAO())->getPossibleAppointmentTimes($_POST['professional'], $_POST['service'], $_POST['date']);
         
            include "views/layout/header.php";
            include "views/layout/side-bar.php";?>
            <main>
                <?php include "views/agenda/novo.php";?>
            </main>
            <?php include "views/layout/footer.php";
        }
        else {
            $atendimento->setStatus($_POST["status"]);
            $atendimento->setQuantidade_paga(str_replace(",",".", preg_replace("/[R\$\s]/", "", $_POST["price"])));
            $atendimento->setData($_POST["date"] . " " . $_POST["time"]);
            $atendimento->setProfissional($_POST["professional"]);
            $atendimento->setServico($_POST["service"]);
            $atendimento->setCliente($_POST["client-id"]);
            $atendimento->setNome($_POST["name"]);
            $atendimento->setTelefone(preg_replace('/[\(\)\-\s]/', '', $_POST["phone"]));
            
            $erros = array_merge($erros, $atendimento->validate());
            
            if(count($erros) != 0) {
                include "views/layout/header.php";
                include "views/layout/side-bar.php";?>
                <main>
                    <?php include "views/agenda/novo.php";?>
                </main>
                <?php include "views/layout/footer.php";
            }
            else
            {
                $db = new AtendimentoDAO();
                if(is_null($atendimento->getCliente()))
                {
                    $c = new Cliente();
                    $c->setNome($atendimento->getNome());
                    $c->setTelefone($atendimento->getTelefone());
                    $db_c = new ClienteDAO();
                    $db_c->create($c);
                    $atendimento->setCliente($db_c->db_connection->lastInsertId());
                }
                echo  $db->create($atendimento);
                
                // header('Location: index.php?acao=agenda/listar');
            }
        }
    }
    
    // recebe o dia no formato "Y-m-d" 
    public function getAppointmentByDay($day) {
        $db = new AtendimentoDAO();
        $appointments = $db->getByDay($day);
        return $appointments;
    }
    
    public function deleteAppointment($email){
        require_once("./classes/atendimentos/AtendimentoDAO.php");
        $db = new ProfissionalDAO();
        $db->delete($email);
        header('Location: index.php?acao=atendimentos/listar');
    }
    
    public function editAppointment($email) {
        if(!isset($_POST['altera']))
        {
            require_once("./classes/atendimentos/ProfissionalDAO.php");
            $db = new ProfissionalDAO();
            $professional = $db->findOne($email);
            include_once "views/layout/header.php";
            include_once "views/layout/side-bar.php";?>
            <main>
                <?php include_once "views/atendimentos/editar.php";?>
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
    
    public function getPossibleStatus() {
        $db = new AtendimentoDAO();
        $status = $db->getStatus();
        return $status;
    }
    
    public function updateStatus($id) {
        $db = new AtendimentoDAO();
        $status = $_POST['appointmentStatus'];
        $db->updateStatus($id, $status);
        header('Location: index.php?acao=agenda/listar');
    }
}

$auth = new AuthController();
$auth->isAuthenticate();
$action = explode("/", $_GET['acao']);
$controller = new atendimentosController();
switch($action[0]) {
    case 'excluir': 
        echo $action[1];
        $controller->deleteAppointment($action[1]); 
        break;
    case 'cadastrar': 
        $controller->newAppointment();
        break;
    case 'editar':
        $controller->editAppointment($action[1]);
        break;
    case 'updateStatus':
        $controller->updateStatus($action[1]);
}
