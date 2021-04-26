<?php
include_once("views/layout/header.php");
?>   
    <main class="login-main">
        <div class="login"><span class="small-title">Login</span><hr>
            <div class="login-content">
                <form>
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
                    <input type="submit" class="btn btn--purple" value="Concluir agendamento">
                </form>
                <div class="recover"><a href="#">Esqueci minha senha</a></div>
            </div>
        </div>
        <script src="assets/js/forms.js"></script>
    </main>
<?php
include_once("views/layout/footer.php");
?>  