<div class="page-content">
    <div class="centralized">
        <form method="post">
            <div class="labeled-input">
                <input id="name" name="name" class="no-left-offset" type="text" size=45>
                <label for="name">
                    Nome do cliente
                </label>
            </div>

            <div style="text-align: center;">
                <input type="submit" class="btn btn--purple" value="Buscar">
                <input type="submit" class="btn btn--purple left-offset" value="Listar todos">
            </div>
        </form>

        <div class="clients-list full-width">
            <table>
                <tbody>
                    <tr>
                        <td class="clients-list__name">Juquinha</td>
                        <td class="clients-list__phone">(49) 3132-4123</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="clients-list__name">Zezinho</td>
                        <td class="clients-list__phone">(49) 98293-4123</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>
<script src="assets/js/forms.js"></script>