function openSidebarDropdowns() {
    const navList = document.querySelectorAll(".nav-list__item--dropdown");
    for (let i = 0; i < navList.length; i++) {
        navList[i].addEventListener("click", e => {
            navList[i].children[0].classList.toggle("item__dropdown--open");
            if (navList[i].children[0].contains("item__dropdown--open")){
                dropdownList[i].style.height = "fit-content";
                dropdownList[i].style.paddingTop = "12px";
                dropdownList[i].style.paddingBottom = "12px";
            } else {
                dropdownList[i].style.height = "0px";
                dropdownList[i].style.paddingTop = "0px";
                dropdownList[i].style.paddingBottom = "0px";
            }
        });
    }
}

function openSidebar() {
    const sidebarBtn = document.querySelector(".sidebar-toggle");
    if (sidebarBtn)
        sidebarBtn.addEventListener("click", e => {
            const sidebar = document.querySelector(".sidebar");
            sidebar.classList.toggle("sidebar--open");
        })
}

function showListItemDetails() {
    const listItem = document.querySelectorAll(".list__list-item");
    const listItemBtn = document.querySelectorAll(".list-item__show-details");
    
    for (let i = 0; i < listItem.length; i++) {
        listItemBtn[i].addEventListener("click", e => {
            listItem[i].classList.toggle("list__list-item--open");
        });
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

openSidebar();
openSidebarDropdowns();
showListItemDetails();
