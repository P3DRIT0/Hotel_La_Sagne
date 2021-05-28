const date = new Date();
var contadorclicks = 0;
var elemento1;
var elemento2;

const renderCalendar = () => {
    date.setDate(1);
    //array días
    const monthDays = document.querySelector(".days");

    //ultimo dia del mes actual
    const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();

    //ultimo dia del mes anterior
    const prevLastDay = new Date(date.getFullYear(), date.getMonth(), 0).getDate();

    //variable primer día del mes (que dia de la semana)
    const firstDayIndex = date.getDay() - 1;
    //ultimo dia siguiente mes
    const lastDayIndex = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDay();
    //
    const nextDays = 7 - lastDayIndex;
    //array meses
    const months = [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre",
    ];
    //cambio el valor del h1 al mes donde estamos
    document.querySelector('.date h1').innerHTML = months[date.getMonth()];
    var monthword1 = document.querySelector('.date h1').innerHTML;
    var days = "";
    //bucle para que el mes empiece el dia correcto de la semana

    for (let x = firstDayIndex; x > 0; x--) {
        days += `<div class="prev-date">${prevLastDay - x + 1}</div>`;
    }
    //bucle para coger dias del 1 al 30 o 31 (variable lastDay) y marcar el dia actual
    for (var i = 1; i <= lastDay; i++) {
        if (
                i === new Date().getDate() &&
                date.getMonth() === new Date().getMonth()
                ) {
            days += `<div id="${i + monthword1}" class="today" onclick="dayselected()">${i}</div>`;

        } else {
            days += `<div id="${i + monthword1}" onclick="dayselected()">${i}</div>`;

        }
    }
    //

    //
    for (var j = 1; j <= nextDays; j++) {
        days += `<div id="${j + months[date.getMonth() + 1]} class="next-date">${j}</div>`;
        monthDays.innerHTML = days;
    }

};
//mes anterior
document.querySelector(".prev").addEventListener("click", () => {

    date.setMonth(date.getMonth() - 1);
    renderCalendar();
    colorear();
});
//mes siguiente
document.querySelector(".next").addEventListener("click", () => {

    date.setMonth(date.getMonth() + 1);
    renderCalendar();
    colorear();
});

renderCalendar();


function dayselected() {
    var months = [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre",
    ];

    var day = parseInt(event.srcElement.id);
    console.log(elemento1);
    console.log(elemento2);
    var monthword = document.querySelector('.date h1').innerHTML;
    var month = months.indexOf(monthword);
    month = month + 1;
    var year = date.getFullYear();
    var dateenter = day + "-" + month + "-" + year;
    if (contadorclicks == 0) {
        document.getElementById('checkin').value = dateenter;
        document.getElementById(event.srcElement.id).style.backgroundColor = "lightblue";
        document.getElementById(event.srcElement.id).style.color = "black";
        elemento1 = event.srcElement.id;
    }
    if (contadorclicks == 1) {
        document.getElementById('checkout').value = dateenter;
        document.getElementById(event.srcElement.id).style.backgroundColor = "lightblue";
        document.getElementById(event.srcElement.id).style.color = "black";
        elemento2 = event.srcElement.id;
        colorearintervalo();
    }
    if (contadorclicks == 2) {
        document.getElementById(elemento1).style.backgroundColor = "";
        document.getElementById(elemento1).style.color = "white";
        document.getElementById(elemento2).style.backgroundColor = "";
        document.getElementById(elemento2).style.color = "white";
        contadorclicks = -1;

    }
    contadorclicks++;
}
var contador
function colorearintervalo() {
    console.log(elemento1);
    console.log(elemento2);
    for (var i = elemento1; i < elemento2; i++) {
        console.log(contador);
        contador++;
    }
}

function colorear() {
    console.log(elemento1,elemento2);
    document.getElementById(elemento1).style.backgroundColor = "lightblue";
    document.getElementById(elemento1).style.color = "black";
    document.getElementById(elemento2).style.backgroundColor = "lightblue";
    document.getElementById(elemento2).style.color = "black";
}
