<?php
session_start();
include '../config/conexiones_BD.php';
function obtener_habitacion($rest){
    
try {
        $base = conectar();
         $sentencia = $base->prepare("SELECT * FROM habitaciones where tipo_de_habitacion=:tipo_habitacion");
         $sentencia->bindParam(':tipo_habitacion',$rest);
         $sentencia->execute();
         $resultados = $sentencia->fetchAll();
         $id=$resultados[0][0];
         $sentencia2 = $base->prepare("SELECT * FROM imagenes_habitaciones where id_habitacion=:id_habitacion");
         $sentencia2->bindParam(':id_habitacion',$id);      
         $sentencia2->execute();
         $resultados2 = $sentencia2->fetchAll();
         return array($resultados,$resultados2);
         
    } catch (PDOException $e) {
        print $e->getMessage();
    }

}
function contar_habitaciones($tipo){
    try {
        $base = conectar();
        $sentencia = $base->prepare("SELECT id FROM habitaciones where tipo_de_habitacion=:tipo");
        $sentencia->bindParam(':tipo',$tipo);
        $sentencia->execute();
        $cuenta = $sentencia->rowCount();
        return $cuenta;
}  catch (PDOException $e) {
        print $e->getMessage();
    }
}
function contar_reservas($tipo){
    try {
        $base = conectar();
        $sentencia = $base->prepare("SELECT num_reserva FROM reservas where tipo_habitacion=:tipo");
        $sentencia->bindParam(':tipo',$tipo);
        $sentencia->execute();
        $cuenta = $sentencia->rowCount();
        return $cuenta;
}  catch (PDOException $e) {
        print $e->getMessage();
    }
}
function crear_reserva($tipo,$fecha_entrada,$fecha_salida,$id_habitacion){
    try {
        $base = conectar();
        $sentencia = $base->prepare("INSERT INTO reservas (id_usuario,fecha_entrada,fecha_salida,tipo_habitacion)VALUES(:id,:entrada,:salida,:tipo)");
        $sentencia->bindParam(':id',$_SESSION['id']);
        $sentencia->bindParam(':entrada',$fecha_entrada);
        $sentencia->bindParam(':salida',$fecha_salida);
        $sentencia->bindParam(':tipo',$tipo);
        $sentencia->execute();
        
        $sentencia2 = $base->prepare("SELECT num_reserva FROM reservas WHERE id_usuario=:id");
        $sentencia2->bindParam(':id',$_SESSION['id']);
        $sentencia2->execute();
         $result = $sentencia2->fetch(PDO::FETCH_ASSOC);
        $num_reserva=$result['num_reserva'];
        $sentencia3 = $base->prepare("INSERT INTO habitaciones_reservas (num_reserva,id_habitacion)VALUES(:num_reserva,:id)");
        $sentencia3->bindParam(':num_reserva',$num_reserva);
        $sentencia3->bindParam(':id',$id_habitacion);
        $sentencia3->execute();
        return true;
}  catch (PDOException $e) {
        print $e->getMessage();
        return false;
    }
}
function ver_fechas($tipo,$fecha_entrada,$fecha_salida,$id_habitacion){
    try {
        $base = conectar();
        $sentencia = $base->prepare("SELECT * FROM reservas where tipo_habitacion=:tipo");
        $sentencia->bindParam(':tipo',$tipo);
        $sentencia->execute();
        $result = $sentencia->fetchAll();
        print_r($result);
        $fecha_entrada1 = strtotime($fecha_entrada);
        for ($index = 0; $index < count($result); $index++) {
           $fecha_fin_reserva = strtotime($result[$index][3]);
           echo $fecha_fin_reserva,"///",$fecha_entrada1;
           if($fecha_fin_reserva<$fecha_entrada1){
               crear_reserva($tipo, $fecha_entrada, $fecha_salida, $id_habitacion);
                header("Location:../Habitacion/Habitacion.php");
           }else{
               echo "Lo siento cabesa pero no nos quedan habitaciones de este tipo";
           }
        }
        
}  catch (PDOException $e) {
        print $e->getMessage();
    }
}

    ?>

