
<html lang="en">
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <div class="load"></div>
      <link
        rel="shortcut icon"
        type="image/x-icon"
        href="../Multimedia/logo.png"
      />
      <!-- Required meta tags -->
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link href="pagina_habitacion.css" rel="stylesheet" type="text/css" />
      <link
        href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Montserrat&display=swap"
        rel="stylesheet"
      />

      <title>Hotel La sagne</title>
    </head>

    <body>
        
        
        
<?php
require_once './Bd_habitacion.php';
if(isset($_POST['num_habitacion'])){
$num_habitacion = $_POST['num_habitacion'];
$tipo;
switch ($num_habitacion) {
    case "tipo1":
        $tipo="Suite";
        break;
    case "tipo2":
        $tipo="Habitacion Individual";
        break;
    case "tipo3":
         $tipo="Habitacion Doble";
        break;
    default:
        $tipo="No encontrado";
}

$habitacion=obtener_habitacion($tipo);
$rutaimagen=$habitacion[1][0][2];
$descripcion=$habitacion[1][0][3];
$tipo=$habitacion[0][0][3];
$precio=$habitacion[0][0][6];



echo "
  <!--contenedor principal-->
    <div class='container'>
        <!--zona reserva-->
        <div class='reservationcalendar'>
        </div>
        <!--zona habitacion-->
        <div class='room'>
            <!--tipo de habitacion-->
            <div class='roomtype'>
                <h1>$tipo</h1>
            </div>
             <!--imagen de habitacion-->
            <div class='roomimg'>
        <img src='$rutaimagen' width='80%'>
            </div>
            <!--descripción de habitacion-->
            <div class='roominfo'>
                <p> $descripcion</p>
            </div>
            <!--precio de habitacion-->
            <div class='roomprice'>
                <p>$precio</p>
            </div>
            <!--botones-->
            <div class='buttons'>
                <input type='submit' value='Cancelar' id='cancel'>
                <input type='submit' value='Reservar online' id='select'>
            </div>
        </div>
    </div>
";
}

?>

      <!-- Optional JavaScript; choose one of the two! -->

      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"
      ></script>

      <!-- Option 2: Separate Popper and Bootstrap JS -->
      <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    --></body>
  </html>
</html>
