<?php
    $name = isset($_POST['name']) ? $_POST['name'] : $cliente->getNome();
    $phone = isset($_POST['phone']) ? $_POST['phone'] : $cliente->getTelefone();
?>
<div class="small-title">Alterar Cliente</div>
<div class="page-content">
    <div class="small-title">Editar Cliente<hr></div>
    <form method="post">
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
        
        <div style="display: flex; justify-content: center;"><input type="submit" class="btn btn--green" value="Salvar" name="altera"></div>
    </form>

</div>
<script src="assets/js/forms.js"></script>