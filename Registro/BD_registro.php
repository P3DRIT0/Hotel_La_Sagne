<?php

include '../config/conexiones_BD.php';

/**
 * Método que recibe por cabecera los datos de un usuario nuevo para insertarlos 
 * en la base de datos
 * 
 * @param string $nombre Nombre
 * @param string $contraseña Contraseña
 * @param string $correo Correo electrónico
 * @param string $telefono Telefono
 * @param string $direccion Direción
 * @param int $rol Rol del usuario que por defecto entra como 1 (usuario básico)
 */
function registrar_usuario($nombre, $contraseña, $correo, $telefono, $direccion, $rol,$foto_perfil) {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("INSERT INTO usuarios(nombre,email,telf,direccion,password,rol_usuario,imagen_usuario) VALUES (:nombre,:email,:telf,:direccion,:password,:rol_usuario,:img)");
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':email', $correo);
        $sentencia->bindParam(':telf', $telefono);
        $sentencia->bindParam(':direccion', $direccion);
        $sentencia->bindParam(':password', $contraseña);
        $sentencia->bindParam(':rol_usuario', $rol);
         $sentencia->bindParam(':img', $foto_perfil);
        $sentencia->execute();
//        print_r($base->errorInfo());

        $sentencia = null;
        $base = null;
    } catch (PDOException $e) {
        die('No se pudo conectar: ' . mysql_error());
    }
    echo "consulta registrada con exito ";
}
function id_usuario($email){
      try {
        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT id FROM usuarios where email=:email");
        $sentencia->bindParam(':email', $email);
        $sentencia->execute();
        $result = $sentencia->fetchAll();
        return $result;
        $sentencia=null;
        $base=null;
} catch (PDOException $e) {
        die('No se pudo conectar: ' . mysql_error());
    }
}