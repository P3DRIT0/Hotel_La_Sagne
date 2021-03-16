<?php
require_once './Bd_habitacion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if(isset($_POST['trip-start']) && isset($_POST['trip-end'])&& isset($_POST['tipo'])&& isset($_POST['id_habitacion'])){
    $fecha_entrada=$_POST['trip-start'];
    $fecha_salida=$_POST['trip-end'];
    $tipo=$_POST['tipo'];
    $id_habitacion=$_POST['id_habitacion'];
    $numero_habitaciones=contar_habitaciones($tipo);
    $numero_reservas= contar_reservas($tipo);
    if($numero_habitaciones>$numero_reservas){
       if (crear_reserva($tipo, $fecha_entrada, $fecha_salida,$id_habitacion)){
          
       }
    }else{
        echo  ver_fechas($tipo, $fecha_entrada, $fecha_salida,$id_habitacion);
    }
}

}
