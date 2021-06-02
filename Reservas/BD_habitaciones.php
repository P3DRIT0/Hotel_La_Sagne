<?php

include '../config/conexiones_BD.php';

/**
 * Método que inserta un nuevo tipo de habitacion  en la base de datos con los datos 
 * recogidos por cabecera
 * 
 * @param float $m2 Metros cuadrados de la habitación
 * @param boolean $ventana Indica si tiene o no ventana
 * @param string $tipo_habitacion Indica el tipo de habitación a crear
 * @param boolean $servicio_limpieza Indica si tiene o no servicio de limpieza
 * @param boolean $internet Indica si tiene o no internet
 * @param float $precio Precio de la habitación
 * @param string $descripcion Descripcion de la habitación
 */
function crear_tipo_habitacion($m2, $ventana, $tipo_habitacion, $limpieza, $internet, $precio, $descripcion) {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("INSERT INTO `tipo_habitaciones`(`m2`,`ventana`,`tipo_de_habitacion`,`servicio_limpieza`,`internet`,`precio`,`descripcion`) VALUES (:m2,:ventana,:tipo_habitacion,:servicio_limpieza,:internet,:precio,:descripcion)");
        $sentencia->bindParam(':m2', $m2);
        $sentencia->bindParam(':ventana', $ventana);
        $sentencia->bindParam(':tipo_habitacion', $tipo_habitacion);
        $sentencia->bindParam(':servicio_limpieza', $limpieza);
        $sentencia->bindParam(':internet', $internet);
        $sentencia->bindParam(':precio', $precio);
        $sentencia->bindParam(':descripcion', $descripcion);
        $sentencia->execute();
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

/**
 * Método para añadir una imagen a las habitaciones.
 * 
 * @param file $imagen_habitacion Imagen de la habitación
 * @param string $descripcion Descripción de la habitación
 */
function añadir_imagenes($rutas_imagenes, $tipo) {
    $base = conectar('admin');
    $sentencia = $base->prepare("SELECT id FROM tipo_habitaciones WHERE tipo_de_habitacion = :tipo");
    try {
        $sentencia->bindParam(':tipo', $tipo);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll();
        echo $resultados[0][0];
        $id = $resultados[0][0];
        for ($index = 0; $index < count($rutas_imagenes); $index++) {
            $imagenes = $rutas_imagenes[$index];
            echo $imagenes;
            $sentencia = $base->prepare("INSERT INTO `imagenes_habitaciones`(`imagen_habitacion`,`id_tipo_habitacion`) VALUES (:imagen_habitacion,:tipo)");
            $sentencia->bindParam(':imagen_habitacion', $imagenes);
            $sentencia->bindParam(':tipo', $id);
            $sentencia->execute();
        }
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

/**
 * Método para listar las habitaciones existentes.
 * 
 * @return array Lista de habitaciones existentes
 */
function lista_habitaciones() {
    $base = conectar('admin');
    $sentencia = $base->prepare("SELECT * FROM habitaciones");
    $sentencia->execute();
    $resultados = $sentencia->fetchAll();
    return $resultados;
}

/**
 * Método para listar los diferentes tipos de habitaciones existentes.
 * 
 * @return array Lista de los tipos de habitaciones existentes
 */
function lista_tipos_habitaciones() {
    $base = conectar('admin');
    $sentencia = $base->prepare("SELECT * FROM tipo_habitaciones");
    $sentencia->execute();
    $resultados = $sentencia->fetchAll();
    return $resultados;
}

/**
 * Método para visualizar las habitaciones existentes.
 * 
 * @return array 
 */
function visualizar_habitaciones() {
    $base = conectar('admin');
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
            $id = $resultados[$index]['id'];
            echo "<div class='habitacion' id=habitacion$id>";
            echo "<img src='$ruta'></img>";
            echo "<div class='texto'>";
            echo "<h1>$titulo</h1>";
            echo "<p>$descripcion</p>";
            echo "</div>";
            echo "<a class='precio'>$precio €</a>";
            echo "</div>";
        }
        return array($id - $index, $id);
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

/**
 * Método para borrar habitaciones que recibe por cabecera un array con los id de 
 * las habitaciones a borrar
 * 
 * @param array $habitaciones_borrar Array de habitaciones a borrar
 */
function borrar_habitaciones($habitaciones_borrar) {

    try {
        $base = conectar('admin');
        for ($index = 0; $index < count($habitaciones_borrar); $index++) {
            echo 'Borrando';
            $sentencia2 = $base->prepare("DELETE FROM imagenes_habitaciones WHERE id_tipo_habitacion=:id_habitacion1");
            $sentencia2->bindParam(':id_habitacion1', $habitaciones_borrar[$index]);
            $sentencia2->execute();

            $sentencia = $base->prepare("DELETE FROM habitaciones WHERE id=:id");
            $sentencia->bindParam(':id', $habitaciones_borrar[$index]);
            $sentencia->execute();
        }
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

/**
 * Método para borrar diferentes tipos de habitaciones que recibe en un array por 
 * cabecera.
 * 
 * @param array $tipos_habitaciones_a_borrar Array de habitaciones a borrar
 */
function borrar_tipo_habitaciones($tipos_habitaciones_a_borrar, $id_tipo) {

    try {
        $base = conectar('admin');
        $base->beginTransaction();

        for ($index = 0; $index < count($tipos_habitaciones_a_borrar); $index++) {

//Borrando servicios dependientes del tipo de habitación
//PENDIENTE
//Borrando reservas dependientes del tipo de habitación
//PENDIENTE
//Borrando las imagenes dependientes del tipo de habitación

            $sentencia = $base->prepare("DELETE FROM imagenes_habitaciones WHERE id_tipo_habitacion=:id_tipo;");

            $sentencia->bindParam(':id_tipo', $id_tipo[$index]);

            $sentencia->execute();

//Borrar imagenes del servidor
            for ($i = 0; $i < 5; $i++) {
                borrar_img_servidor((($id_tipo[$index] * 5) + 1) + $i);
            }
//Borrando habitaciones del tipo indicado
            $sentencia2 = $base->prepare("DELETE FROM habitaciones WHERE tipo_habitacion=:tipo_habitacion");
            $sentencia2->bindParam(':tipo_habitacion', $tipos_habitaciones_a_borrar[$index]);
            $sentencia2->execute();

//Borrando el tipo
            $sentencia3 = $base->prepare("DELETE FROM tipo_habitaciones WHERE tipo_de_habitacion=:tipo_habitacion");
            $sentencia3->bindParam(':tipo_habitacion', $tipos_habitaciones_a_borrar[$index]);
            $sentencia3->execute();

            $msg = "listo";
            echo "<script type='text/javascript'>alert($msg);</script>";
            print 'Listo para ejecutar';
            print_r("listo");
            echo 'Listo';

            $sentencia = null;
            $sentencia2 = null;
            $sentencia3 = null;
        }
        $base->commit();
        echo 'Datos borrados correctamente';
        $base = null;
    } catch (PDOException $e) {
        $base->rollBack();
        echo 'Ha ocurrido un error al intentar borrar los datos';
        print $e->getMessage();
    }
}

/**
 * Método para borrar las imagenes residuales del servidor
 * @param type $index
 */
function borrar_img_servidor($index) {
    unlink('Imagenes_habitaciones/' . $index . '.jpg');
}

/**
 * Método para modificar los datos de una habitación en concreto en la base de datos.
 * 
 * @param int $id Identificador de la habitación
 * @param float $m2 Metros cuadrados de la habitación
 * @param float $precio Precio de la habitación
 * @param boolean $ventana Si dispone de ventana o no
 * @param boolean $limpieza Si dipone de servicio de limpieza o no
 * @param boolean $internet Si dispone de internet o no
 * @param string $tipo_de_habitacion Tipo de habitación
 */
function modificar_habitaciones($id, $m2, $precio, $ventana, $limpieza, $internet, $tipo_de_habitacion) {
    $base = conectar('admin');
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

function ver_tipos_existentes() {
    $base = conectar('admin');
    $sentencia = $base->prepare("SELECT tipo_de_habitacion FROM tipo_habitaciones");
    try {
        $sentencia->execute();
        $resultados = $sentencia->fetchAll();
        return $resultados;
        $sentencia = null;
        $base = null;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

function crear_habitacion($tipo) {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("INSERT INTO `habitaciones`(`tipo_habitacion`) VALUES (:tipo_habitacion)");
        $sentencia->bindParam(':tipo_habitacion', $tipo);
        $sentencia->execute();
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

function listar_habitaciones() {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT * FROM  habitaciones ");
        $sentencia->execute();
        $resultados = $sentencia->fetchAll();
        return $resultados;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

function asignar_nombres() {
    try {

        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT id FROM tipo_habitaciones ORDER BY id DESC LIMIT 1;");
        $sentencia->execute();
        $resultados = $sentencia->fetchAll();

        return $resultados[0][0];
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

function comprobar_tipo($tipo) {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT * FROM  tipo_habitaciones WHERE tipo_de_habitacion =:tipo");
        $sentencia->bindParam(':tipo', $tipo);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll();
        return $resultados;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

function devolver_tipos_imagenes() {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT * FROM  tipo_habitaciones INNER JOIN imagenes_habitaciones  ON tipo_habitaciones.id=imagenes_habitaciones.id_tipo_habitacion");
        $sentencia->execute();
        $resultados = $sentencia->fetchAll();
        return $resultados;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

function contar_tipos() {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT * FROM  tipo_habitaciones");
        $sentencia->execute();
        $cuenta = $sentencia->rowCount();
        return $cuenta;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

function modificar_habitacion($id, $nuevo_tipo) {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("UPDATE habitaciones SET tipo_habitacion=:tipo WHERE id =:id");
        $sentencia->bindParam(':tipo', $nuevo_tipo);
        $sentencia->bindParam(':id', $id);
        $sentencia->execute();
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

/**
 * Método que obtiene todos los servicios existentes en la base de datos
 * @return array Contiene los servicios
 */
function lista_servicios() {
    try {
        $base = conectar("admin");
        $sql = $base->prepare("SELECT * FROM servicios");
        $sql->execute();
        $result[] = $sql->fetchAll();
        return $result;

//        print_r($result[0]);
    } catch (Exception $ex) {
        print $ex->getMessage();
    }
}

/**
 * Método que inserta en la base de datos un nuevo servicio 
 * 
 * @param string $nombre Nombre del servicio
 * @param int $precio Precio del servicio
 * @param string $descripcion Descripción del servicio
 */
function servicio_nuevo($nombre, $precio, $descripcion) {
    try {
        $base = conectar("admin");
        $sql = $base->prepare("INSERT INTO servicios (nombre_servicio,precio_servicio,descripcion) VALUES (:nombre,:precio,:descripcion)");
        $sql->bindParam(":nombre", $nombre);
        $sql->bindParam(":precio", $precio);
        $sql->bindParam(":descripcion", $descripcion);
        $sql->execute();

        echo "Guardado <br>";
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

/**
 * Método para comprobar si un servicio existe
 * 
 * @param array $lista_servicios Lista de servicios existentes
 * @param string $nombre Nombre del servicio a evaluar
 * @return boolean Indica si existe en la base de datos
 */
function servicio_comprobar($lista_servicios, $nombre) {
//print_r($lista_servicios[0]);
    $existe = false;
    for ($i = 0; $i < count($lista_servicios[0]); $i++) {
        if ($lista_servicios[0][$i]["nombre_servicio"] == $nombre) {
            $existe = true;
        }
    }
    return $existe;
}

function servicio_borrar($servicios_a_borrar_id) {
    //Borrar en servicios
    try {
        $base = conectar("admin");
        for ($i = 0; $i < count($servicios_a_borrar_id); $i++) {
            $sql = $base->prepare("DELETE FROM servicios WHERE id=:id");
            $sql->bindParam(":id", $servicios_a_borrar_id[$i]);
            $sql->execute();
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }

    //Borrar en servicios_habitaciones
}
