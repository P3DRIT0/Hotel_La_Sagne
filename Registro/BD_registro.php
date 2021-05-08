<?php
include '../config/conexiones_BD.php';
function registrar_usuario($nombre, $contraseña, $correo, $telefono, $direccion, $rol = 1) {
    try {
       $base = conectar();
        $sentencia = $base->prepare("INSERT INTO usuarios(nombre,email,telf,direccion,password,rol_usuario) VALUES (:nombre,:email,:telf,:direccion,:password,:rol_usuario)");
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':email', $correo);
        $sentencia->bindParam(':telf', $telefono);
        $sentencia->bindParam(':direccion', $direccion);
        $sentencia->bindParam(':password', $contraseña);
        $sentencia->bindParam(':rol_usuario', $rol);
        $sentencia->execute();
//        print_r($base->errorInfo());

        $sentencia = null;
        $base = null;
    } catch (PDOException $e) {
        die('No se pudo conectar: ' . mysql_error());
    }
    echo "consulta registrada con exito ";
}