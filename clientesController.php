<?php 
require_once "./classes/clientes/Cliente.php";
require_once "./classes/clientes/ClienteDAO.php";

class clientesController {
    public function newCliente(){
        $cliente = new Cliente();
        $cliente->setNome($_POST["name"]);
        $cliente->setTelefone(preg_replace('/[\(\)\-\s]/', '', $_POST["phone"]));

        $erros = $cliente->validate();

        if(count($erros) != 0) {
            include "views/layout/header.php";
            include "views/layout/side-bar.php";?>
            <main>
            <?php include "views/cliente/novo.php";?>
            </main>
            <?php include "views/layout/footer.php";
        }
        else
        {
            $db = new ClienteDAO();
            $db->create($cliente);

            header('Location: index.php?acao=cliente/listar');
        }
    }

    public function getClientes() {
        $db = new ClienteDAO();
        $clientes = $db->all();
        return $clientes;
    }

    public function deleteCliente($id){
        $db = new ClienteDAO();
        $db->delete($id);
        header('Location: index.php?acao=cliente/listar');
    }

    public function editCliente($id) {
        if(!isset($_POST['altera']))
        {
            require_once("./classes/clientes/ClienteDAO.php");
            $db = new ClienteDAO();
            $cliente = $db->findOne($id);
            include_once "views/layout/header.php";
            include_once "views/layout/side-bar.php";?>
            <main>
            <?php include_once "views/cliente/editar.php";?>
            </main>
            <?php include_once "views/layout/footer.php";
        }
        else
        {
            $cliente = new Cliente();
            $cliente->setNome($_POST["name"]);
            $cliente->setTelefone(preg_replace('/[\(\)\-\s]/', '', $_POST["phone"]));
            $erros = $cliente->validate();
            if(count($erros) != 0) {
                include_once "views/layout/header.php";
                include_once "views/layout/side-bar.php";?>
                <main>
                <?php include_once "views/cliente/editar.php";?>
                </main>
                <?php include_once "views/layout/footer.php";
            }
            else
            {
                $db = new ClienteDAO();
                $db->update($cliente, $id);
                
                header('Location: index.php?acao=cliente/listar');
            }
        }
    }
}

$action = explode("/", $_GET['acao']);
switch($action[0]) {
    case 'excluir': 
        $controller = new clientesController();
        $controller->deleteCliente($action[1]); 
        break;
    case 'cadastrar': 
        $controller = new clientesController();
        $controller->newCliente();
        break;
    case 'editar': 
        $controller = new clientesController();
        $controller->editCliente($action[1]);
        break;
}
