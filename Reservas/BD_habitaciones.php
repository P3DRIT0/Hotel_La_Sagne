<?php
include '../config/conexiones_BD.php';
function crear_habitacion($m2, $ventana, $tipo_habitacion, $servicio_limpieza, $internet, $precio) {
    try {
        $base = conectar();
        $sentencia = $base->prepare("INSERT INTO `habitaciones`(`m2`,`ventana`,`tipo_de_habitacion`,`servicio_limpieza`,`internet`,`precio`) VALUES (:m2,:ventana,:tipo_habitacion,:servicio_limpieza,:internet,:precio)");
        $sentencia->bindParam(':m2', $m2);
        $sentencia->bindParam(':ventana', $ventana);
        $sentencia->bindParam(':tipo_habitacion', $tipo_habitacion);
        $sentencia->bindParam(':servicio_limpieza', $servicio_limpieza);
        $sentencia->bindParam(':internet', $internet);
        $sentencia->bindParam(':precio', $precio);
        $sentencia->execute();
        $sentencia = null;
        $base = null;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

function añadir_imagenes($imagen_habitacion, $descripcion) {
    $base = conectar();
    $sentencia = $base->prepare("SELECT * FROM habitaciones");
    try {
        $sentencia->execute();
        $resultados = $sentencia->fetchAll();
        for ($index = 0; $index < count($resultados); $index++) {
            
        }
        $id = $resultados[$index - 1]['id'];
        $sentencia = $base->prepare("INSERT INTO `imagenes_habitaciones`(`id_habitacion`,`imagen_habitacion`,`descripcion_imagen`) VALUES (:id_habitacion,:imagen_habitacion,:descripcion_imagen)");
        $sentencia->bindParam(':id_habitacion', $id);
        $sentencia->bindParam(':imagen_habitacion', $imagen_habitacion);
        $sentencia->bindParam(':descripcion_imagen', $descripcion);
        $sentencia->execute();
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

function lista_habitaciones() {
    $base = conectar();
    $sentencia = $base->prepare("SELECT * FROM habitaciones");
    $sentencia->execute();
    $resultados = $sentencia->fetchAll();
    return $resultados;
}

function visualizar_habitaciones() {
    $base = conectar();
    $sentencia = $base->prepare("SELECT * FROM habitaciones");
    $sentencia2 = $base->prepare("SELECT * FROM imagenes_habitaciones");
    try {
        $sentencia->execute();
        $sentencia2->execute();
        $resultados = $sentencia->fetchAll();
        $resultados2 = $sentencia2->fetchAll();
        for ($index = 0; $index < count($resultados); $index++) {
            $ruta = $resultados2[$index]['imagen_habitacion'];
            $titulo = $resultados[$index]['tipo_de_habitacion'];
            $descripcion = $resultados2[$index]['descripcion_imagen'];
            $precio = $resultados[$index]['precio'];
            $id=$resultados[$index]['id'];
            echo "<div class='habitacion' id=habitacion$id>";
            echo "<img src='$ruta'></img>";
            echo "<div class='texto'>";
            echo "<h1>$titulo</h1>";
            echo "<p>$descripcion</p>";
            echo "</div>";
            echo "<a class='precio'>$precio €</a>";
            echo "</div>";
            
        }
      return array ($id-$index,$id);
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

function borrar_habitaciones($habitaciones_borrar) {
    try {
        $base = conectar();
        for ($index = 0; $index < count($habitaciones_borrar); $index++) {
            $sentencia2 = $base->prepare("DELETE FROM imagenes_habitaciones WHERE id_habitacion=:id_habitacion");
            $sentencia2->bindParam(':id_habitacion', $habitaciones_borrar[$index]);
            $sentencia2->execute();
            $sentencia = $base->prepare("DELETE FROM habitaciones WHERE id=:id");
            $sentencia->bindParam(':id', $habitaciones_borrar[$index]);
            $sentencia->execute();
        }
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

function modificar_habitaciones($id,$m2,$precio,$ventana,$limpieza,$internet,$tipo_de_habitacion) {
    $base = conectar();
    $sentencia = $base->prepare("UPDATE habitaciones SET m2=:m2,ventana=:ventana,tipo_de_habitacion=:tipo_de_habitacion"
            . ",servicio_limpieza=:servicio_limpieza "
            . ",internet=:internet,precio=:precio; WHERE id=:id");
    $sentencia->bindParam(':m2', $m2);
    $sentencia->bindParam(':ventana', $ventana);
    $sentencia->bindParam(':tipo_de_habitacion', $tipo_de_habitacion);
    $sentencia->bindParam(':servicio_limpieza', $limpieza);
    $sentencia->bindParam(':internet', $internet);
    $sentencia->bindParam(':precio', $precio);
    $sentencia->bindParam(':id', $id);
    $sentencia->execute();
    header('Location:./Reservas_habitaciones.php');
}
