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
     
}  catch (PDOException $e) {
        die('No se pudo conectar: ' . mysql_error());
    }
}
