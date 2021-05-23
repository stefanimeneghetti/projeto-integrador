<?php 
    include_once "./atendimentosController.php";
    $controller = new atendimentosController();
    $day = strtotime('2021-05-20 15:00:00');
    $day_string = date('Y-m-d');
    $appointments = $controller->getAppointmentByDay($day_string);

    $status = $controller->getPossibleStatus();
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
                        <button class="btn btn--green align-right"><?= $appointment->getStatus() ?></button>
                        <button class="btn btn--red align-right" onclick="openModal(<?= $appointment->getId() ?>)">Mais Opções</button>
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

<div class="modal-bg">
    <form class="modal" method="post" action="">
        <div class="modal-close" onclick="closeModal()">X</div>
        <label for="status">Selecionar estado do atendimento</label>
        <span class="select">
            <select id="status" name="appointmentStatus" class="">
                <?php foreach ($status as $state) { ?>
                    <option value="<?= $state['id'] ?>"><?= $state['descricao'] ?></option>
                <?php } ?>
            </select>
        </span>
        <input type="submit" class="btn btn--purple" value="Alterar Estado do Atendimento">
    </form>
</div>

<script src="assets/js/agenda.js"></script>

<script>
function openModal(appointmentId, state) {
    modal = document.querySelector('.modal');
    modal.action = "atendimentosController.php?acao=updateStatus/"+appointmentId;
    modal.parentElement.style.display = "flex";
}

function closeModal() {
    modalOverlay = document.querySelector(".modal-bg");
    modalOverlay.style.display = "none";
}


</script>

<style>
#status {
    margin-left: 0;
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 2px solid #827A98;
    background-color: white;
    font-family: inherit;
    font-size: inherit;
    font-weight: 400;
    color: #827A98;
}

.select {
    width: 100%;
}

.modal {
    width: 100%;
}
</style>