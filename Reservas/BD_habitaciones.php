<?php


function crear_habitacion($m2, $ventana, $tipo_habitacion, $servicio_limpieza, $internet,$precio) {
    try {
        $base = new PDO('mysql:host=localhost; dbname=hotel', 'administrador', '1234');
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
        die('No se pudo conectar: ' . mysql_error());
    }
}

function añadir_imagenes($imagen_habitacion,$descripcion){
     $base = new PDO('mysql:host=localhost; dbname=hotel', 'administrador', '1234');
    $sentencia = $base->prepare("SELECT * FROM habitaciones");
     try {
    $sentencia->execute();
    $resultados = $sentencia->fetchAll();
    for ($index = 0; $index < count($resultados); $index++) {  
    }
    $id=$resultados[$index-1]['id'];
    $sentencia = $base->prepare("INSERT INTO `imagenes_habitaciones`(`id_habitacion`,`imagen_habitacion`,`descripcion_imagen`) VALUES (:id_habitacion,:imagen_habitacion,:descripcion_imagen)");
    $sentencia->bindParam(':id_habitacion', $id);
    $sentencia->bindParam(':imagen_habitacion', $imagen_habitacion);
    $sentencia->bindParam(':descripcion_imagen', $descripcion);
    $sentencia->execute();
     }catch (PDOException $e) {
    print $e->getMessage();
  }
}






function visualizar_habitaciones(){
    $base = new PDO('mysql:host=localhost; dbname=hotel', 'administrador', '1234');
    $sentencia = $base->prepare("SELECT * FROM habitaciones");
    $sentencia2 = $base->prepare("SELECT * FROM imagenes_habitaciones");
     try {
    $sentencia->execute();
    $sentencia2->execute();
    $resultados = $sentencia->fetchAll();
    $resultados2= $sentencia2->fetchAll();
    for ($index = 0; $index < count($resultados); $index++) {
         $ruta=$resultados2[$index]['imagen_habitacion'];
         $titulo=$resultados[$index]['tipo_de_habitacion'];
         $descripcion=$resultados2[$index]['descripcion_imagen'];
         $precio=$resultados[$index]['precio'];
        echo "<div class='habitacion'>";
        echo "<img src='$ruta'></img>";
        echo "<div class='texto'>";
        echo "<h1>$titulo</h1>";
        echo "<p>$descripcion</p>";  
        echo "</div>";
        echo "<a class='precio'>$precio €</a>";
        echo "</div>";
        
    }
  }
     
  catch (PDOException $e) {
    print $e->getMessage();
  }
}

