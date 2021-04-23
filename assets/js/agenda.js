window.onload = e => {
    var Calendar = new Date();
    const year = Calendar.getYear() + 1900;
    const month = Calendar.getMonth();    
    const calendarPrev = document.querySelector(".month__change-month--prev");
    const calendarNext = document.querySelector(".month__change-month--next");

    toggleDisplayMode();
    generateCalendar(month, year);
    calendarNext.addEventListener("click", e => nextMonth());
    calendarPrev.addEventListener("click", e => prevMonth());
}

const MONTH_NAMES = [
    "Janeiro",
    "Fevereiro",
    "Março",
    "Abril",
    "Maio",
    "Junho",
    "Julho",
    "Agosto",
    "Setembro",
    "Outubro",
    "Novembro",
    "Dezembro"
]

function toggleDisplayMode() {
    const toggleDailyBtn = document.getElementById("daily-schedule");
    const toggleMonthlyBtn = document.getElementById("monthly-schedule");
    const toggleSchedule = document.querySelectorAll(".toggle-schedule-btn");
    const dayContent = document.querySelector(".schedule--day");
    const monthContent = document.querySelector(".schedule--month");

    toggleSchedule.forEach (toggleBtn => {
        toggleBtn.addEventListener("click", e => {
            if (toggleBtn.id == "daily-schedule") {
                toggleDailyBtn.classList.add("toggle-schedule-btn--select");
                toggleMonthlyBtn.classList.remove("toggle-schedule-btn--select");
                dayContent.style.display = "block";
                monthContent.style.display = "none";
            } else if (toggleBtn.id == "monthly-schedule") {
                toggleMonthlyBtn.classList.add("toggle-schedule-btn--select");
                toggleDailyBtn.classList.remove("toggle-schedule-btn--select");
                monthContent.style.display = "block";
                dayContent.style.display = "none";
            }
        });
    });
}

function generateCalendar (month, year) {
    var Calendar = new Date(year, month, 1);
    const calendarYear = document.querySelector(".info__year");
    const calendarMonth = document.querySelector(".info__month span");

    calendarMonth.innerHTML = MONTH_NAMES[month];
    calendarYear.innerHTML = year;

    const htmlCalendar = document.querySelector(".calendar__days");
    htmlCalendar.innerText = "";
    while (Calendar.getMonth() == month) {
        const daysRow = document.createElement("div");
        daysRow.classList.add("days__row");
        for (let i = 0; i < 7; i++) {
            const dayDiv = document.createElement("div");
            dayDiv.classList.add("row__day");
            const span = document.createElement("span");
            span.innerHTML = "";
            dayDiv.appendChild(span);
            daysRow.appendChild(dayDiv);
            if (i == Calendar.getDay() && Calendar.getMonth() == month){
                dayDiv.classList.add("row__day--white-background");
                span.innerHTML = Calendar.getDate();
                if (Calendar.getDay() == 6 || Calendar.getDay() == 0){
                    dayDiv.classList.add("row__day--purple-background");   
                }
                Calendar.setDate(Calendar.getDate() + 1);
            }
        }
        htmlCalendar.appendChild(daysRow);
    }
}

function prevMonth() {
    var month = MONTH_NAMES.indexOf(document.querySelector(".info__month span").innerHTML);
    var year = document.querySelector(".info__year").innerHTML;
    
    month--;
    if (month < 0) {
        year--;
        month = 11;
    }
    generateCalendar(month, year);
}

function nextMonth() {
    var month = MONTH_NAMES.indexOf(document.querySelector(".info__month span").innerHTML);
    var year = document.querySelector(".info__year").innerHTML;
    
    month++;
    if (month > 11) {
        year++;
        month = 0;
    }
    generateCalendar(month, year);
}
