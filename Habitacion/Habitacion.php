
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

      <!-- Bootstrap CSS -->
      <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
        crossorigin="anonymous"
      />
      <link href="Cartera.css" rel="stylesheet" type="text/css" />
      <link href="Calendario.css" rel="stylesheet" type="text/css" />
      <!--Fuentes -->
      
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
echo "<div class='imagen'>";
echo "<img class='imagen_cabecera'  src='$rutaimagen'>";
echo "</div>";
echo "<div class='contenido'> ";
echo " <div class='descripcion'>";
echo "<h1>$tipo</h1>";
echo "<p class='texto de la descripcion '>";
echo "$descripcion";
echo "</p>";
echo " </div>";
echo "<form action='./Solicitud_reserva.php' method='post'>";
echo "<div class='footer_calendar_final_reserver'>";
echo "<div class='container'>";
echo "<div class='calendar_dayin_dayout'>";
echo "Día de llegada:";
echo "<input type='date' id='start' name='trip-start' value='2021-02-22' min='2021-01-01' max='2021-12-31'>";
echo " Día de salida:";
echo "<input type='date' id='end' name='trip-end' value='2021-03-03' min='2021-01-01' max='2021-12-31'>";
echo "<input type='text'  name='tipo' style='visibility: hidden' value='$tipo'> ";
}

?>
     
     
     
        
      
        
     
      
      
          
        
          
           
            
           
            
        
          </div>
          <div id="calendar"></div>
      </div>
        <div class="buttons_reservation" style="margin-top: 2%;margin: 2%;">
          <button type="submit" class="button btn-primary">
            Hacer reserva
          </button>
          <button type="reset" class="button">Cancel</button>
        </div>
      </div>
      </form>
    </div>


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
