<?php 
    include_once "./atendimentosController.php";
    $controller = new atendimentosController();
    $day = strtotime('2021-05-20 15:00:00');
    $day_string = date('Y-m-d');
    $appointments = $controller->getAppointmentByDay($day_string);
?>

<h1 class="small-title">Agenda</h1>
<div class="page-content">
    <div class="page-content__header">
        <button id="daily-schedule" class="toggle-schedule-btn toggle-schedule-btn--select">Diária</button>
        <button id="monthly-schedule" class="toggle-schedule-btn">Mensal</button>
    </div>
    <div class="schedule">
        <div class="schedule--day">
            <?php if (count($appointments) == 0) {?>
                <p>Nenhum atendimento registrado!</p>
            <?php } ?>
            <?php foreach ($appointments as $appointment) { ?>
                <div class="schedule__item">
                    <div class="item__time">
                        <?= date("H:i",strtotime($appointment->getFullDate()))?> - <?= $appointment->getDuracao() ?>
                    </div>
                    <div class="item__service">
                        <?= $appointment->getServico() ?>
                    </div>
                    <div class="item__client-and-price">
                        <span class="client-and-price__client"><?= $appointment->getCliente() ?></span> -
                        <span class="client-and-price__price">R$ <?= str_replace(".", ",", $appointment->getPreco()) ?></span>
                    </div>
                    <div class="item__professional">
                        Profissional: <?= $appointment->getProfissional() ?>
                    </div>
                    <div class="item__actions">
                        <button class="btn btn--green align-right">Efetuado</button>
                        <button class="btn btn--red align-right"><a href="index.php?acao=agenda/editar">Mais Opções</a></button>
                    </div>
                </div>
            <?php } ?>
            
        </div>

        <div class="schedule--month">
            <div class="calendar">
                <div class="calendar__info">
                    <div class="info__year"></div>
                    <div class="info__month">
                        <button class="month__change-month month__change-month--prev"><img src="assets/images/icons/seta.svg" alt="Botão para acessar o mês anterior"></button>
                        <span></span>
                        <button class="month__change-month month__change-month--next"><img src="assets/images/icons/seta.svg" alt="Botão para acessar o mês posterior"></button>
                    </div>
                </div>

                <div class="calendar__days-week">
                    <div>Dom</div>
                    <div>Seg</div>
                    <div>Ter</div>
                    <div>Qua</div>
                    <div>Qui</div>
                    <div>Sex</div>
                    <div>Sab</div>
                </div>

                <div class="calendar__days">
                    <!-- Calendario gerado pelo javascript -->
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/agenda.js"></script>
