<?php
include_once("views/layout/header.php");
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
    }
}
?>
    <main class="login-main">
        <div class="login"><span class="small-title">Login</span><hr>
            <div class="login-content">
                <?php
                        echo "<br><div>$error</div>";
                ?>
                <form method="post" action="login.php">
                    <div class="labeled-input">
                        <input id="email" name="email" type="email" required>
                        <label for="email">
                            Email
                        </label>
                    </div>
                    <div class="labeled-input">
                        <input id="password" name="password" type="password" required>
                        <label for="password">
                            Senha
                        </label>
                    </div>
                    <input type="submit" class="btn btn--purple" value="Efetuar login" name="login">
                </form>
                <div class="recover"><a href="#">Esqueci minha senha</a></div>
            </div>
        </div>
        <script src="assets/js/forms.js"></script>
    </main>
<?php
include_once("views/layout/footer.php");
?>