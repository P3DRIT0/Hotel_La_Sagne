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
function crear_sesion($correo){
  try {
 $base = new PDO('mysql:host=localhost; dbname=hotel', 'administrador', '1234');
 $sentencia = $base->prepare('SELECT * FROM usuarios WHERE email=:correo');
 $sentencia->bindParam(':correo', $correo);
 $sentencia->execute();
 $result = $sentencia->fetch(PDO::FETCH_ASSOC);
 session_start();
 $_SESSION['usuario']=$result['nombre'];
 $_SESSION['email']=$result['email'];
 $_SESSION['telf']=$result['telf'];
 $_SESSION['direccion']=$result['direccion'];
 $id_rol=$result['rol_usuario'];
//Acceder a la tabla roles
 $sentencia = $base->prepare('SELECT nombre_rol FROM roles WHERE id=:id');
 $sentencia->bindParam(':id', $id_rol);
 $sentencia->execute();
 $result2 = $sentencia->fetch(PDO::FETCH_ASSOC);
 $_SESSION['rol']=$result2["nombre_rol"];

 
 } catch(PDOException $e) {
    die('No se pudo conectar: ' .$e->getMessage());
}
header("Location:../Reservas/Reservas_habitaciones.php");
}