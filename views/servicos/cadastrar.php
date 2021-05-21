<?php
    require_once("./classes/profissionais/ProfissionalDAO.php");
    $db = new ProfissionalDAO();
    $professionals = $db->all();
    $nome = isset($_POST['name']) ? $_POST['name'] : "";
    $preco = isset($_POST['price']) ? $_POST['price'] : "";
    $duracao = isset($_POST['estimated-time']) ? $_POST['estimated-time'] : "";
    $descricao = isset($_POST['description']) ? $_POST['description'] : "";
?>
<div class="small-title">Cadastrar serviço</div>
<div class="page-content">
    <div class="small-title">Novo serviço <hr></div>
    <form method="post" action="servicosController.php?acao=cadastrar">
        <span class="labeled-input ">
            <input id="name" name="name" class="full-width" type="text" maxlength="50" value="<?php echo $nome ?>">
            <label for="name">
                Nome
            </label>
        </span>
        <div class="form-line">
            <span class="labeled-input">
                <input id="price" name="price" class="half-width" type="text" value="<?php echo $preco?>">
                <label for="price">
                    Preço
                </label>
            </span>
            <span class="labeled-input">
                <select id="payment-method" name="payment-method" class="full-width" onchange="togglePriceFieldLock()" value="<?php echo $metodo_pagamento?>">
                    <option hidden disabled selected value></option>
                    <option value="1">Valor mínimo</option>
                    <option value="2">Valor específico</option>
                    <option value="3">À combinar</option>
                </select>
                <label for="payment-method">
                    Formato do pagamento
                </label>
            </span>
            <span class="labeled-input">
                <input id="estimated-time" name="estimated-time" maxlength="5" value="<?php echo $duracao?>">
                <label for="estimated-time">
                    Tempo estimado
                </label>
            </span>
        </div>

        <div class="labeled-input">
            <textarea id="description" name="description" class="full-width" value="<?php echo $descricao?>"></textarea>
            <label for="description">
                Descrição
            </label>
        </div>

        <br><div><b>Associar profissionais:</b></div><br>
        <span class="labeled-input">
            <div class="form-line">
                <select id="professionals" name="professionals" class="half-width">
                    <option hidden disabled selected value></option>
                    <?php if(isset($professionals))foreach ($professionals as $professional) { ?>
                    <option value="<?php echo $professional->getId() ?>"><?php echo $professional->getNome() ?></option>
                    <?php } ?>
                </select>
                <label for="professionals">Selecionar profissional</label>
                <span class="btn btn--green" onclick="addProfessional()">Adicionar</span>
                <span class="btn btn--green" onclick="addAllProfessionals()">Adicionar todos os profissionais</span>
            </div>
        </span>
        
        <div class="selected-professionals">
            <!-- Serão adicionados via javascript -->
        </div>

        <div class="left-offset">
        <?php
            if (isset($errors) && count($errors) != 0) {
                echo "<ul>";
                foreach ($errors as $e)
                    echo "<li>$e</li>";
                echo "</ul>";
            }            
        ?></div>

        <div style="display: flex; justify-content: center;"><input type="submit" class="btn btn--green" value="Cadastrar serviço"></div>
    </form>

</div>
<script src="assets/js/forms.js"></script>
<script src="assets/js/servicos.js"></script>