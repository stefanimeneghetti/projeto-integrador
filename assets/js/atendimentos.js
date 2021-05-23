function searchByName(shouldUseQueryField) {
    nome = shouldUseQueryField ? document.querySelector("#client-search-field").value.toLowerCase() : "";
    atendimentos = document.querySelector(".clients-list");
    atendimentos.style.display = "block";
    atendimentos.innerHTML ="";

    query = [];
    for(var i = 0; i < clientes.length; i++)
        if(clientes[i]['nome'].startsWith(nome))
            query.push(clientes[i]);
    if(query.length == 0)
        atendimentos.innerHTML = "Nenhum resultado para a pesquisa.";
            
    table = document.createElement('table');
    atendimentos.appendChild(table);
    tbody = document.createElement('tbody');
    table.appendChild(tbody);
    for(var i = 0; i < query.length - 1; i++)
    {
        trow = document.createElement('tr');
        trow.setAttribute("onclick", "selectClient('" + query[i]['id'] + "', '" + query[i]['nome'] + "', '" + query[i]['telefone'] + "');  closeClientsModal();");
        trow.style.cursor = "default";
        trow.classList.add('hover-select');
        td = document.createElement('td');
        td.classList.add('clients-list__name');
        td.innerHTML = query[i]['nome'];
        trow.appendChild(td);
        td = document.createElement('td');
        td.classList.add('clients-list__phone');
        td.innerHTML = query[i]['telefone'];
        trow.appendChild(td);
        tbody.appendChild(trow);
    }
    tfoot = document.createElement('tfoot');
    table.appendChild(tfoot);
    trow = document.createElement('tr');
    trow.setAttribute("onclick", "selectClient('" + query[query.length - 1]['id'] + "', '" + query[query.length - 1]['nome'] + "', '" + query[query.length - 1]['telefone'] + "');  closeClientsModal();");
    trow.style.cursor = "default";
    trow.classList.add('hover-select');
    td = document.createElement('td');
    td.classList.add('clients-list__name');
    td.innerHTML = query[query.length - 1]['nome'];
    trow.appendChild(td);
    td = document.createElement('td');
    td.classList.add('clients-list__phone');
    td.innerHTML = query[query.length - 1]['telefone'];
    trow.appendChild(td);
    tfoot.appendChild(trow);
}

function selectClient(id, name, phone) {
    hiddenInput = document.querySelector("#selectedClientsId");
    clientsName = document.querySelector("#name");
    clientsPhone = document.querySelector("#phone");
    hiddenInput.value = id;
    clientsName.value = name;
    clientsPhone.value = phone;
}

function updateProfessionalOptions() {
    services = document.querySelector("#services");
    // esconder os valores não selecionados
    for(var i = 0; i < qtd_profissionais_por_servico.length; i++)
    {
        unselectedServices = document.querySelectorAll(".servico-" + qtd_profissionais_por_servico[i]);
        for(var j = 0; j < unselectedServices.length; j++)
            unselectedServices[j].style.display = "none";       
    }

    // mostrar os valores selecionados
    selectedServices = document.querySelectorAll(".servico-" + services.value);

    for(var j = 0; j < selectedServices.length; j++)
        selectedServices[j].style.display = "inline";
    
        var del = "";
    for(var i = 0; i < selectedServices.length; i++)
    del += selectedServices[i];
        document.write(del);
}

function updateTimeOptions() {
    timeField = document.querySelector("#time");
    professionalField = document.querySelector("#professional");
    dateField = document.querySelector("#date");
    serviceField = document.querySelector("#services");
    if(dateField.value == "" || professionalField.value == ""|| serviceField.value == "")
        return;
    timeField.innerHTML = "";
    minuteTimeFrames = ["00", "15", "30", "45"];
    scheduledAppointments = horariosDisponiveis[professionalField.value][dateField.value];
    if(scheduledAppointments != undefined)
        scheduledAppointments.sort();
    
    for(var h = 6; h < 24; h++)
        minuteTimeFrames.forEach(minuteFrame => {

            opt = document.createElement("option");
            const timeFrame = h + ":" + minuteFrame;
            opt.innerHTML = timeFrame;
            opt.value = dateField.value + " " + opt.innerHTML;
            if(!isViableAppointment(serviceField.value, timeFrame, scheduledAppointments))
                opt.setAttribute("disabled");
            time.appendChild(opt);
        });
}

function isViableAppointment(serviceLength, timeFrame, scheduledAppointments) {
    
    if(scheduledAppointments == undefined)
        return true;
    scheduledAppointments.forEach(appt => {
        const calculatedTime = (timeFrame.split(":")[0] * 100) + timeFrame.split(":")[1] +
                               (serviceLength.split(":")[0] * 100) + serviceLength.split(":")[1];
        const calculatedTime2 = (appt.split(":")[0] * 100) + appt.split(":")[1];
        if(calculatedTime - calculatedTime2 > 0)
            // return false;
            document.write(calculatedTime - calculatedTime2);
    });
    return true;
}