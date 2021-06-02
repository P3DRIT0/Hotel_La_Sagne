<?php

session_start();
include '../config/conexiones_BD.php';

/**
 * Método que recibe por cabecera el tipo de habitación y devuelve un array con el tipo de habitacion y su id
 * 
 * @param string $rest Tipo de habitación
 * @return array Conjunto de tipos de habitaciones con sus IDs
 */
function obtener_habitacion($rest) {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT * FROM tipo_habitaciones WHERE tipo_de_habitacion=:tipo");
         $sentencia->bindParam(':tipo', $rest);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll();
        $id = $resultados[0][0];
        
        $sentencia2 = $base->prepare("SELECT * FROM imagenes_habitaciones where id_tipo_habitacion=:id_tipo_habitacion");
        $sentencia2->bindParam(':id_tipo_habitacion', $id);
        $sentencia2->execute();
        $resultados2 = $sentencia2->fetchAll();
        return array($resultados, $resultados2);
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

/**
 * Metodo que recibe por cabecera el tipo de habitacion del que queremos saber cuantas existen en total(dadas de alta)
 * 
 * @param string $tipo Tipo de habitación
 * @return int Numero de filas que corresponde al array formado por la sentencia previa
 */
function contar_habitaciones($tipo) {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT * FROM habitaciones where tipo_habitacion=:tipo");
        $sentencia->bindParam(':tipo', $tipo);
        $sentencia->execute();
        $cuenta = $sentencia->rowCount();
        return $cuenta;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

/**
 * Metodo que recibe por cabecera un tipo de habitacion para contar el numero de estas que estan reservadas
 * 
 * @param string $tipo Tipo de habitación
 * @return int Numero de filas que corresponde al array formado por la sentencia previa
 */
function contar_reservas($tipo) {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT num_reserva FROM reservas where tipo_habitacion=:tipo");
        $sentencia->bindParam(':tipo', $tipo);
        $sentencia->execute();
        $cuenta = $sentencia->rowCount();
        return $cuenta;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

/**
 * Metodo que recoge por cabecera los datos con los que va a rellenar la reserva de una habitacion
 * 
 * @param string $tipo
 * @param date $fecha_entrada
 * @param date $fecha_salida
 * @param int $id_habitacion
 * @return boolean En función de si funcionó correctamente el método
 */
function crear_reserva($tipo, $fecha_entrada, $fecha_salida,$id_habitacion) {
    try {

        $base = conectar('admin');
         $base->beginTransaction();
        $sentencia = $base->prepare("INSERT INTO reservas (id_usuario,fecha_entrada,fecha_salida,tipo_habitacion)VALUES(:id,:entrada,:salida,:tipo)");
        $sentencia->bindParam(':id', $_SESSION['id']);
        $sentencia->bindParam(':entrada', $fecha_entrada);
        $sentencia->bindParam(':salida', $fecha_salida);
        $sentencia->bindParam(':tipo', $tipo);
        $sentencia->execute();

        $sentencia2 = $base->prepare("SELECT num_reserva FROM reservas WHERE id_usuario=:id ORDER BY num_reserva DESC LIMIT 1;");
        $sentencia2->bindParam(':id', $_SESSION['id']);
        $sentencia2->execute();
        $result = $sentencia2->fetch(PDO::FETCH_ASSOC);
        $num_reserva = $result['num_reserva'];
        
        $sentencia3 = $base->prepare("INSERT INTO habitaciones_reservas (num_reserva,id_habitacion,fecha_disponibilidad)VALUES(:num_reserva,:id,:fecha)");
        $sentencia3->bindParam(':num_reserva', $num_reserva);
        $sentencia3->bindParam(':id', $id_habitacion);
        $sentencia3->bindParam(':fecha', $fecha_salida);
        $sentencia3->execute();
         $sentencia = null;
         $sentencia2 = null;
         $sentencia3 = null;
         $base->commit();
         $base=null;
    } catch (PDOException $e) {
        print $e->getMessage();
        return false;
    }
}


function devolver_id_habitaciones_reservadas(){
    try {
    $base = conectar('admin');
        $sentencia = $base->prepare("SELECT id_habitacion FROM habitaciones_reservas");
        $sentencia->execute();
        $result = $sentencia->fetchAll();
        return $result;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}
function devolver_id_habitaciones(){
    try {
    $base = conectar('admin');
    $sentencia2 = $base->prepare("SELECT id FROM habitaciones");
        $sentencia2->execute();
        $result2 = $sentencia2->fetchAll();
        
        return $result2;
        } catch (PDOException $e) {
        print $e->getMessage();
    }
}


function ver_fechas_mas_altas($tipo){
    try {
     $fechas_salida;
    $base = conectar('admin');
    $sentencia = $base->prepare("SELECT * FROM reservas INNER JOIN habitaciones_reservas ON reservas.num_reserva=habitaciones_reservas.num_reserva WHERE tipo_habitacion=:tipo");
        $sentencia->bindParam(':tipo', $tipo);
         $sentencia->execute();
        $result = $sentencia->fetchAll();
        for ($index = 0; $index < count($result); $index++) { 
             $fechas_salida[$index][0]=$result[$index][0];
             $fechas_salida[$index][1]=$result[$index][7];
             $fechas_salida[$index][2]=$result[$index][8];  

        }
        return $fechas_salida;
        } catch (PDOException $e) {
        print $e->getMessage();
    }
    }
    function crear_reserva_actualizando_fecha($tipo, $fecha_entrada, $fecha_salida,$id_habitacion) {
    try {

        $base = conectar('admin');
         $base->beginTransaction();
        $sentencia = $base->prepare("INSERT INTO reservas (id_usuario,fecha_entrada,fecha_salida,tipo_habitacion)VALUES(:id,:entrada,:salida,:tipo)");
        $sentencia->bindParam(':id', $_SESSION['id']);
        $sentencia->bindParam(':entrada', $fecha_entrada);
        $sentencia->bindParam(':salida', $fecha_salida);
        $sentencia->bindParam(':tipo', $tipo);
        $sentencia->execute();

        $sentencia2 = $base->prepare("SELECT num_reserva FROM reservas WHERE id_usuario=:id ORDER BY num_reserva DESC LIMIT 1;");
        $sentencia2->bindParam(':id', $_SESSION['id']);
        $sentencia2->execute();
        $result = $sentencia2->fetch(PDO::FETCH_ASSOC);
        $num_reserva = $result['num_reserva'];
        
        $sentencia3 = $base->prepare("INSERT INTO habitaciones_reservas (num_reserva,id_habitacion,fecha_disponibilidad)VALUES(:num_reserva,:id,:fecha)");
        $sentencia3->bindParam(':num_reserva', $num_reserva);
        $sentencia3->bindParam(':id', $id_habitacion);
        $sentencia3->bindParam(':fecha', $fecha_salida);
        $sentencia3->execute();
        $sentencia4 = $base->prepare("UPDATE habitaciones_reservas  SET fecha_disponibilidad =:fecha WHERE id_habitacion =:id");
        $sentencia4->bindParam(':fecha', $fecha_salida);
        $sentencia4->bindParam(':id', $id_habitacion);
        $sentencia4->execute();
         $sentencia = null;
         $sentencia2 = null;
         $sentencia3 = null;
         $sentencia4 = null;
         $base->commit();
         $base=null;
    } catch (PDOException $e) {
        print $e->getMessage();
        return false;
    }
}
    
    
?>

