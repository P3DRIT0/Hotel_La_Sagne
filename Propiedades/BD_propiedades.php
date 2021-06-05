<?php

include_once '../config/conexiones_BD.php';

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
