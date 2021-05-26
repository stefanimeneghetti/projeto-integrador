<?php
    require_once("./classes/profissionais/ProfissionalDAO.php");
    require_once("./classes/servicos/ServicoDAO.php");
    require_once("./classes/clientes/ClienteDAO.php");
    require_once("./classes/capacitacao/CapacitacaoDAO.php");
    require_once("./classes/atendimentos/AtendimentoDAO.php");
    require_once("./utilidades.php");
    $db_servico = new ServicoDAO();
    $db_atendimento = new AtendimentoDAO();
    $db_profissionais = new ProfissionalDAO();
    $db_capacitacoes = new CapacitacaoDAO();
    $profissionais_por_atendimento = array();
    $qtd_de_profissionais_por_atendimento = array();
    $horarios_ocupados_por_profissional = array();
    $profissionais = $db_profissionais->all();
    $services = $db_servico->all();
    $status = $db_atendimento->getStatus();
    $nome = isset($_POST['name']) ? $_POST['name'] : $appointment->getNome();
    $selectedClientsId = isset($_POST['client-id']) ? $_POST['client-id'] : $appointment->getCliente();
    $phone = isset($_POST['phone']) ? $_POST['phone'] : $appointment->getTelefone();
    $servico = isset($_POST['service']) ? $_POST['service'] : $appointment->getServico();
    $profissional = isset($_POST['professional']) ? $_POST['professional'] : $appointment->getProfissional();
    $preco = isset($_POST['price']) ? $_POST['price'] : $appointment->getQuantidade_paga();
    $data = isset($_POST['date']) ? $_POST['date'] : date("Y.m.d", strtotime($appointment->getFullDate()));
    $horario = isset($_POST['time']) ? $_POST['time'] : date("H:i", strtotime($appointment->getFullDate()));
    $descricao = isset($_POST['description']) ? $_POST['description'] : $appointment->getDescricao();
?>
<div class="small-title">Agenda</div>
<div class="page-content">
    <div class="small-title">Novo agendamento<hr></div>
    <form method="post" action="atendimentosController.php?acao=cadastrar">
        <input hidden id="selectedClientsId" name="client-id" value="<?=$selectedClientsId?>">
        <div class="form-line">
            <span class="labeled-input ">
                <input id="name" name="name" class="full-width" type="text" <?=isset($_POST['client-id']) && !empty($_POST['client-id'])? "style='border-color:#608b5c'": ""?> value="<?=$nome?>">
                <label for="name">
                    Nome do cliente
                </label>
            </span>
            <span class="labeled-input">
                <input id="phone" name="phone" type="tel" <?=isset($_POST['client-id']) && !empty($_POST['client-id'])? "style='border-color:#608b5c'": ""?> value="<?=$phone?>">
                <label for="phone">
                    Telefone
                </label>
            </span>
            <div class="btn btn--orange" style="width: 30%;" onclick="openClientsModal()"><a href="#">Cliente já registrado...</a></div>
        </div>

        <div class="form-line">
            <span class="labeled-input">
                    <select id="service" name="service" value="<?=$servico?>">
                    <option hidden disabled selected value></option>
                        <?php foreach ($services as $service) { ?>
                        <option value="<?php echo $service->getId() ?>"><?php echo $service->getNome() ?></option>
                        <?php } ?>
                    </select>
                    <label for="service">Selecionar serviço</label>
            </span>
            <span class="labeled-input">
                <select id="professional" name="professional" value="<?=$profissional?>">
                    <option hidden disabled selected value></option>
                    <?php foreach ($profissionais as $p) { ?>
                        <option value="<?php echo $p->getId() ?>"><?php echo $p->getNome() ?></option>
                        <?php } ?>
                </select>
                <label for="professional">Selecionar profissional</label>
            </span>
        </div>

        <div class="form-line">
            <span class="labeled-input">
                <input id="date" name="date" type="date" value="<?=$data?>">
                <label for="date" style="margin-top: 2px">Data</label>
            </span>
            <span class="labeled-input">
                <select id="time" name="time" value="<?=$horario?>">
                    <option hidden disabled selected value></option>
                    <?php
                    for($timeframeHour = 6; $timeframeHour < 24; $timeframeHour++)
                        for($timeframeMinute = 0; $timeframeMinute < 60; $timeframeMinute += 30)
                            echo "<option value='".date("H:i", strtotime($timeframeHour . ":" . $timeframeMinute))."'>".
                            date("H:i", strtotime($timeframeHour . ":" . $timeframeMinute))."</option>";
                    ?>
                    
                </select>
                <label for="time">Horário</label>
            </span>
        </div>

        <div class="form-line">
            <span class="labeled-input">
                    <select id="status" name="status" value="<?=$status?>">
                        <?php foreach ($status as $s) { ?>
                        <option value="<?php
                            echo $s['id'];
                            echo $s['id'] == $servico && !isset($_POST['service'])? "selected": "";
                            ?>"><?php echo $s['descricao'] ?></option>
                        <?php } ?>
                    </select>
                    <label for="status">Status do atendimento</label>

            <span class="labeled-input">
                <input id="price" name="price" type="text" value="<?php echo $preco ?>">
                <label for="price">
                    Preço pago
                </label>
            </span>
        </div>

        <div class="labeled-input">
            <textarea id="description" name="description" class="full-width" value="<?php echo $descricao?>"></textarea>
            <label for="description">
                Descrição
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
        <div style="display: flex; justify-content: center;"><input type="submit" class="btn btn--green" value="Concluir agendamento"></div>
    </form>
</div>
<?php
    include_once("./views/cliente/overlay.php");
?>
<script src="assets/js/forms.js"></script>
<script src="assets/js/atendimentos.js"></script>