<?php
    include_once("./profissionaisController.php");
    $professionalController = new profissionaisController();
    $professionals = $professionalController->getProfessionals();
    include_once("./utilidades.php");
?>

<h1 class="small-title">Listar Profissionais</h1>
<div class="page-content">
    <button class="btn btn--green align-right"><a href="index.php?acao=profissionais/cadastrar">Novo profissional</a></button>
    <div class="page-content__list">

        <?php  if (count($professionals) == 0 ){?>
            <p>Nenhum profissional cadastrado</p>
        <?php } ?>

        <?php foreach($professionals as $professional){ ?>
            <div class="list__list-item">
            
                <div class="list-item__name"><?php echo $professional->getNome() ?></div>
                <div class="list-item__show-details">&#9660;</div>
                <div class="list-item__details">
                    <p>Email: <?php echo $professional->getEmail() ?></p>
                    <p>Telefone: <?php echo prettyPrintPhone($professional->getTelefone()) ?></p>
                    <p>Endereço: <?php echo $professional->getEndereco() ?></p>
                   
                    <small>Serviços associados (<?php echo count($professional->getServicos())?>):</small>
                    <?php if (count($professional->getServicos()) != 0) {?>
                        <div class="services__list">
                        <?php 
                        $servicos = $professional->getServicos();
                        foreach ($servicos  as $servico) {?>
                            <div class="list__professional"><?php echo $servico["nome"] ?></div>
                       <?php } ?>
                        
                    </div>
                    <?php }?>
                    
                    <div class="details__actions">
                        <button class="btn btn--green align-right"><a href="profissionaisController.php?acao=editar/<?php echo $professional->getEmail(); ?>">Editar</a></button>
                        <button class="btn btn--red align-right" onclick="setModalValue('<?=$professional->getEmail()?>')">Excluir</button>
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