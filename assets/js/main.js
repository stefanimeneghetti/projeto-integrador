function openSidebarDropdowns() {
    const navList = document.querySelectorAll(".nav-list__item");
    const dropdownList = document.querySelectorAll(".item__dropdown");
    
    for (let i = 0; i < navList.length; i++) {
        navList[i].addEventListener("click", e => {
            dropdownList[i].classList.toggle("item__dropdown--open");
            if (dropdownList[i].classList.contains("item__dropdown--open")){
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
    sidebarBtn.addEventListener("click", e => {
        const sidebar = document.querySelector(".sidebar");
        sidebar.classList.toggle("sidebar--open");
    })
}

openSidebar();
openSidebarDropdowns();
