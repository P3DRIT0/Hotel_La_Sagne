<?php

function registrar_usuario($nombre, $contraseña, $correo, $telefono, $direccion, $rol = 1) {
    try {
        $base = new PDO('mysql:host=localhost; dbname=hotel', 'administrador', '1234');
        $sentencia = $base->prepare("INSERT INTO `usuarios`(`nombre`,`email`,`telf`,`direccion`,`password`,`rol_usuario`) VALUES (:nombre,:email,:telf,:direccion,:password,:rol)");
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':email', $correo);
        $sentencia->bindParam(':telf', $telefono);
        $sentencia->bindParam(':direccion', $direccion);
        $sentencia->bindParam(':password', $contraseña);
        $sentencia->bindParam(':rol', $rol);

        if (!$sentencia->bindParam(':nombre', $nombre)) {
            echo "Falló la vinculación de parámetros";
        }
        if (!$sentencia->bindParam(':email', $correo)) {
            echo "Falló la vinculación de parámetros";
        }
        if (!$sentencia->bindParam(':telf', $telefono)) {
            echo "Falló la vinculación de parámetros";
        }
        if (!$sentencia->bindParam(':direccion', $direccion)) {
            echo "Falló la vinculación de parámetros";
        }
        if (!$sentencia->bindParam(':password', $contraseña)) {
            echo "Falló la vinculación de parámetros";
        }
        if (!$sentencia->bindParam(':rol', $rol)) {
            echo "Falló la vinculación de parámetros";
        }


        $sentencia->execute();

        $sentencia = null;
        $base = null;
    } catch (PDOException $e) {
        die('No se pudo conectar: ' . mysql_error());
    }
}
