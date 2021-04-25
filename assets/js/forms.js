function imageInput(){
    const imageWrapper = document.querySelector(".user-image__wrapper");
    const image = document.querySelector(".user-image__image");
    const imageInput = document.querySelector(".user-image__input");
    const imagePreviewIcon = document.querySelector(".wrapper__image-preview--default");

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
            input.addEventListener("change", function (e) {
                if (e.target.value.length > 0 && e.target.value != "")
                    e.target.parentElement.querySelector("label").style.marginTop = '2px';
                else
                    e.target.parentElement.querySelector("label").style.marginTop = 'calc(2px + 12px + 12px + 2px + 2px + 12px)';
            });
        }            
        input = inputs[i].querySelector("select");
        if(input) {
            input.addEventListener("change", function (e) {
                if (e.target.value)
                    e.target.parentElement.querySelector("label").style.marginTop = '2px';
                else
                    e.target.parentElement.querySelector("label").style.marginTop = 'calc(2px + 12px + 12px + 2px + 2px + 12px)';
            });
            
        }
    }
}

imageInput();
fixPlaceholder();