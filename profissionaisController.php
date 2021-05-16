<?php 

require_once "./classes/profissionais/Profissional.php";
require_once "./classes/profissionais/ProfissionalDAO.php";

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
            header('Location: index.php?acao=profissionais/listar');
        }
    }

    public function getProfessionals() {
        $db = new ProfissionalDAO();
        $professionals = $db->all();
        return $professionals;
    }

    public function deleteProfessional($email){
        $db = new ProfissionalDAO();
        $db->delete($email);
        header('Location: index.php?acao=profissionais/listar');
    }

    public function editProfessional($email) {
        $profissional = new Profissional();
        $profissional->setNome($_POST["name"]);
        $profissional->setSenha($_POST["password"]);
        $profissional->setEmail($_POST["email"]);
        $profissional->setEndereco($_POST["address"]);
        $profissional->setTelefone($_POST["phone"]);
        $db = new ProfissionalDAO();
        $db->update($profissional, $email); 

        header('Location: index.php?acao=profissionais/listar');
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
