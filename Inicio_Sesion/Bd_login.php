<?php

include '../config/conexiones_BD.php';

/**
 * Método que recibe un correo y comprueba si esta registrado en la base de datos
 * 
 * @param string $correo Correo electrónico
 * @return boolean Verdadero si existe el usuario con ese correo en la base de datos
 */
function comprobar_usuario($correo) {
    try {
        $usuario_registrado = false;
        $base = conectar('admin');
        $sentencia = $base->prepare('SELECT * FROM usuarios WHERE email=:correo');
        $sentencia->bindParam(':correo', $correo);
        $sentencia->execute();
        $result = $sentencia->fetch(PDO::FETCH_ASSOC);
        if (!empty($result["email"])) {
            $usuario_registrado = true;
        }
        $sentencia = null;
        $base = null;
        return $usuario_registrado;
    } catch (PDOException $e) {
        die('No se pudo conectar: ' . $e->getMessage());
    }
}

/**
 * Método que comprueba que la contraseña corresponda con ese correo
 * 
 * @param string $contraseña Contraseña del usuario
 * @param string $correo Correo electrónico del usuario
 * @return boolean Devuelve verdadero si el correo y la contraseña coinciden con las de la base de datos
 */
function cotejar_contraseñas($contraseña, $correo) {
    try {
        $credenciales_validas = false;
        $base = conectar('admin');
        $sentencia = $base->prepare('SELECT * FROM usuarios WHERE email=:correo');
        $sentencia->bindParam(':correo', $correo);
        $sentencia->execute();
        $result = $sentencia->fetch(PDO::FETCH_ASSOC);
        if (password_verify($contraseña, $result["password"])) {
            $credenciales_validas = true;
        }
        $sentencia = null;
        $base = null;
        return $credenciales_validas;
    } catch (PDOException $e) {
        die('No se pudo conectar: ' . $e->getMessage());
    }
}

/**
 * Método que crea una sesión y le vincula los datos recogidos de la base de datos 
 * para el usuario en cuestión
 * 
 * @param string $correo Correo electrónico del usuario
 */
function crear_sesion($correo) {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare('SELECT * FROM usuarios WHERE email=:correo');
        $sentencia->bindParam(':correo', $correo);
        $sentencia->execute();
        $result = $sentencia->fetch(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION['usuario'] = $result['nombre'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['telf'] = $result['telf'];
        $_SESSION['direccion'] = $result['direccion'];
        $id_rol = $result['rol_usuario'];

        //Acceder a la tabla roles
        $sentencia = $base->prepare('SELECT nombre_rol FROM roles WHERE id=:id');
        $sentencia->bindParam(':id', $id_rol);
        $sentencia->execute();
        $result2 = $sentencia->fetch(PDO::FETCH_ASSOC);
        $_SESSION['rol'] = $result2["nombre_rol"];
    } catch (PDOException $e) {
        die('No se pudo conectar: ' . $e->getMessage());
    }
    header("Location:../Reservas/Reservas_habitaciones.php");
}
