function addProfessional(professional) {
    const select = document.getElementById('professionals');
    const selected = select.options[select.selectedIndex];
    const pastSelected = document.querySelector("#professionalSelected-"+selected.value);
    let selectedProfessionalsDiv = document.querySelector('.selected-professionals');

    if(selected.value == ""){
        alert("Selecione um profissional")
        return;
    }
    if (pastSelected != undefined) {
        alert("Profissional já selecionado")
        return;
    }
    
    const newProfessional = createProfessionalItem(selected);
    selectedProfessionalsDiv.appendChild(newProfessional);
}

function createProfessionalItem(selected) {
    let span = document.createElement('span');
    span.id = 'professional-' + selected.value;
    span.classList.add('labeled-input');
    span.classList.add('professional-'+selected.value);

    let input = document.createElement('input');
    input.style.pointerEvents = "none";
    input.value = selected.innerHTML;
    input.id = "professionalSelected-" + selected.value;
    input.name = "professionalSelected-" + selected.value;
    span.appendChild(input);

    let btn = document.createElement('span');   
    btn.classList.add('sqr-btn');
    btn.classList.add('sqr-btn--red');
    btn.innerHTML = "X";
    btn.setAttribute("onclick", "removeProfessional('" + selected.value + "')");
    span.appendChild(btn);
    return span;
}


function addAllProfessionals() {
    const select = document.getElementById('professionals');
    let selectedProfessionalsDiv = document.querySelector('.selected-professionals');

    for (let i = 1; i < select.options.length; i++) {
        const selected = select.options[i];
        const newProfessional = createProfessionalItem(selected);
        const pastSelected = document.querySelector("#professionalSelected-"+selected.value);
        if (pastSelected == undefined)
            selectedProfessionalsDiv.appendChild(newProfessional);
    }
}

function removeProfessional(id) {
    let professional = document.querySelector('#professionalSelected-' + id);
    let professionalLabel = document.querySelector('#professional-' + id);
    professionalLabel.parentElement.removeChild(professionalLabel);
}