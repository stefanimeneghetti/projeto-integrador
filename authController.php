<?php


class AuthController {
    public function login() {
        include_once "./classes/profissionais/ProfissionalDAO.php";
        if(isset($_POST['login'])){
            
            $email = $_POST['email'];
            $password = $_POST['password'];

            $db = new ProfissionalDAO();
            $user = $db->findOne($email);

            if($user && $password == $user->getSenha()){ 
                session_start();
                $_SESSION['logged'] = true;
                $_SESSION['session_start'] = date("d/m/Y h:i:s");
                header("Location: index.php");
            }
            else{
                $error = "Email ou Senha incorretos";
                include_once("views/layout/header.php");
                include_once("login.php");
            }
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: login.php");
    }

    public function isAuthenticate() {
        session_start();
        if ($_SESSION['logged'] != true) {
            header("Location: login.php");
        }
    }
}

$action = $_GET['acao'];
$controller = new AuthController();
switch($action) {
    case 'login': 
        $controller->login(); 
        break;
    case 'authenticate': 
        $controller->isAuthenticate();
        break;
    case 'logout':
        $controller->logout();
        break;
}