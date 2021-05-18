<?php
    $nome = isset($_POST['name']) ? $_POST['name'] : $service->getNome();
    $preco = isset($_POST['price']) ? $_POST['price'] : $service->getPreco();
    $duracao = isset($_POST['estimated-time']) ? $_POST['estimated-time'] : $service->getDuracao();
    $descricao = isset($_POST['description']) ? $_POST['description'] : $service->getDescricao();

?>
<div class="small-title">Editar serviço</div>
<div class="page-content">
    <div class="small-title">Editar serviço <hr></div>
    <form method="post" action="profissionaisController.php?acao=editar/">
        <span class="labeled-input ">
            <input id="name" name="name" class="full-width" type="text" required value="<?php echo $nome ?>">
            <label for="name">
                Nome
            </label>
        </span>
        <div class="form-line">
            <span class="labeled-input">
                <input id="price" name="price" class="half-width" type="text" required value="<?php echo $preco ?>">
                <label for="price">
                    Preço
                </label>
            </span>
            <span class="labeled-input">
                <select id="payment-method" name="payment-method" class="half-width" onchange="togglePriceFieldLock()">
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
                <input id="estimated-time" name="estimated-time" type="text" required value="<?php echo $duracao ?>">
                <label for="estimated-time">
                    Tempo estimado
                </label>
            </span>
        </div>

        <div class="labeled-input">
            <textarea id="description" name="description" class="full-width"> <?php echo $descricao ?></textarea>
            <label for="description">
                Descrição
            </label>
        </div>

        <br><div><b>Associar profissionais:</b></div><br>
        <span class="labeled-input">
            <div class="form-line">
                <select id="services" name="services" class="half-width">
                    <option hidden disabled selected value></option>
                    <option value="5">Fulaninho</option>
                    <option value="2">Fulaninha</option>
                    <option value="3">Juquinha</option>
                </select>
                <label for="services">Selecionar profissional</label>
                <span class="btn btn--green">Adicionar</span>
                <span class="btn btn--green">Adicionar todos os profissionais</span>
            </div>
        </span>
        <div class="selected-professionals">
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

        <div style="display: flex; justify-content: center;"><input type="submit" class="btn btn--green" value="Salvar alterações" name="altera"></div>
    </form>

</div>
<script src="assets/js/forms.js"></script>
<script src="assets/js/servicos.js"></script>