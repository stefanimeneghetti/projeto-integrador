<?php
    require_once("./classes/servicos/ServicoDAO.php");
    $db = new ServicoDAO();
    $services = $db->all();
    $name = isset($_POST['name']) ? $_POST['name'] : "";
    $phone = isset($_POST['phone']) ? $_POST['phone'] : "";
?>
<div class="small-title">Cadastrar Cliente</div>
<div class="page-content">
    <div class="small-title">Novo Cliente<hr></div>
    <form method="post" action="clientesController.php?acao=cadastrar">
        <div class="labeled-input ">
            <input id="name" name="name" class="full-width" type="text" value="<?=$name?>">
            <label for="name">
                Nome do cliente
            </label>
        </div>
        <div class="labeled-input">
            <input id="phone" name="phone" type="tel" value="<?=$phone?>">
            <label for="phone">
                Telefone
            </label>
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

        <div style="display: flex; justify-content: center;"><input type="submit" class="btn btn--green" value="Salvar"></div>
    </form>

</div>
<script src="assets/js/forms.js"></script>