<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function comprobar_usuario($correo){
   
    try {
$usuario_registrado=false; 
$base = new PDO('mysql:host=localhost; dbname=hotel', 'administrador', '1234');
 $sentencia = $base->prepare('SELECT * FROM usuarios WHERE email=:correo');
 $sentencia->bindParam(':correo', $correo);
 $sentencia->execute();
 $result = $sentencia->fetch(PDO::FETCH_ASSOC);
 if(!empty($result["email"])){
    $usuario_registrado=true;
}
$sentencia = null;
$base=null;        
return $usuario_registrado;
} catch(PDOException $e) {
    die('No se pudo conectar: ' . $e->getMessage());
}

}
function cotejar_contraseñas($contraseña,$correo){
    try {
 $credenciales_validas=false;
 $base = new PDO('mysql:host=localhost; dbname=hotel', 'administrador', '1234');
 $sentencia = $base->prepare('SELECT * FROM usuarios WHERE email=:correo');
 $sentencia->bindParam(':correo', $correo);
 $sentencia->execute();
 $result = $sentencia->fetch(PDO::FETCH_ASSOC);
 if(password_verify($contraseña,$result["password"])){
     $credenciales_validas=true;
}
$sentencia = null;
$base=null;  
return $credenciales_validas;
 } catch(PDOException $e) {
    die('No se pudo conectar: ' .$e->getMessage());
}
}