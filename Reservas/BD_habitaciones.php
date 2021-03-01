<?php


function crear_habitacion($m2, $ventana, $tipo_habitacion, $servicio_limpieza, $internet,$precio) {
    try {
        $base = new PDO('mysql:host=localhost; dbname=hotel', 'administrador', '1234');
        $sentencia = $base->prepare("INSERT INTO `habitaciones`(`m2`,`ventana`,`tipo_de_habitacion`,`servicio_limpieza`,`internet`,`precio`) VALUES (:m2,:ventana,:tipo_habitacion,:servicio_limpieza,:internet,:precio)");
        $sentencia->bindParam(':m2', $m2);
        $sentencia->bindParam(':ventana', $ventana);
        $sentencia->bindParam(':tipo_habitacion', $tipo_habitacion);
        $sentencia->bindParam(':servicio_limpieza', $servicio_limpieza);
        $sentencia->bindParam(':internet', $internet);
        $sentencia->bindParam(':precio', $precio);
        $sentencia->execute();
        print_r($base->errorInfo());
        $sentencia = null;
        $base = null;
    } catch (PDOException $e) {
        die('No se pudo conectar: ' . mysql_error());
    }
}
