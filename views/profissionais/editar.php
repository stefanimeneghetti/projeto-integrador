<?php
    $name = isset($_POST['name']) ? $_POST['name'] : $professional->getNome();
    $phone = isset($_POST['phone']) ? $_POST['phone'] : $professional->getTelefone();
    $password = isset($_POST['password']) ? $_POST['password'] : $professional->getSenha();
    $confirmPassword = isset($_POST['password-confirm']) ? $_POST['password-confirm'] : $professional->getSenha();
    $email = isset($_POST['email']) ? $_POST['email'] :  $professional->getEmail();
    $address = isset($_POST['address']) ? $_POST['address'] :  $professional->getEndereco();

?>

<div class="small-title">Editar profissional</div>
<div class="page-content">
    <div class="small-title">Editar profissional <hr></div>
    <form method="post" action="profissionaisController.php?acao=editar/<?php echo isset($_POST['email']) ? $_POST['email'] :  $professional->getEmail()?>">
        <div class="col-md-6 mt-4 pl-0 user-information__user-image">
            <div class="user-image__wrapper">
                <img src="assets/images/user-pic.jpg" class="user-image__image" alt="Preview da imagem do usuário.">
                <label class="user-image__label" for="user-image" tabindex=0>
                    <input type="file" name="user-image" class="user-image__input" accept="image/*" id="user-image"/>
                    <img src="assets/images/icons/lapis.svg" alt="Selecionar foto do profissional.">
                </label>
            </div>
        </div>
        <br>
        <hr>
        <br>
        <span class="labeled-input ">
            <input id="name" name="name" class="full-width" type="text" required value="<?php echo $name; ?>">
            <label for="name">
                Nome
            </label>
        </span>
        <div class="form-line">
            <span class="labeled-input">
                <input id="password" name="password" class="half-width" type="password" required value="<?php echo $password; ?>">
                <label for="password">
                    Senha
                </label>
            </span>
            <span class="labeled-input">
                <input id="password-confirm" name="password-confirm" class="half-width" type="password" required value="<?php echo $confirmPassword; ?>">
                <label for="password-confirm">
                    Confirmar senha
                </label>
            </span>
        </div>
        <div class="form-line">
            <span class="labeled-input">
                <input id="email" name="email" class="full-width" type="email" required value="<?php echo $email; ?>">
                <label for="email">
                    Email
                </label>
            </span>
            <span class="labeled-input">
                <input id="phone" name="phone" type="tel" required value="<?php echo $phone; ?>">
                <label for="phone">
                    Telefone
                </label>
            </span>
        </div>

        <div class="labeled-input">
            <input id="address" name="address" type="" required value="<?php echo $address; ?>">
            <label for="address">
                Endereço
            </label>
        </div>

        <br><div><b>Associar serviços:</b></div><br>
        <span class="labeled-input">
            <div class="form-line">
                <select id="services" name="services" class="half-width">
                    <option hidden disabled selected value></option>
                    <option value="5">Opt 1</option>
                    <option value="2">Opt 2</option>
                    <option value="3">Opt 3</option>
                </select>
                <label for="services">Selecionar serviço</label>
                <span class="btn btn--green">Adicionar</span>
                <span class="btn btn--green">Adicionar todos os serviços</span>
            </div>
        </span>
        <span class="labeled-input">
            <input type="text" style="pointer-events:none;" value="Serviço X" readonly="readonly">
            <span class="sqr-btn sqr-btn--red">X</span>
        </span>

        <?php
            if (isset($erros) && count($erros) != 0) {
                echo "<ul>";
                foreach ($erros as $e)
                    echo "<li>$e</li>";
                echo "</ul>";
            }            
        ?>
        <div style="display: flex; justify-content: center;"><input type="submit" class="btn btn--green" value="Salvar alterações" name="altera"></div>
    </form>

</div>
<script src="assets/js/forms.js"></script>
