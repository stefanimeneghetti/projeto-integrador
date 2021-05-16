<div class="small-title">Agenda</div>
<div class="page-content">
    <?php
        $nome = isset($_POST['name']) ? $_POST['name'] : "";
        $email = isset($_POST['phone']) ? $_POST['phone'] : "";
        $tel = isset($_POST['service']) ? $_POST['service'] : "";
        $data = isset($_POST['date']) ? $_POST['date'] : "";
        $end = isset($_POST['time']) ? $_POST['time'] : "";
        $bairro = isset($_POST['pago']) ? $_POST['pago'] : "";
        $cc = isset($_POST['professional']) ? $_POST['professional'] : "";
    ?>

    <div class="small-title">Editar agendamento <hr></div>
    <form method="POST">
        <div class="form-line">
            <span class="labeled-input ">
                <input id="name" name="name" class="full-width" type="text" required value="<?=$name?>">
                <label for="name">
                    Nome do cliente
                </label>
            </span>
            <span class="labeled-input">
                <input id="phone" name="phone" type="tel" required value="<?=$phone?>">
                <label for="phone">
                    Telefone
                </label>
            </span>
            <div class="btn btn--orange" style="width: 30%;"><a href="#">Cliente já registrado...</a></div>
        </div>

        <div class="form-line">  
            <span class="labeled-input">
                <select id="service" name="service" class="full-width" value="<?=$service?>">
                    <option hidden disabled selected value></option>
                    <option value="1">Serviço A</option>
                    <option value="2">Serviço B</option>
                    <option value="3">Serviço C</option>
                </select>
                <label for="service">Selecionar serviço</label>
            </span>
            
            <span class="labeled-input">
                <input id="date" name="date" type="date">
                <label for="date" style="margin-top: 2px">Data</label>
            </span>

            <span class="labeled-input">
                <select id="time" name="time" class="half-width">
                    <option hidden disabled selected value></option>
                    <option value="1">05:00</option>
                    <option value="2">05:30</option>
                    <option value="1">06:00</option>
                    <option value="2">06:30</option>
                    <option value="1">07:00</option>
                    <option value="2">07:30</option>
                    <option value="1">08:00</option>
                    <option value="2">08:30</option>
                    <option value="1">09:00</option>
                    <option value="2">09:30</option>
                    <option value="1">10:00</option>
                    <option value="2">10:30</option>
                    <option value="1">11:00</option>
                    <option value="2">11:30</option>
                    <option value="1">12:00</option>
                    <option value="2">12:30</option>
                    <option value="1">13:00</option>
                    <option value="2">13:30</option>
                    <option value="1">14:00</option>
                    <option value="2">14:30</option>
                    <option value="1">15:00</option>
                    <option value="2">15:30</option>
                    <option value="1">16:00</option>
                    <option value="2">16:30</option>
                    <option value="1">17:00</option>
                    <option value="2">17:30</option>
                    <option value="1">18:00</option>
                    <option value="2">18:30</option>
                    <option value="1">19:00</option>
                    <option value="2">19:30</option>
                    <option value="1">20:00</option>
                    <option value="2">20:30</option>
                    <option value="1">21:00</option>
                    <option value="2">21:30</option>
                    <option value="1">22:00</option>
                    <option value="2">22:30</option>
                    <option value="1">23:00</option>
                    <option value="2">23:30</option>
                </select>
                <label for="time">Horário</label>
                </span>        

            <span class="labeled-input">
                <input id="pago" name="pago" type="checkbox">
                <label for="pago" style="margin-top: 2px">Pago</label>
            </span>
            </div>
        </span>

        <span class="labeled-input">
            <select id="professional" name="professional" class="full-width">
                <option hidden disabled selected value></option>
                <option value="1">Zequinha</option>
                <option value="2">Cicraninha</option>
                <option value="3">Fulaninho</option>
            </select>
            <label for="professional">Selecionar profissional</label>
        </span>

        <?php
            if (isset($erros) && count($erros) != 0) {
                echo "<ul>";
                foreach ($erros as $e)
                    echo "<li>$e</li>";
                echo "</ul>";
            }            
        ?>

        <div style="display: flex; justify-content: center;"><input type="submit" class="btn btn--green" value="Salvar alterações"></div>
    </form>

</div>
<script src="assets/js/forms.js"></script>