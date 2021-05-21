<?php
    include_once("./clientesController.php");
    $clientController = new clientesController();
    $clients = $clientController->getClientes();
    include_once("./utilidades.php");
?>
<h1 class="small-title">Listar Clientes</h1>
<div class="page-content">
    <button class="btn btn--green align-right"><a href="index.php?acao=cliente/novo">Novo cliente</a></button>
    <div class="page-content__list">
        <?php  if (count($clients) == 0 ){?>
            <p>Nenhum cliente cadastrado</p>
        <?php } ?>

        <?php foreach($clients as $client){ ?>
            <div class="list__list-item">
            <div class="list-item__name"><?=$client->getNome()?></div>
            <div class="list-item__show-details">&#9660;</div>
            <div class="list-item__details">
                <p>Telefone: <span class="list-item__phone"><?=$client->getTelefone()?></span></p>
                <small>Histórico (<?=!is_null($client->getHistorico()) ? count($client->getHistorico()) : 0;?>):</small>
                <div class="services__list">
                <?php if(!is_null($client->getHistorico())) foreach($client->getHistorico() as $atendimento) {?>
                    <div class="list__client"><?=$atendimento->getServico()->getNome()?></div>
                <?php }?>
                </div>
                
                <div class="details__actions">
                    <button class="btn btn--green align-right"><a href="clientesController.php?acao=editar/<?php echo $client->getId(); ?>">Editar</a></button>
                    <button class="btn btn--red align-right" onclick="setModalValue('clientesController.php?acao=excluir/<?=$client->getId()?>')">Excluir</button>
                </div>
            </div>
        </div>  
        <?php } ?>

  

    </div>
</div>

<div class="modal-bg">
    <form class="modal" method="post" action="">
        <div class="modal-close" onclick="closeModal()">X</div>
        Essa ação não poderá ser desfeita! Precisamos que você confirme sua senha antes de efetuar a exclusão.
        <div><div class="labeled-input">
            <input class="no-left-offset" name="modal-password" type="password">
            <label for="phone">
                Senha
            </label>
        </div>
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
        <input type="submit" class="btn btn--purple" value="Confirmar exclusão">
    </form>
</div>

<script src="assets/js/forms.js"></script>