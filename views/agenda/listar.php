<?php 
    include_once "./atendimentosController.php";
    $controller = new atendimentosController();
    $day_string = isset($_GET['day']) ? $_GET['day'] : date('Y-m-d');
    $appointments = $controller->getAppointmentByDay($day_string);

    $status = $controller->getPossibleStatus();
// ?>

<h1 class="small-title">Agenda</h1>
<div class="page-content">
    <div class="page-content__header">
        <button id="daily-schedule" class="toggle-schedule-btn toggle-schedule-btn--select">
            Diária
            <?php echo isset($_GET['day'])  && $_GET['day']  != date('Y-m-d') ? "(".date("d/m/Y",strtotime($_GET['day'])).")": "" ?>
        </button>
        <button id="monthly-schedule" class="toggle-schedule-btn">Mensal</button>
    </div>
    <?php if (isset($_GET['day']) && $_GET['day']  != date('Y-m-d')) {?>
            <a href="index.php?acao=agenda/listar" class="schedule-see-more btn">Ver a Agenda de Hoje</a>
    <?php } ?>
    <div class="schedule">
        
        <div class="schedule--day">
            <?php if (count($appointments) == 0) {?>
                <p>Nenhum atendimento registrado para o dia de hoje!</p>
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
    <form class="modal modal--schedule" method="post" action="">
        <div class="modal-close" onclick="closeModal()">X</div>
        <label for="status">Selecionar estado do atendimento</label>
        <span class="select select--schedule">
            <select id="status" name="appointmentStatus" class="status--schedule">
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
