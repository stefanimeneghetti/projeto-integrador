<?php
include_once("views/layout/header.php");
?>
    <main class="login-main">
        <div class="login"><span class="small-title">Login</span><hr>
            <div class="login-content">
                <?php
                    if(isset($errors))
                        foreach($errors as $error)
                            echo "<br><p>$error</p>";
                ?>
                <form method="post" action="authController.php?acao=login">
                    <div class="labeled-input">
                        <input id="email" name="email" type="email" value="<?=isset($_POST['email'])? $_POST['email'] :"" ?>">
                        <label for="email">
                            Email
                        </label>
                    </div>
                    <div class="labeled-input">
                        <input id="password" name="password" type="password">
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