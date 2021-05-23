function imageInput(){
    const imageWrapper = document.querySelector(".user-image__wrapper");
    const image = document.querySelector(".user-image__image");
    const imageInput = document.querySelector(".user-image__input");
    const imagePreviewIcon = document.querySelector(".wrapper__image-preview--default");

    if (imageInput)
        imageInput.addEventListener("change", function (e) {
            const imageFile = this.files[0];

            if(imageFile) {
                const reader = new FileReader();

                reader.addEventListener("load", function (e) {
                    image.setAttribute('src', this.result);
                    image.classList.add(".user-image__image--preview")
                    image.style.display = "block";
                    imagePreviewIcon.style.display = "none"
                        
                });

                reader.readAsDataURL(imageFile);
            } else {
                image.style.display = null;
                imagePreviewIcon.style.display = null;
            }
        });
}

function fixPlaceholder(){
    const inputs = document.querySelectorAll(".labeled-input");
    for (var i = 0; i < inputs.length; i++)
    {
        input = inputs[i].querySelector("input");
        if(input) {
            if ((input.value.length > 0 && input.value != ""))
            {
                const label = input.parentElement.querySelector("label");
                if(label)
                    label.style.marginTop = '2px';
            }
            input.addEventListener("focusin", function (e) {
                const label = e.target.parentElement.querySelector("label");
                if(label)
                    label.style.marginTop = '2px';
            });
            input.addEventListener("focusout", function (e) {
                if(e.target.value.length == 0 && !(e.target.type == 'date'))
                {
                    const label = e.target.parentElement.querySelector("label");
                    if(label)
                        label.style.marginTop = 'calc(2px + 12px + 12px + 2px + 2px + 12px)';
                }
            });
            input.addEventListener("change", function (e) {
                if ((e.target.value.length > 0 && e.target.value) != "" || e.target.type == 'date')
                {
                    const label = e.target.parentElement.querySelector("label");
                    if(label)
                        label.style.marginTop = '2px';
                }
                else
                {
                    const label = e.target.parentElement.querySelector("label");
                    if(label)
                        label.style.marginTop = 'calc(2px + 12px + 12px + 2px + 2px + 12px)';
                }
            });
        }            
        input = inputs[i].querySelector("select");
        if(input) {
            if ((input.value.length > 0 && input.value != ""))
            {
                const label = input.parentElement.querySelector("label");
                if(label)
                    label.style.marginTop = '2px';
            }
            input.addEventListener("focusin", function (e) {
                const label = e.target.parentElement.querySelector("label");
                if(label)
                    label.style.marginTop = '2px';
            });
            input.addEventListener("focusout", function (e) {
                if(e.target.value.length == 0 && !(e.target.type == 'date'))
                {
                    const label = e.target.parentElement.querySelector("label");
                    if(label)
                        label.style.marginTop = 'calc(2px + 12px + 12px + 2px + 2px + 12px)';
                }
            });
            input.addEventListener("change", function (e) {
                if ((e.target.value.length > 0 && e.target.value) != "")
                {
                    const label = e.target.parentElement.querySelector("label");
                    if(label)
                        label.style.marginTop = '2px';
                }
                else
                {
                    const label = e.target.parentElement.querySelector("label");
                    if(label)
                        label.style.marginTop = 'calc(2px + 12px + 12px + 2px + 2px + 12px)';
                }
            });
        }
    }
}

function togglePriceFieldLock() {
    const priceField = document.querySelector("#price");
    const paymentMethodField = document.querySelector("#payment-method");
    if (paymentMethodField.value == '3') {
        priceField.removeAttribute("required");
        priceField.setAttribute("disabled", "true");
    } else {
        priceField.removeAttribute("disabled");
        priceField.setAttribute("required", "true");
    }
}

function prettyPrintPhone(phone) {
    phone = phone.replaceAll(/[^0-9]/g, '');
    if(phone.length > 14)
        phone = phone.substring(phone.length - 14, phone.length);
    if(phone.length == 9 || phone.length == 11 || phone.length == 14)
    {
        phone = phone.substring(0, phone.length - 4) + "-" + phone.substring(phone.length - 4);
        phone = phone.substring(0, phone.length - 10) + ") " + phone.substring(phone.length - 10, phone.length);        
        if(phone.length > 13)
            phone = phone.substring(0, phone.length - 14) + "(" + phone.substring(phone.length - 14, phone.length);
    }
    else {
        if(phone.length > 4)
            phone = phone.substring(0, phone.length - 4) + "-" + phone.substring(phone.length - 4);
        if(phone.length > 9)
            phone = phone.substring(0, phone.length - 9) + ") " + phone.substring(phone.length - 9, phone.length);        
        if(phone.length >= 13)
            phone = phone.substring(0, phone.length - 13) + "(" + phone.substring(phone.length - 13, phone.length);
    }
    return phone;
}

function prettyPrintPrice(price) {
    price = price.replaceAll(/[^0-9]/g, '');
    if(price.length > 2)
        price = price.substring(0, price.length - 2) + "," + price.substring(price.length - 2, price.length);
    if(price.length > 0)
    price = "R$ "+ price;
    return price;
}

function prettyPrintTime(time) {
    time = time.replaceAll(/[^0-9]/g, '');
    if(time.length > 2)  
        time = time.substring(0, time.length - 2) + ":" + time.substring(time.length - 2, time.length);
    return time;
}

function setModalValue(val) {
    modal = document.querySelector('.modal');
    modal.action = val;
    modal.parentElement.style.display = "flex";
}

function closeModal() {
    modalOverlay = document.querySelector(".modal-bg");
    modalOverlay.style.display = "none";
}

let phoneField = document.querySelector("#phone");
if(phoneField)
    phoneField.value = prettyPrintPhone(phoneField.value);
if(phoneField)
    phoneField.addEventListener("input", function (e) {
        e.target.value = prettyPrintPhone(e.target.value);
    });

let priceField = document.querySelector("#price");
if(priceField)
    priceField.value = prettyPrintPrice(priceField.value);
if(priceField)
    priceField.addEventListener("input", function (e) {
        e.target.value = prettyPrintPrice(e.target.value);
    });

let timeField = document.querySelector("#estimated-time");
if(timeField)
timeField.value = prettyPrintTime(timeField.value);
if(timeField)
timeField.addEventListener("input", function (e) {
        e.target.value = prettyPrintTime(e.target.value);
    });

imageInput();
fixPlaceholder();

function openClientsModal() {
    modal = document.querySelector('.modal');
    modal.parentElement.style.display = "flex";
}

function closeClientsModal() {
    modalOverlay = document.querySelector(".modal-bg");
    modalOverlay.style.display = "none";
}