<?php
    include_once("./profissionaisController.php");
    $professionalController = new profissionaisController();
    $professionals = $professionalController->getProfessionals();
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
                    <p>Telefone: <?php echo $professional->getTelefone() ?></p>
                    <p>Endereço: <?php echo $professional->getEndereco() ?></p>
                   
                    <small>Serviços associados (<?php echo count($professional->servicos) ?>):</small>
                    <?php if (count($professional->servicos) != 0) { ?>
                        <div class="services__list">
                        <?php 
                        $servicos = $professional->servicos;
                        foreach ($servicos  as $servico) { ?>
                            <div class="list__professional"><?php  echo $servico["nome"] ?></div>
                       <?php } ?>
                        
                    </div>
                    <?php }?>
                    
                    <div class="details__actions">
                        <button class="btn btn--green align-right"><a href="profissionaisController.php?acao=editar/<?php echo $professional->getEmail(); ?>">Editar</a></button>
                        <button class="btn btn--red align-right"><a href="profissionaisController.php?acao=excluir/<?php echo $professional->getEmail(); ?>">Excluir</a></button>
                    </div>
                </div>
            </div>
        <?php } ?>   
    </div>
</div>
