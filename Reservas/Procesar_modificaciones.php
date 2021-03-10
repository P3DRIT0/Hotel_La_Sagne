
<?php
require_once './BD_habitaciones.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if(isset($_POST['metros']) && isset($_POST['precios'])&& isset($_POST['ventana'])&& isset($_POST['limpieza'])&& isset($_POST['internet'])&& isset($_POST['tipo_de_habitacion'])&& isset($_POST['id'])){
   $tipo_de_habitacion=$_POST['tipo_de_habitacion'];
   $id=$_POST['id'];
   $m2=$_POST['metros'];
   $precio=$_POST['precios'];
   $ventana=$_POST['ventana'];
   $limpieza=$_POST['limpieza'];
   $internet= "true"==$_POST['internet'];
modificar_habitaciones($id,$m2,$precio,$ventana,$limpieza,$internet,$tipo_de_habitacion);
}
}

