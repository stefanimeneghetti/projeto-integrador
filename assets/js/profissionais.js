function addService(service) {
    const select = document.getElementById('services');
    const selected = select.options[select.selectedIndex];
    const pastSelected = document.querySelector("#serviceSelected-"+selected.value);
    let selectedServicesDiv = document.querySelector('.selected-services');

    if(selected.value == ""){
        alert("Selecione um serviço")
        return;
    }
    if (pastSelected != undefined) {
        alert("Serviço já selecionado")
        return;
    }
    
    const newService = createServiceItem(selected);
    selectedServicesDiv.appendChild(newService);
}

function createServiceItem(selected) {
    let span = document.createElement('span');
    span.id = 'service-' + selected.value;
    span.classList.add('labeled-input');
    span.classList.add('service-'+selected.value);

    let input = document.createElement('input');
    input.style.pointerEvents = "none";
    input.value = selected.innerHTML;
    input.id = "serviceSelected-" + selected.value;
    input.name = "serviceSelected-" + selected.value;
    span.appendChild(input);

    let btn = document.createElement('span');   
    btn.classList.add('sqr-btn');
    btn.classList.add('sqr-btn--red');
    btn.innerHTML = "X";
    btn.setAttribute("onclick", "removeService('" + selected.value + "')");
    span.appendChild(btn);
    return span;
}


function addAllServices() {
    const select = document.getElementById('services');
    let selectedServicesDiv = document.querySelector('.selected-services');

    for (let i = 1; i < select.options.length; i++) {
        const selected = select.options[i];
        const newService = createServiceItem(selected);
        selectedServicesDiv.appendChild(newService);
    }
}

function removeService(id) {
    let service = document.querySelector('#serviceSelected-' + id);
    let serviceLabel = document.querySelector('#service-' + id);
    serviceLabel.parentElement.removeChild(serviceLabel);
}