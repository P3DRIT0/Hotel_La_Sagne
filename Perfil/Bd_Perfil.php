<?php
include_once '../config/conexiones_BD.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Metodo que recibe por cabecera un email y busca en la tabla usuarios la imagen asociada a dicho email 
 * @param string $email
 * @return string devuelve la ruta de la imagen de perfil 
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
/**
 * Metodo que recibe por cabecera un email y la ruta de una imagen y a traves de la consulta update cambia dicha ruta para el usuario 
 * con ese email 
 * @param string $email 
 * @param string $img ruta de la imagen 
 */
function cambiar_img_perfil($email,$img){
     try {
        $base = conectar('admin');
        $sentencia = $base->prepare("UPDATE usuarios SET imagen_usuario=:img WHERE email=:email");
        $sentencia->bindParam(':email', $email);
        $sentencia->bindParam(':img', $img);
        $sentencia->execute();
        $sentencia=null;
        $base=null;
     
}  catch (PDOException $e) {
        die('No se pudo conectar: ' . mysql_error());
    }
}
/**
 * Metodo para consultar las reservas de un usuario a traves del id 
 * @return array con los campos de la tabla reservas
 */
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
/**
 * Metodo que recibe por cabecera un nombre,telefono y una direccion y mediante un update nos permite 
 * actualizar los datos.
 * @param string $nombre
 * @param string $telf
 * @param string $direccion
 */
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