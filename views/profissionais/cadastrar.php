<?php
    require_once("./classes/servicos/ServicoDAO.php");
    $db = new ServicoDAO();
    $services = $db->all();
    $name = isset($_POST['name']) ? $_POST['name'] : "";
    $phone = isset($_POST['phone']) ? $_POST['phone'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $confirmPassword = isset($_POST['password-confirm']) ? $_POST['password-confirm'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $address = isset($_POST['address']) ? $_POST['address'] : "";
?>
<div class="small-title">Cadastrar profissional</div>
<div class="page-content">
    <div class="small-title">Novo profissional <hr></div>
    <form method="post" action="profissionaisController.php?acao=cadastrar">
        <div class="col-md-6 mt-4 pl-0 user-information__user-image">
            <div class="user-image__wrapper">
                <img src="assets/images/placeholder.png" class="user-image__image" alt="Preview da imagem do usuário.">
                <label class="user-image__label" for="user-image" tabindex=0>
                    <input type="file" name="user-image" class="user-image__input" accept="image/*" id="user-image"/>
                    <img src="assets/images/icons/lapis.svg" alt="Selecionar foto do profissional.">
                </label>
            </div>
        </div>
        <br>
        <hr>
        <br>
        <span class="labeled-input">
            <input id="name" name="name" class="full-width" type="text" value="<?=$name?>">
            <label for="name">
                Nome
            </label>
        </span>
        <div class="form-line">
            <span class="labeled-input">
                <input id="password" name="password" class="half-width" type="password">
                <label for="password">
                    Senha
                </label>
            </span>
            <span class="labeled-input">
                <input id="password-confirm" name="password-confirm" class="half-width" type="password">
                <label for="password-confirm">
                    Confirmar senha
                </label>
            </span>
        </div>
        <div class="form-line">
            <span class="labeled-input">
                <input id="email" name="email" class="full-width" type="email" value="<?=$email?>">
                <label for="email">
                    Email
                </label>
            </span>
            <span class="labeled-input">
                <input id="phone" name="phone" type="tel" value="<?=$phone?>">
                <label for="phone">
                    Telefone
                </label>
            </span>
        </div>

        <div class="labeled-input">
            <input id="address" name="address" class="full-width" value="<?=$address?>">
            <label for="address">
                Endereço
            </label>
        </div>

        <br><div><b>Associar serviços:</b></div>
        <span class="labeled-input">
            <div class="form-line">
                <select id="services" name="services" class="half-width">
                    <option hidden disabled selected value></option>
                    <?php foreach ($services as $service) { ?>
                    <option value="<?php echo $service->getId() ?>"><?php echo $service->getNome() ?></option>
                    <?php } ?>
                </select>
                <label for="services">Selecionar serviço</label>
                <span class="btn btn--green" onclick="addService()">Adicionar</span>
                <span class="btn btn--green" onclick="addAllServices()">Adicionar todos os serviços</span>
            </div>
        </span>

        <div class="selected-services">
            <!-- Serão adicionados via javascript -->
        </div>

        <div class="left-offset">
        <?php
            if (isset($erros) && count($erros) != 0) {
                echo "<ul>";
                foreach ($erros as $e)
                    echo "<li>$e</li>";
                echo "</ul>";
            }            
        ?></div>
        <div style="display: flex; justify-content: center;"><input type="submit" class="btn btn--green" value="Cadastrar profissional"></div>
    </form>

</div>
<script src="assets/js/forms.js"></script>
<script src="assets/js/profissionais.js"></script>
