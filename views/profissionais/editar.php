<div class="small-title">Editar profissional</div>
<div class="page-content">
    <div class="small-title">Editar profissional <hr></div>
    <form>
        <div class="col-md-6 mt-4 pl-0 user-information__user-image">
            <div class="user-image__wrapper">
                <img src="assets/images/user-pic.jpg" class="user-image__image" alt="Preview da imagem do usuário.">
                <label class="user-image__label" for="user-image" tabindex=0>
                    <input type="file" name="user-image" class="user-image__input" accept="image/*" id="user-image"/>
                    <img src="assets/images/icons/lapis.svg" alt="Selecionar foto do profissional.">
                </label>
            </div>
        </div>
        <br>
        <hr>
        <br>
        <span class="labeled-input ">
            <input id="name" name="name" class="full-width" type="text" required>
            <label for="name">
                Nome
            </label>
        </span>
        <div class="form-line">
            <span class="labeled-input">
                <input id="password" name="password" class="half-width" type="password" required>
                <label for="password">
                    Senha
                </label>
            </span>
            <span class="labeled-input">
                <input id="password-confirm" name="password-confirm" class="half-width" type="password" required>
                <label for="password-confirm">
                    Confirmar senha
                </label>
            </span>
        </div>
        <div class="form-line">
            <span class="labeled-input">
                <input id="email" name="email" class="full-width" type="email" required>
                <label for="email">
                    Email
                </label>
            </span>
            <span class="labeled-input">
                <input id="phone" name="email" type="tel" required>
                <label for="phone">
                    Telefone
                </label>
            </span>
        </div>

        <div class="labeled-input">
            <input id="address" name="address" type="" required>
            <label for="address">
                Endereço
            </label>
        </div>

        <br><div><b>Associar serviços:</b></div><br>
        <span class="labeled-input">
            <div class="form-line">
                <select id="services" name="services" class="half-width">
                    <option hidden disabled selected value></option>
                    <option value="5">Opt 1</option>
                    <option value="2">Opt 2</option>
                    <option value="3">Opt 3</option>
                </select>
                <label for="services">Selecionar serviço</label>
                <span class="btn btn--green">Adicionar</span>
                <span class="btn btn--green">Adicionar todos os serviços</span>
            </div>
        </span>
        <span class="labeled-input">
            <input type="text" style="pointer-events:none;" value="Serviço X" readonly="readonly">
            <span class="sqr-btn sqr-btn--red">X</span>
        </span>

        <div style="display: flex; justify-content: center;"><input type="submit" class="btn btn--green" value="Salvar alterações"></div>
    </form>

</div>
<script src="assets/js/forms.js"></script>