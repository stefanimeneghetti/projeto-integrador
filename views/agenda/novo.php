<?php
    require_once("./classes/profissionais/ProfissionalDAO.php");
    require_once("./classes/servicos/ServicoDAO.php");
    require_once("./classes/clientes/ClienteDAO.php");
    require_once("./classes/capacitacao/CapacitacaoDAO.php");
    require_once("./classes/atendimentos/AtendimentoDAO.php");
    require_once("./utilidades.php");
    $db_servico = new ServicoDAO();
    $servicos = $db_servico->all();
    $db_atendimento = new AtendimentoDAO();
    $db_profissionais = new ProfissionalDAO();
    $db_capacitacoes = new CapacitacaoDAO();
    $profissionais_por_atendimento = array();
    $qtd_de_profissionais_por_atendimento = array();
    $horarios_ocupados_por_profissional = array();
    foreach($db_profissionais->all() as $p)
    {
        $horarios = array();
        foreach($db_atendimento->getAppointmentsByProfessional($p->getId()) as $agendamento)
            $horarios[$agendamento->getFormattedDate()][] = $agendamento->getFormattedTime();
        $horarios_ocupados_por_profissional[$p->getId()] = $horarios;
    }

    $qtd_de_servicos = 0;
    foreach($servicos as $s) {
        $profissionais = array();
        $profissionais_de_s = $db_capacitacoes->findByServico($s->getId());
        foreach($profissionais_de_s as $p) {
            $profissionais[] = $db_profissionais->findById($p['id']);
        }
        $qtd_de_profissionais_por_atendimento[$qtd_de_servicos++] = $s->getId();
        $profissionais_por_atendimento[$s->getId()] = $profissionais;
    }
    $services = $db_servico->all();
    $status = $db_atendimento->getStatus();
    $nome = isset($_POST['name']) ? $_POST['name'] : "";
    $selectedClientsId = isset($_POST['client-id']) ? $_POST['client-id'] : "";
    $phone = isset($_POST['phone']) ? $_POST['phone'] : "";
    $servico = isset($_POST['service']) ? $_POST['service'] : "";
    $profissional = isset($_POST['professional']) ? $_POST['professional'] : "";
    $preco = isset($_POST['price']) ? $_POST['price'] : "";
    $data = isset($_POST['date']) ? $_POST['date'] : "";
    $horario = isset($_POST['time']) ? $_POST['time'] : "";
    $descricao = isset($_POST['description']) ? $_POST['description'] : "";
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
                    <select id="service" name="service" onchange="resetService()" value="<?=$servico?>">
                        <!-- <option hidden disabled selected value></option> -->
                        <?php foreach ($services as $service) { ?>
                        <option value="<?php echo $service->getId() ?>"><?php echo $service->getNome() ?></option>
                        <?php } ?>
                    </select>
                    <label for="service">Selecionar serviço</label>
            </span>
            <span class="labeled-input" <?=isset($_POST['service']) && !empty($_POST['service']) ? "" : " style='display:none'" ?>>
                <select id="professional" name="professional" onchange="resetProfessional()" value="<?=$profissional?>">
                    <!-- <option hidden disabled selected value></option> -->
                    <script>var qtd_profissionais_por_servico = <?= json_encode($qtd_de_profissionais_por_atendimento); ?>;</script>
                    <?php
                    foreach($profissionais_por_atendimento as $profissionais_habilitados)
                    {?>
                    <?php foreach($profissionais_habilitados as $p) {?>
                        <option class="servico-<?=array_search($profissionais_habilitados, $profissionais_por_atendimento)?>" value="<?= $p->getId()?>" style="display:none;"><?= $p->getNome()?></option>
                    <?php }
                    }
                    ?>
                </select>
                <label for="professional">Selecionar profissional</label>
            </span>
        </div>

        <div class="form-line">
            <span class="labeled-input" <?=isset($_POST['professional']) && !empty($_POST['professional'])? "" : " style='display:none'" ?>>
                <input id="date" name="date" type="date" onchange="resetDate()" value="<?=$data?>">
                <label for="date" style="margin-top: 2px">Data</label>
            </span>
            <span class="labeled-input" <?=isset($_POST['date']) && !empty($_POST['date']) ? "" : " style='display:none'" ?>>
                <select id="time" name="time" value="<?=$horario?>">
                    <!-- <option hidden disabled selected value></option> -->
                    <?php
                        if(isset($appointment_times))
                            foreach($appointment_times as $app_time)
                                echo "<option value='{$app_time}:00'>{$app_time}</option>";
                        
                    ?>
                    
                </select>
                <label for="time">Horário</label>
            </span>
        </div>

        <div class="form-line">
            <span class="labeled-input">
                    <select id="status" name="status" value="<?=$status?>">
                        <!-- <option hidden disabled selected value></option> -->
                        <?php foreach ($status as $s) { ?>
                        <option value="<?php echo $s['id'] ?>"><?php echo $s['descricao'] ?></option>
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