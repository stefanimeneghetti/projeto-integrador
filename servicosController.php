<?php 

require_once "./classes/servicos/Servico.php";
require_once "./classes/servicos/ServicoDAO.php";
require_once "./classes/capacitacao/Capacitacao.php";
require_once "./classes/capacitacao/CapacitacaoDAO.php";
require_once "./authController.php";

class servicosController {
    public function newService(){

        $service = new Servico();
        $service->setNome($_POST["name"]);
        $service->setPreco(str_replace(",",".", preg_replace("/[R\$\s]/", "", $_POST["price"]))); 
        $service->setDuracao((strlen($_POST["estimated-time"]) > 3? $_POST["estimated-time"] : ("0:" . $_POST["estimated-time"])) . ":00");
        $service->setDescricao($_POST["description"]);
        $service->setAtivo(1);

        $errors = $service->validate();
                
        $capacitacoesValidadas = array();
        foreach($_POST as $key => $value) { 
            if (explode("-",$key)[0] == "professionalSelected"){
                $serviceId = $service->getId();
                $professionalEmail = explode("-",$key)[1];
                
                $capacitation = new Capacitacao();
                $capacitation->setProfissional($professionalEmail);
                $capacitation->setServico($serviceId);
                $capacitacoesValidadas[] = $capacitation;
                $errors = array_merge($errors, $capacitation->validate(true));
            }
        }

        // TODO: Adicionar o serviço com os profissionais na tabela de capacitação
        if(count($errors) != 0) {
            include "views/layout/header.php";
            include "views/layout/side-bar.php";?>
            <main>
            <?php include "views/servicos/cadastrar.php";?>
            </main>
            <?php include "views/layout/footer.php";
        }
        else
        {
            $db = new ServicoDAO();
            $db->create($service);
            $servico = $db->db_connection->lastInsertId();
            foreach($capacitacoesValidadas as $val) {
                $db2 = new CapacitacaoDAO();
                $val->setServico($servico);
                $db2->create($val);
            }

            header('Location: index.php?acao=servicos/listar');
        }
    }

    public function getServices() {
        $db = new ServicoDAO();
        $services = $db->all();

        $db = new CapacitacaoDAO();
        foreach ($services as $service) {
            $id = $service->getId();
            $professionals = $db->findByServico($id);
            $service->setProfissionais($professionals);
        }

        return $services;
    }

    public function deleteService($id){
        $db = new CapacitacaoDAO();
        $db->deleteByService($id);
        $db = new ServicoDAO();
        $db->delete($id);

        header('Location: index.php?acao=servicos/listar');
    }

    public function editService($id) {
        $db = new ServicoDAO();
        $service = $db->findOne($id);
        if(!isset($_POST['altera']))
        {
            include_once "views/layout/header.php";
            include_once "views/layout/side-bar.php";?>
            <main>
            <?php include_once "views/servicos/editar.php";?>
            </main>
            <?php include_once "views/layout/footer.php";
        }
        else
        {
            $servico = new Servico();
            $servico->setId($id);
            $servico->setNome($_POST["name"]);
            $servico->setPreco(str_replace(",",".", preg_replace("/[R\$\s]/", "", $_POST["price"]))); 
            $servico->setDuracao((strlen($_POST["estimated-time"]) > 3? $_POST["estimated-time"] : ("0:" . $_POST["estimated-time"])) . ":00");
            $servico->setDescricao($_POST["description"]);
            $servico->setAtivo(1);
            $erros = $servico->validate();
                
            $capacitacoesValidadas = array();
            foreach($_POST as $key => $value) { 
                if (explode("-",$key)[0] == "professionalSelected"){
                    $professionalEmail = explode("-",$key)[1];
                    
                    $capacitation = new Capacitacao();
                    $capacitation->setProfissional($professionalEmail);
                    $capacitation->setServico($id);
                    $capacitacoesValidadas[] = $capacitation;
                    $erros = array_merge($erros, $capacitation->validate(false));
                }
            }

            if(count($erros) != 0) {
                include_once "views/layout/header.php";
                include_once "views/layout/side-bar.php";?>
                <main>
                <?php include_once "views/servicos/editar.php";?>
                </main>
                <?php include_once "views/layout/footer.php";
            }
            else
            {
                $db = new ServicoDAO();
                $db->update($servico);
                $db = new CapacitacaoDAO();
                $db->deleteByService($id);
                foreach($capacitacoesValidadas as $val) {
                    $db->create($val);
                }
                header('Location: index.php?acao=servicos/listar');
            }
        }
    }
}

$auth = new AuthController();
$auth->isAuthenticate();
$action = explode("/", $_GET['acao']);
switch($action[0]) {
    case 'excluir': 
        echo $action[1];
        $controller = new servicosController();
        $controller->deleteService($action[1]); 
        break;
    case 'cadastrar': 
        $controller = new servicosController();
        $controller->newService();
        break;
    case 'editar': 
        $controller = new servicosController();
        $controller->editService($action[1]);
        break;
}
