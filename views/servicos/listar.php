<?php
    include_once("./servicosController.php");
    $serviceController = new servicosController();
    $services = $serviceController->getServices();
    include_once("./utilidades.php");
?>

<h1 class="small-title">Listar Serviços</h1>
<div class="page-content">
    <button class="btn btn--green align-right"><a href="index.php?acao=servicos/cadastrar">Novo serviço</a></button>
    <div class="page-content__list">
    <?php  if (count($services) == 0 ){?>
            <p>Nenhum serviço cadastrado</p>
    <?php } ?>

    <?php foreach($services as $service) { ?>
            <div class="list__list-item">
                <div class="list-item__name"><?php  echo $service->getNome() ?></div>
                <div class="list-item__show-details">&#9660;</div>
                <div class="list-item__details">
                    <div class="details__price"><strong>Preço: </strong>R$ <?php  echo prettyPrintPrice($service->getPreco()) ?></div>
                    <div class="details__description"><strong>Duração estimada:</strong> <?php  echo prettyPrintTime($service->getDuracao()) ?></div>
                    <?php if(!empty($service->getDescricao())) {?><div class="details__description"><strong>Descrição:</strong> <?php  echo $service->getDescricao() ?>.</div><?php }?>
                    <div class="details__professionals">
                        <small>Profissionais (<?php  echo count($service->getProfissionais()) ?>)</small>
                        <div class="professionals__list">
                            <?php foreach ($service->getProfissionais() as $professional) { ?>
                                <div class="list__professional"><?php echo $professional["nome"]; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="details__actions">
                        <button class="btn btn--green align-right"><a href="servicosController.php?acao=editar/<?php echo $service->getId(); ?>">Editar</a></button>
                        <button class="btn btn--red align-right"><a href="servicosController.php?acao=excluir/<?php echo $service->getId(); ?>">Excluir</a></button>
                    </div>
                </div>
            </div>
        <?php } ?>   
    </div>
</div>
