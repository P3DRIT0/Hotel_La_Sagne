<?php
include_once '../config/conexiones_BD.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function cargar_img_perfil($email){
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT imagen_usuario FROM usuarios WHERE email=:email ");
        $sentencia->bindParam(':email', $email);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll();
        return $resultados[0][0];
        $sentencia=null;
        $base=null;
}  catch (PDOException $e) {
        die('No se pudo conectar: ' . mysql_error());
    }
}

function cambiar_img_perfil($email,$img){
     try {
        $base = conectar('admin');
        $sentencia = $base->prepare("UPDATE usuarios SET imagen_usuario=:img; WHERE email=:email");
        $sentencia->bindParam(':email', $email);
        $sentencia->bindParam(':img', $img);
        $sentencia->execute();
        $sentencia=null;
        $base=null;
     
}  catch (PDOException $e) {
        die('No se pudo conectar: ' . mysql_error());
    }
}

function consultar_reservas(){
     try {
        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT * FROM reservas WHERE id_usuario=:id");
        $sentencia->bindParam(':id', $_SESSION['id']);
        $sentencia->execute();
         $resultados = $sentencia->fetchAll();
         return $resultados;
         $sentencia=null;
        $base=null;
        }  catch (PDOException $e) {
        die('No se pudo conectar: ' . mysql_error());
    }
}
function actualizar_datos_usuario($nombre,$telf,$direccion){
     try {
     $base = conectar('admin');
        $sentencia = $base->prepare("UPDATE usuarios SET nombre=:nombre,telf=:telf,direccion=:direccion WHERE id=:id");
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':telf', $telf);
        $sentencia->bindParam(':direccion', $direccion);
        $sentencia->bindParam(':id', $_SESSION['id']);
        $sentencia=null;
        $base=null;
        }  catch (PDOException $e) {
        die('No se pudo conectar: ' . mysql_error());
    }
}