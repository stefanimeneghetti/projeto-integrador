<div class="small-title">Cadastrar Cliente</div>
<div class="page-content">
    <div class="small-title">Novo Cliente<hr></div>
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
        <div style="display: flex; justify-content: center;"><input type="submit" class="btn btn--green" value="Salvar"></div>
    </form>

</div>
<script src="assets/js/forms.js"></script>