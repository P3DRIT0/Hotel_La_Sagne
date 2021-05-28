const date = new Date();
var contadorclicks = 0;
var elemento1;
var elemento2;
var lastday;
const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
var intervalo=[];
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
    const nextDays =  7 - lastDayIndex ;
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

    var days = "";
    //bucle para que el mes empiece el dia correcto de la semana

    //cambio el valor del h1 al mes donde estamos
    document.querySelector('.date h1').innerHTML = months[date.getMonth()];
    var monthword1 = document.querySelector('.date h1').innerHTML;
    var days = "";
    //bucle para que el mes empiece el dia correcto de la semana

    for (let x = firstDayIndex; x > 0; x--) {
        days += `<div  id="${(prevLastDay - x + 1)+months[date.getMonth()-1]}" class="prev-date">${prevLastDay - x + 1}</div>`;
    }
    //bucle para coger dias del 1 al 30 o 31 (variable lastDay) y marcar el dia actual
    var activado=false;
    const fecha = new Date();
    const hoy = fecha.getDate();
    const mesActual = months[fecha.getMonth()];
    var mes=document.querySelector('.date h1').innerHTML;
    for (var i = 1; i <= lastDay; i++) {
        if(!(mesActual==mes)){
            activado=true;
        }
        if(months.indexOf(mes)<fecha.getMonth()){
            console.log("entra");
            activado=false;
        }
        if (
                i === new Date().getDate() &&
                date.getMonth() === new Date().getMonth()
                ) {
            days += `<div id="${i + monthword1}" class="today" onclick="dayselected()">${i}</div>`;
            activado=true;
        } else {
            if(activado){
            days += `<div id="${i + monthword1}" onclick="dayselected()">${i}</div>`;
        }else{
             days += `<div id="${i + monthword1}">${i}</div>`;
        }

        }
    }
    //

    //
    for (var j = 1; j <= nextDays; j++) {
        days += `<div id="${j + months[date.getMonth() + 1]}" class="next-date" >${j}</div>`;
        monthDays.innerHTML = days;
    }

};
//mes anterior
document.querySelector(".prev").addEventListener("click", () => {

    date.setMonth(date.getMonth() - 1);
    renderCalendar();
    
    if(contadorclicks==0){
        elemento1 = "";
        elemento2 = "";
        borrarintervalo();
    }
    colorear();
});
//mes siguiente
document.querySelector(".next").addEventListener("click", () => {
    date.setMonth(date.getMonth() + 1);
    renderCalendar();
     if(contadorclicks==0){
        elemento1 = "";
        elemento2 = "";
        borrarintervalo();
    }
    colorear();
});

renderCalendar();


function dayselected() {
    

    var day = parseInt(event.srcElement.id);
    var monthword = document.querySelector('.date h1').innerHTML;
    var month = months.indexOf(monthword);
    month = month + 1;
    var year = date.getFullYear();
    var dateenter = day + "/" + month + "/" + year;
    
    if (contadorclicks == 0) {
        document.getElementById("checkin").value="";
        document.getElementById("checkout").value="";
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
        verrango();
        colorearinervalo();
    }
    if (contadorclicks == 2) {
        try {
            document.getElementById(elemento1).style.backgroundColor = "";
            document.getElementById(elemento1).style.color = "white";
        } catch (e) {
           
        }
        try {
            document.getElementById(elemento2).style.backgroundColor = "";
            document.getElementById(elemento2).style.color = "white";
        } catch (e) {
            
        }
        contadorclicks = -1;
        borrarintervalo();
    }
    contadorclicks++;
}
function verrango() {
 var f1=document.getElementById("checkin").value;
 var f2=document.getElementById("checkout").value;
 var aFecha1 = f1.split('/');
 var aFecha2 = f2.split('/');
 var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]);
 var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]);
 var dif = fFecha2 - fFecha1;
 var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
  var numinicio= parseInt(elemento1)+1;
var contador= parseInt(aFecha1[1]-1);
var monthword1 = months[contador];


    for (var i = 0; i <dias; i++) {
      if(numinicio>lastDay){
          contador++;
         monthword1 = months[contador];
          numinicio=1; 
          
      }
      var diasrango= (numinicio+ monthword1);
        intervalo[i]=diasrango;
      numinicio++;
    }
    
}

function colorear() {
    try {
        document.getElementById(elemento1).style.backgroundColor = "lightblue";
        document.getElementById(elemento1).style.color = "black";
    } catch (e) {
        //el primer parameto no se encuentra en el mes
    }
    try {
        document.getElementById(elemento2).style.backgroundColor = "lightblue";
        document.getElementById(elemento2).style.color = "black";
    } catch (e) {
        //el segundo parameto no se encuentra en el mes
    }
    verrango();
     colorearinervalo();
}
function  colorearinervalo(){
    for (var i = 0; i <intervalo.length; i++) {
        try {
        document.getElementById(intervalo[i]).style.backgroundColor= "lightblue";
        document.getElementById(intervalo[i]).style.color="black";
    } catch (e) {
        //Intenta colorear el elemento selleccionado
    }
        }
}
function borrarintervalo(){
    for (var i = 0; i <intervalo.length; i++) {
     try {
        document.getElementById(intervalo[i]).style.backgroundColor= "";
        document.getElementById(intervalo[i]).style.color="white";
    } catch (e) {
    }
        }
}
