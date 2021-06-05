<html>
     <head>
    <div class="load"></div>
    <link rel="apple-touch-icon" sizes="57x57" href="../config/ico/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../config/ico/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../config/ico/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../config/ico/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../config/ico/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../config/ico/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../config/ico/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../config/ico/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../config/ico/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="../config/ico/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../config/ico/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../config/ico/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../config/ico/favicon-16x16.png">
    <link rel="manifest" href="../config/ico//manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../config/ico/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesando reserva</title>
    <LINK REL=StyleSheet HREF="./Botones_estilo.css" TYPE="text/css" MEDIA=screen>
    <head
</html>
<?php
require_once './Bd_habitacion.php';
require_once '../Registro/Correo_registro.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['fecha_llegada']) && isset($_POST['fecha_salida']) && isset($_POST['tipo'])) {
        $fecha_entrada = $_POST['fecha_llegada'];
        $fecha_salida = $_POST['fecha_salida'];
        $tipo = $_POST['tipo'];
        $numero_habitaciones = contar_habitaciones($tipo);
        $numero_reservas = contar_reservas($tipo);
        $fecha_entrada = strtr($fecha_entrada, '/', '-');
        $fecha_salida = strtr($fecha_salida, '/', '-');
        $fecha_entrada_amd = date("Y-m-d", strtotime($fecha_entrada));
        $fecha_salida_amd = date("Y-m-d", strtotime($fecha_salida));
        if ($numero_habitaciones > $numero_reservas) {
            $id_habitaciones_reservadas = devolver_id_habitaciones_reservadas();
            $id_reservadas;
            for ($index1 = 0; $index1 < count($id_habitaciones_reservadas); $index1++) {
                $id_reservadas[] = $id_habitaciones_reservadas[$index1][0];
            }
            $id_habitaciones = devolver_id_habitaciones();
            $id_no_valido = true;

            for ($index = 0; $index < count($id_habitaciones) && $id_no_valido; $index++) {
                if(empty($id_reservadas)){
                    crear_reserva($tipo, $fecha_entrada_amd, $fecha_salida_amd, $id_habitaciones[$index][0]);
                      enviar_correo_reserva( $_SESSION['email'],$_SESSION['usuario']);
                    $id_no_valido = false;
                     echo '   <div class="wrapper green">
  <div class="header__wrapper">
    <div class="header">
      <div class="sign"><span></span></div>
    </div>
  </div>
  <h1>Exito</h1>
  <p>Habitación reservada</p>'
?>
  <button onclick="location = '../Reservas/Reservas_habitaciones.php'">Ver mas habitaciones </button>
  <?php
  echo '
</div>';
                }else{
                if (!(in_array($id_habitaciones[$index][0], $id_reservadas))) {


                    crear_reserva($tipo, $fecha_entrada_amd, $fecha_salida_amd, $id_habitaciones[$index][0]);
                      enviar_correo_reserva( $_SESSION['email'],$_SESSION['usuario']);
                    $id_no_valido = false;
                    echo '   <div class="wrapper green">
  <div class="header__wrapper">
    <div class="header">
      <div class="sign"><span></span></div>
    </div>
  </div>
  <h1>Exito</h1>
  <p>Habitación reservada</p>'
?>
  <button onclick="location = '../Reservas/Reservas_habitaciones.php'">Ver mas habitaciones </button>
  <?php
  echo '
</div>';
                }
                }
            }
            
        } else {
           
             $id_reservables= consultar_id_reservas($fecha_salida_amd, $fecha_entrada_amd);
             if(!(empty($id_reservables)) && $id_reservables[0][1]==$tipo){
                 echo $id_reservables[0][1],$id_reservables[0][0];
                    crear_reserva($tipo, $fecha_entrada_amd, $fecha_salida_amd,$id_reservables[0][0]);
                    enviar_correo_reserva( $_SESSION['email'],$_SESSION['usuario']);
                    echo '   <div class="wrapper green">
  <div class="header__wrapper">
    <div class="header">
      <div class="sign"><span></span></div>
    </div>
  </div>
  <h1>Exito</h1>
  <p>Habitación reservada</p>'
?>
  <button onclick="location = '../Reservas/Reservas_habitaciones.php'">Ver mas habitaciones </button>
  <?php
  echo '
</div>';
                }else{
                   
                          echo '<div class="wrapper red">
  <div class="header__wrapper">
    <div class="header">
      <div class="sign"><span></span></div>
    </div>
  </div>
  <h1>Opps</h1>
  <p>Lo sentimos pero no tenemos  habitaciones de tipo '. $tipo.' disponibles en este periodo</p>
  '?>
  <button onclick="location = '../Reservas/Reservas_habitaciones.php'">Ver otras habitaciones </button>
  <?php
  echo '
</div>';
                    }
                }
            }

          
        }
    





