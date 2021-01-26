<?php

function registrar_usuario($nombre, $apellidos,$contraseña,$correo,$telefono,$direccion,$rol=1) {
    try {
        $base = new PDO('mysql:host=localhost; dbname=hotel', 'administrador', '1234');
        $sentencia = $base->prepare("INSERT INTO `usuarios`(`nombre`, `apellido` ,`email` ,`telf`,`direccion`,`password`,`rol_usuario`) VALUES (:nombre,:apellido,:email,:telf,:direccion,:password,:rol)");
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':apellido', $apellidos);
        $sentencia->bindParam(':email', $correo);
        $sentencia->bindParam(':telf', $telefono);
        $sentencia->bindParam(':direccion', $direccion);
        $sentencia->bindParam(':password', $contraseña);
        $sentencia->bindParam(':rol', $rol);
        $sentencia->execute();
        echo "Se ha registrado con exito ";
    } catch (PDOException $e) {
        echo 'Fallo la conexion:' . $e->GetMessage();
    }
}
