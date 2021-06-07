<?php

include_once '../config/conexiones_BD.php';


/**
 * Metodo que obtiene de la tabla usuarios todas sus propiedades para el usuario especificado
 * @param type $id
 * @return array con todos los capos de la tabla usuarios
 */
function cargar_propiedades_usuario($id) {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT * FROM usuarios WHERE id=:id");
        $sentencia->bindParam(':id', $id);
        $sentencia->execute();
        $result = $sentencia->fetchAll();
        return $result;
        $sentencia = null;
        $base = null;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}
/**
 * Metodo que recibe por cabecera la ruta de una imagen,la fecha de nacimiento,dni,nacionalidad y sexo
 * y las inserta en la tabla trabajadores 
 * 
 * @param string $imagen_perfil
 * @param date $fecha_nac
 * @param string $dni
 * @param string $nacionalidad
 * @param string $sexo
 */

function añadir_trabajadores($imagen_perfil, $fecha_nac, $dni, $nacionalidad, $sexo) {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("INSERT INTO trabajadores (id_usuario,fecha_nac,dni,nacionalidad,sexo) VALUES (:id_usuario,:fecha_nac,:dni,:nacionalidad,:sexo)");
        $sentencia->bindParam(":id_usuario", $_SESSION['id']);
        $sentencia->bindParam(":fecha_nac", $fecha_nac);
        $sentencia->bindParam(":dni", $dni);
        $sentencia->bindParam(":nacionalidad", $nacionalidad);
        $sentencia->bindParam(":sexo", $sexo);
        $sentencia->execute();
        $sentencia2 = $base->prepare("UPDATE usuarios SET imagen_usuario=:img WHERE id =:id");
        $sentencia2->bindParam(":img", $imagen_perfil);
        $sentencia2->bindParam(":id", $_SESSION['id']);
        $sentencia2->execute();
        $sentencia = null;
        $sentencia2 = null;
        $base = null;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

/**
 * Metodo que recibe por cabecera la ruta de una imagen y la actualiza en la tabla usuarios  
 * y añade el administrador a la tabla de los administradores
 * @param string $imagen_perfil
 */
function añadir_administradores($imagen_perfil) {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("INSERT INTO administradores (id_usuario) VALUES (:id_usuario)");
        $sentencia->bindParam(":id_usuario", $_SESSION['id']);
        $sentencia->execute();
        $sentencia2 = $base->prepare("UPDATE usuarios SET imagen_usuario=:img WHERE id =:id");
        $sentencia2->bindParam(":img", $imagen_perfil);
        $sentencia2->bindParam(":id", $_SESSION['id']);
        $sentencia2->execute();
        $sentencia = null;
        $sentencia2 = null;
        $base = null;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}
