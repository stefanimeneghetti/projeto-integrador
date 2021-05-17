<?php 

require_once "./classes/profissionais/Profissional.php";
require_once "./classes/profissionais/ProfissionalDAO.php";
require_once "./classes/capacitacao/Capacitacao.php";
require_once "./classes/capacitacao/CapacitacaoDAO.php";

class profissionaisController {
    public function newProfessional(){
        $profissional = new Profissional();
        $profissional->setNome($_POST["name"]);
        $profissional->setSenha($_POST["password"]);
        $profissional->setConfirmaSenha($_POST["password-confirm"]);
        $profissional->setEmail($_POST["email"]);
        $profissional->setEndereco($_POST["address"]);
        $profissional->setTelefone($_POST["phone"]);
        $profissional->setAtivo(1);
        
        $erros = $profissional->validate();
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
            $db = new ProfissionalDAO();
            $db->create($profissional); 
            foreach($_POST as $key => $value) { 
                if (explode("-",$key)[0] == "serviceSelected"){
                    $serviceId = explode("-",$key)[1];
                    $professionalEmail = $profissional->getEmail();
                    
                    $capacitation = new Capacitacao();
                    $capacitation->setProfissional($professionalEmail);
                    $capacitation->setServico($serviceId);
                    
                    $db = new CapacitacaoDAO();
                    $db->create($capacitation);
                }   
            }
            header('Location: index.php?acao=profissionais/listar');
        }
    }

    public function getProfessionals() {
        $db = new ProfissionalDAO();
        $professionals = $db->all();

        $db = new CapacitacaoDAO();
        foreach ($professionals as $professional) {
            $services = $db->findByProfissional($professional->getEmail());
            $professional->servicos = $services;
        }

        return $professionals;
    }

    public function deleteProfessional($email){
        $db = new ProfissionalDAO();
        $db->delete($email);
        header('Location: index.php?acao=profissionais/listar');
    }

    public function editProfessional($email) {
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
            $profissional->setTelefone($_POST["phone"]);
            $profissional->setAtivo(1);
            $erros = $profissional->validate();
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
                $db->update($profissional, $email); 
                header('Location: index.php?acao=profissionais/listar');
            }
        }
        
    }
}

$action = explode("/", $_GET['acao']);
switch($action[0]) {
    case 'excluir': 
        echo $action[1];
        $controller = new profissionaisController();
        $controller->deleteProfessional($action[1]); 
        break;
    case 'cadastrar': 
        $controller = new profissionaisController();
        $controller->newProfessional();
        break;
    case 'editar': 
        $controller = new profissionaisController();
        $controller->editProfessional($action[1]);
        break;
}
