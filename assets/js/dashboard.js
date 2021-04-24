var calItemOnFocus = 'calendar__card-3'; // item from the calendar card on focus
var atcItemOnFocus = 'appointment__card-2'; // item from the appointments to confirm card on focus
var ptcOnFocus = 'payment__card-2'; // item from the pending payments card on focus
switchFocus(calItemOnFocus);
switchFocus(atcItemOnFocus);
switchFocus(ptcOnFocus);

function switchFocus(id) {
    if (id.startsWith('c'))
    {
        document.getElementById(calItemOnFocus).querySelector(".component__card--expanded").style.display = 'none';
        document.getElementById(calItemOnFocus).querySelector(".component__card--collapsed").style.display = 'flex';
        calItemOnFocus = id;
    } else if (id.startsWith('a'))
    {
        document.getElementById(atcItemOnFocus).querySelector(".component__card--expanded").style.display = 'none';
        document.getElementById(atcItemOnFocus).querySelector(".component__card--collapsed").style.display = 'flex';
        atcItemOnFocus = id;
    } else
    {
        document.getElementById(ptcOnFocus).querySelector(".component__card--expanded").style.display = 'none';
        document.getElementById(ptcOnFocus).querySelector(".component__card--collapsed").style.display = 'flex';
        ptcOnFocus = id;
    }

    document.getElementById(id).querySelector(".component__card--expanded").style.display = 'flex';
    document.getElementById(id).querySelector(".component__card--collapsed").style.display = 'none';
    
}