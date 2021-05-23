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
    $phone = isset($_POST['phone']) ? $_POST['phone'] : "";
    $preco = isset($_POST['price']) ? $_POST['price'] : "";
    $data = isset($_POST['data']) ? $_POST['data'] : "";
    $horario = isset($_POST['time']) ? $_POST['time'] : "";
    $preco = isset($_POST['price']) ? $_POST['price'] : "";
    $descricao = isset($_POST['description']) ? $_POST['description'] : "";
?>
<div class="small-title">Agenda</div>
<div class="page-content">
    <div class="small-title">Novo agendamento<hr></div>
    <form method="post">
        <input hidden id="selectedClientsId" name="client-id" value="">
        <div class="form-line">
            <span class="labeled-input ">
                <input id="name" name="name" class="full-width" type="text">
                <label for="name">
                    Nome do cliente
                </label>
            </span>
            <span class="labeled-input">
                <input id="phone" name="phone" type="tel">
                <label for="phone">
                    Telefone
                </label>
            </span>
            <div class="btn btn--orange" style="width: 30%;" onclick="openClientsModal()"><a href="#">Cliente já registrado...</a></div>
        </div>

        <div class="form-line">  
            <span class="labeled-input">
                <div class="form-line">
                    <select id="services" name="services" class="half-width" onchange="updateProfessionalOptions()">
                        <option hidden disabled selected value></option>
                        <?php foreach ($services as $service) { ?>
                        <option value="<?php echo $service->getId() ?>"><?php echo $service->getNome() ?></option>
                        <?php } ?>
                    </select>
                    <label for="services">Selecionar serviço</label>
                </div>
            </span>
            
            <span class="labeled-input">
                <input id="date" name="date" type="date">
                <label for="date" style="margin-top: 2px">Data</label>
            </span>

            <span class="labeled-input">
                <script>horariosDisponiveis = <?=json_encode($horarios_ocupados_por_profissional)?>;</script>
                <select id="time" name="time" class="half-width">
                    <option hidden disabled selected value></option>
                    
                </select>
                <label for="time">Horário</label>
            </span>
        </div>

        <div class="form-line">
            <span class="labeled-input">
                    <select id="status" name="status">
                        <option hidden disabled selected value></option>
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

        <span class="labeled-input">
            <select id="professional" name="professional" class="half-width" onchange="updateTimeOptions()">
                <option hidden disabled selected value></option>
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

        <div class="labeled-input">
            <textarea id="description" name="description" class="full-width" value="<?php echo $descricao?>"></textarea>
            <label for="description">
                Descrição
            </label>
        </div>
        <div style="display: flex; justify-content: center;"><input type="submit" class="btn btn--green" value="Concluir agendamento"></div>
    </form>
</div>
<?php
    include_once("./views/cliente/overlay.php");
?>
<script src="assets/js/forms.js"></script>
<script src="assets/js/atendimentos.js"></script>