<?php

/* 
 *Clase para realizar las conexiones a la Base de datos
 */
function conectar (){
    try{
    $usuario="administrador";
    $contraseña="1234";
    $server="localhost";
    $dbname="hotel";
     $base = new PDO("mysql:host=$server; dbname=$dbname", "$usuario", "$contraseña");
     return $base;
 } catch(PDOException $e) {
    die('No se pudo conectar: ' .$e->getMessage());
 }
}