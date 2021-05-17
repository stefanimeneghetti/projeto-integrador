<div class="small-title">Agenda</div>
<div class="page-content">
    <?php
        $name = isset($_POST['name']) ? $_POST['name'] : "";
        $phone = isset($_POST['phone']) ? $_POST['phone'] : "";
        $service = isset($_POST['service']) ? $_POST['service'] : "";
        $date = isset($_POST['date']) ? $_POST['date'] : "";
        $time = isset($_POST['time']) ? $_POST['time'] : "";
        $pago = isset($_POST['pago']) && ($_POST['pago'] == "true" || $_POST['pago'] == "on")? "true" : "false";
        $profissional = isset($_POST['professional']) ? $_POST['professional'] : "";
    ?>

    <div class="small-title">Editar agendamento<hr></div>
    <form method="POST" action="">
        <div class="form-line">
            <span class="labeled-input">
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
                    <?=$_POST['service']  == "" ? "<option hidden disabled selected value></option>" : ""?>
                    <option value="1">Serviço A</option>
                    <option value="2">Serviço B</option>
                    <option value="3">Serviço C</option>
                </select>
                <label for="service">Selecionar serviço</label>
            </span>
            <span class="labeled-input">
                <input id="date" name="date" type="date" value="<?=$date?>">
                <label for="date" style="margin-top: 2px">Data</label>
            </span>
            <span class="labeled-input">
                <select id="time" name="time" class="half-width" value="<?=$time?>">
                    <?=!isset($_POST['time']) ? "<option hidden disabled selected value></option>" : ""?>
                    <option value="1" <?=$_POST['time'] == "1" ? "selected" : ""?>>05:00</option>
                    <option value="2" <?=$_POST['time'] == "2" ? "selected" : ""?>>05:30</option>
                    <option value="3" <?=$_POST['time'] == "3" ? "selected" : ""?>>06:00</option>
                    <option value="4">06:30</option>
                    <option value="5">07:00</option>
                    <option value="6">07:30</option>
                    <option value="7">08:00</option>
                    <option value="8">08:30</option>
                    <option value="9">09:00</option>
                    <option value="10">09:30</option>
                    <option value="11">10:00</option>
                    <option value="12">10:30</option>
                    <option value="13">11:00</option>
                    <option value="14">11:30</option>
                    <option value="15">12:00</option>
                    <option value="16">12:30</option>
                    <option value="17">13:00</option>
                    <option value="18">13:30</option>
                    <option value="19">14:00</option>
                    <option value="20">14:30</option>
                    <option value="21">15:00</option>
                    <option value="22">15:30</option>
                    <option value="23">16:00</option>
                    <option value="24">16:30</option>
                    <option value="25">17:00</option>
                    <option value="26">17:30</option>
                    <option value="27">18:00</option>
                    <option value="28">18:30</option>
                    <option value="29">19:00</option>
                    <option value="30">19:30</option>
                    <option value="31">20:00</option>
                    <option value="32">20:30</option>
                    <option value="33">21:00</option>
                    <option value="34">21:30</option>
                    <option value="35">22:00</option>
                    <option value="36">22:30</option>
                    <option value="37">23:00</option>
                    <option value="38">23:30</option>
                </select>
                <label for="time">Horário</label>
                </span>        

            <span class="labeled-input">
                <input id="pago" name="pago" type="checkbox" checked=<?=$pago?>>
                <label for="pago" style="margin-top: 2px">Pago</label>
            </span>
            </div>
        </span>

        <span class="labeled-input">
            <select id="professional" name="professional" class="full-width" value="<?=$profissional?>">
                    <?=!isset($_POST['professional']) ? "<option hidden disabled selected value></option>" : ""?>
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