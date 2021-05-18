<?php 

require_once "./classes/servicos/Servico.php";
require_once "./classes/servicos/ServicoDAO.php";
require_once "./classes/capacitacao/Capacitacao.php";
require_once "./classes/capacitacao/CapacitacaoDAO.php";

class servicosController {
    public function newService(){
        $service = new Servico();
        $service->setNome($_POST["name"]);
        $service->setPreco((int) str_replace(',', '.', $_POST["price"]));
        $service->setDuracao($_POST["estimated-time"]);
        $service->setDescricao($_POST["description"]);
        $service->setAtivo(1);

        $errors = $service->validate();

        // TODO: Adicionar o serviço com os profissionais na tabela de capacitação
        $errors = []; //! Apagar quando as validações forem corrigidas :)
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
            // foreach($capacitacoesValidadas as $val) {
            //     $db = new CapacitacaoDAO();
            //     $db->create($val);
            // }

            header('Location: index.php?acao=servicos/listar');
        }
    }

    public function getServices() {
        $db = new ServicoDAO();
        $services = $db->all();

        $db = new CapacitacaoDAO();
        foreach ($services as $service) {
            $id = (int) $service->getId();
            $professionals = $db->findByServico($id);
            $service->setProfissionais($professionals);
        }

        return $services;
    }

    public function deleteService($id){
        $db = new ServicoDAO();
        $db->delete($id);

        $db = new CapacitacaoDAO();
        $db->deleteByService($id);
        header('Location: index.php?acao=servicos/listar');
    }

    public function editService($id) {
        if(!isset($_POST['altera']))
        {
            $db = new ServicoDAO();
            $service = $db->findOne($id);
            
            include_once "views/layout/header.php";
            include_once "views/layout/side-bar.php";?>
            <main>
            <?php include_once "views/servicos/editar.php";?>
            </main>
            <?php include_once "views/layout/footer.php";
        }
        else
        {
            $servico = new servico();
            $servico->setNome($_POST["name"]);
            $erros = $servico->validate($email);
            // TODO: Adicionar o serviço com os profissionais na tabela de capacitação
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
                $db->update($servico, $id);
                header('Location: index.php?acao=servicos/listar');
            }
        }
    }
}

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
