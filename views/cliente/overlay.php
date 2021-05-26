
<div class="modal-bg">
    <div class="modal">
        <div class="modal-close" onclick="closeClientsModal()">X</div>
        <div class="page-content">
            <div class="centralized" style="display: block">
                    <div class="labeled-input">
                        <input id="client-search-field" name="client-search-field" class="no-left-offset" type="text" size=45>
                        <label for="client-search-field">
                            Nome do cliente
                        </label>
                    </div>

                    <div style="text-align: center;">
                        <input type="button" class="btn btn--purple" value="Buscar" onclick="searchByName(true)">
                        <input type="button" class="btn btn--purple left-offset" value="Listar todos" onclick="searchByName(false)">
                    </div>
                <div class="clients-list" style="display:none">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var clientes = [];
    <?php
    $db = new ClienteDAO();
    $clientes = $db->all();
    foreach($clientes as $c){
        ?>clientes.push(<?php echo (json_encode($c->getObjectVars()) . ");");
    }?>
</script>