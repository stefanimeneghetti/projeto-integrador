<h1 class="small-title">Agenda</h1>
<div class="page-content">
    <div class="page-content__header">
        <button id="daily-schedule" class="toggle-schedule-btn toggle-schedule-btn--select">Diária</button>
        <button id="monthly-schedule" class="toggle-schedule-btn">Mensal</button>
    </div>
    <div class="schedule">
        <div class="schedule--day">
            <div class="schedule__item">
                <div class="item__time">
                    08:30 - 30min
                </div>
                <div class="item__service">
                    Corte Padrão
                </div>
                <div class="item__client-and-price">
                    <span class="client-and-price__client">Nome do cliente</span> -
                    <span class="client-and-price__price">R$ 30,00</span>
                </div>
                <div class="item__actions">
                    <button class="btn btn--green align-right">Efetuado</button>
                    <button class="btn btn--red align-right">Mais Opções</button>
                </div>
            </div>
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
