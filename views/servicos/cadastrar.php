<div class="small-title">Cadastrar serviço</div>
<div class="page-content">
    <div class="small-title">Novo serviço <hr></div>
    <form>
        <span class="labeled-input ">
            <input id="name" class="full-width" type="text" required>
            <label for="name">
                Nome
            </label>
        </span>
        <div class="form-line">
            <span class="labeled-input">
                <input id="price" class="half-width" type="text" required>
                <label for="price">
                    Preço
                </label>
            </span>
            <span class="labeled-input">
                <select id="payment-method" class="half-width" onchange="togglePriceFieldLock()">
                    <option hidden disabled selected value></option>
                    <option value="1">Valor mínimo</option>
                    <option value="2">Valor específico</option>
                    <option value="3">À combinar</option>
                </select>
                <label for="payment-method">
                    Formato do pagamento
                </label>
            </span>
            <span class="labeled-input">
                <input id="estimated-time" type="text" required>
                <label for="estimated-time">
                    Tempo estimado
                </label>
            </span>
        </div>

        <div class="labeled-input">
            <textarea id="description" class="full-width"></textarea>
            <label for="description">
                Descrição
            </label>
        </div>

        <br><div><b>Associar profissionais:</b></div><br>
        <span class="labeled-input">
            <div class="form-line">
                <select id="services" class="half-width">
                    <option hidden disabled selected value></option>
                    <option value="5">Fulaninho</option>
                    <option value="2">Fulaninha</option>
                    <option value="3">Juquinha</option>
                </select>
                <label for="services">Selecionar profissional</label>
                <span class="btn btn--green">Adicionar</span>
                <span class="btn btn--green">Adicionar todos os profissionais</span>
            </div>
        </span>
        <span class="labeled-input">
            <input type="text" style="pointer-events:none;" value="Vel'koz" readonly="readonly">
            <span class="btn--rmv">X</span>
        </span>

        <div style="display: flex; justify-content: center;"><input type="submit" class="btn btn--green" value="Cadastrar serviço"></div>
    </form>

</div>
<script src="assets/js/forms.js"></script>