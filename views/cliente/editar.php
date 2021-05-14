<div class="small-title">Alterar Cliente</div>
<div class="page-content">
    <div class="small-title">Editar Cliente<hr></div>
    <form method="post">
        <div class="labeled-input ">
            <input id="name" name="name" class="full-width" type="text" required>
            <label for="name">
                Nome do cliente
            </label>
        </div>
        <div class="labeled-input">
            <input id="phone" name="phone" type="tel" required>
            <label for="phone">
                Telefone
            </label>
        </div>
        
        <br><div><b>Histórico:</b></div><br>
        <div class="labeled-input">
            <input type="text" style="pointer-events:none;" value="Serviço X" readonly="readonly">
            <span class="sqr-btn sqr-btn--red">X</span>
            <span class="sqr-btn sqr-btn--orange"><img src="assets/images/icons/editar.svg" style="margin-bottom: -5px;"></span>
        </div>
        <div class="labeled-input">
            <input type="text" style="pointer-events:none;" value="Serviço Y" readonly="readonly">
            <span class="sqr-btn sqr-btn--red">X</span>
            <span class="sqr-btn sqr-btn--orange"><img src="assets/images/icons/editar.svg" style="margin-bottom: -5px;"></span>
        </div>

        <div style="display: flex; justify-content: center;"><input type="submit" class="btn btn--green" value="Salvar"></div>
    </form>

</div>
<script src="assets/js/forms.js"></script>