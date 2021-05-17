<?php 

require_once "./classes/servicos/Servico.php";
require_once "./classes/servicos/ServicoDAO.php";
require_once "./classes/capacitacao/Capacitacao.php";
require_once "./classes/capacitacao/CapacitacaoDAO.php";

class servicosController {
    public function newService(){
      ///
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

    public function deleteService($email){
        // $db = new ProfissionalDAO();
        // $db->delete($email);
        // header('Location: index.php?acao=profissionais/listar');
    }

    public function editService($email) {
       //        
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
