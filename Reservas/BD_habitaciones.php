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
        $sentencia = null;
        $base = null;
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
        $sentencia = null;
        $base = null;
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
    $sentencia = null;
    $base = null;
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
    $sentencia = null;
    $base = null;
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
        $sentencia = null;
        $sentencia2 = null;
        $base = null;
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
        $sentencia = null;
        $sentencia2 = null;
        $base = null;
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
function borrar_tipo_habitaciones($tipo_habitacion_a_borrar, $id_tipo) {
    echo "Intentando borrar tipo $tipo_habitacion_a_borrar con id $id_tipo <br>";
    try {
        $base = conectar('admin');
        $base->beginTransaction();



//Borrando reservas dependientes del tipo de habitación
//PENDIENTE
//Borrando servicios adjuntos al tipo de habitación
        $sentencia4 = $base->prepare("DELETE FROM habitacion_servicio WHERE tipo_habitacion=:tipo");
        $sentencia4->bindParam(':tipo', $tipo_habitacion_a_borrar);
        $sentencia4->execute();
//Borrando las imagenes dependientes del tipo de habitación

        $sentencia = $base->prepare("DELETE FROM imagenes_habitaciones WHERE id_tipo_habitacion=:id_tipo;");

        $sentencia->bindParam(':id_tipo', $id_tipo);

        $sentencia->execute();

//Borrar imagenes del servidor

        for ($i = 0; $i < 5; $i++) {
            borrar_img_servidor((($id_tipo * 5) + 1) + $i);
        }


//Borrando habitaciones del tipo indicado
        $sentencia2 = $base->prepare("DELETE FROM habitaciones WHERE tipo_habitacion=:tipo_habitacion");
        $sentencia2->bindParam(':tipo_habitacion', $tipo_habitacion_a_borrar);
        $sentencia2->execute();

//Borrando el tipo
        $sentencia3 = $base->prepare("DELETE FROM tipo_habitaciones WHERE tipo_de_habitacion=:tipo_habitacion");
        $sentencia3->bindParam(':tipo_habitacion', $tipo_habitacion_a_borrar);
        $sentencia3->execute();

        $sentencia = null;
        $sentencia2 = null;
        $sentencia3 = null;
//            $sentencia4 = null;

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
    if (file_exists("'Imagenes_habitaciones/' . $index . '.jpg'")) {
        unlink('Imagenes_habitaciones/' . $index . '.jpg');
    }
}

/**
 * Método para modificar los datos de un tipo de habitación.
 * 
 * @param int $id Identificador de la habitación
 * @param float $m2 Metros cuadrados de la habitación
 * @param float $precio Precio de la habitación
 * @param boolean $ventana Si dispone de ventana o no
 */
function modificar_tipo_habitaciones($id, $m2, $precio, $ventana) {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("UPDATE tipo_habitaciones SET m2=:m2,ventana=:ventana,precio=:precio WHERE id=:id");
        $sentencia->bindParam(':m2', $m2);
        $sentencia->bindParam(':ventana', $ventana);
        $sentencia->bindParam(':precio', $precio);
        $sentencia->bindParam(':id', $id);
        $sentencia->execute();
        print 'Modificacion ejecutada';
        $sentencia = null;
        $base = null;
    } catch (Exception $e) {
        print $e->getMessage();
    }
}

/**
 * Metodo que nos permite ver los tipos de habitaciones existentes 
 * @return array con los tipos de habitaciones existentes 
 */
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

/**
 * Metodo que  recibe por cabecera el tipo de habitacion  nos permite crear una habitacion de dicho tipo
 * @param string $tipo
 */
function crear_habitacion($tipo) {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("INSERT INTO `habitaciones`(`tipo_habitacion`) VALUES (:tipo_habitacion)");
        $sentencia->bindParam(':tipo_habitacion', $tipo);
        $sentencia->execute();
        $sentencia = null;
        $base = null;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

/**
 * Metodo que nos permite listar las habitaciones habitaciones 
 * @param string $tipo
 * @return array $resultados array con las habitaciones 
 */
function listar_habitaciones() {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT * FROM  habitaciones ");
        $sentencia->execute();
        $resultados = $sentencia->fetchAll();
        return $resultados;
        $sentencia = null;
        $base = null;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

/**
 * Metodo que seleciona el ultimo id de los tipos de habitaciones 
 * @return string devuelve el id del tipo de habitacion 
 */
function asignar_nombres() {
    try {

        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT id FROM tipo_habitaciones ORDER BY id DESC LIMIT 1;");
        $sentencia->execute();
        $resultados = $sentencia->fetchAll();
        return $resultados[0][0];
        $sentencia = null;
        $base = null;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

/**
 * Metodo que recibe por cabecera un tipo de habitacion  y lo busca en la tabla tipo de 
 * habitaciones 
 * @param string $tipo 
 * @return array datos tipo seleccionado o array vacio si no encuentra el tipo
 */
function comprobar_tipo($tipo) {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT * FROM  tipo_habitaciones WHERE tipo_de_habitacion =:tipo");
        $sentencia->bindParam(':tipo', $tipo);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll();
        return $resultados;
        $sentencia = null;
        $base = null;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

/**
 * Metodo que junta las tablas imagenes habitaciones con la de tipos_habitaciones y lo devuelve en 
 * un array
 * @return array con los datos de la tabla imagenes habitaciones y la tabla tipo habitaciones
 */
function devolver_tipos_imagenes() {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT * FROM  tipo_habitaciones INNER JOIN imagenes_habitaciones  ON tipo_habitaciones.id=imagenes_habitaciones.id_tipo_habitacion");
        $sentencia->execute();
        $resultados = $sentencia->fetchAll();
        return $resultados;
        $sentencia = null;
        $base = null;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

/**
 * Metodo que permite contar los tipos de habitaciones existentes 
 * @return int cuenta el numero  de tipos de habitaciones distintos 
 */
function contar_tipos() {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT * FROM  tipo_habitaciones");
        $sentencia->execute();
        $cuenta = $sentencia->rowCount();
        return $cuenta;
        $sentencia = null;
        $base = null;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

/**
 * Mentodo que recibe por cabecera un id y un tipo y permite actualizar la
 * habitacion a ese tipo determinado 
 * @param int $id
 * @param string $nuevo_tipo
 */
function modificar_habitacion($id, $nuevo_tipo) {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("UPDATE habitaciones SET tipo_habitacion=:tipo WHERE id =:id");
        $sentencia->bindParam(':tipo', $nuevo_tipo);
        $sentencia->bindParam(':id', $id);
        $sentencia->execute();
        $sentencia = null;
        $base = null;
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
        $sentencia = null;
        $base = null;
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
        $sql = null;
        $base = null;
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
    $existe = false;
    for ($i = 0; $i < count($lista_servicios[0]); $i++) {
        if ($lista_servicios[0][$i]["nombre_servicio"] == $nombre) {
            $existe = true;
        }
    }
    return $existe;
}

/**
 * Método para borrar servicios de la tabla servicios
 * @param array $servicios_a_borrar_id Array con los servicios a borrar
 */
function servicio_borrar($servicios_a_borrar_id) {
    try {
        $base = conectar("admin");
        for ($i = 0; $i < count($servicios_a_borrar_id); $i++) {
            $sql = $base->prepare("DELETE FROM servicios WHERE id=:id");
            $sql->bindParam(":id", $servicios_a_borrar_id[$i]);
            $sql->execute();
        }
        $sql = null;
        $base = null;
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

/**
 * Método para insertar datos en la tabla habitacion_servicio
 * 
 * @param string $tipo_habitacion Tipo de habitaciones seleccionada
 * @param array $servicios Array con los servicios a insertar
 */
function insertar_en_servicios_habitaciones($tipo_habitacion, $servicios) {
    try {
        $base = conectar("admin");
        for ($i = 0; $i < count($servicios); $i++) {
            $servicio = $servicios[$i];
            $sql = $base->prepare("INSERT INTO habitacion_servicio (tipo_habitacion, id_servicio) VALUES (:tipo, :servicio)");
            $sql->bindParam(":tipo", $tipo_habitacion);
            $sql->bindParam(":servicio", $servicio);
            $sql->execute();
        }
        $sql = null;
        $base = null;
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

/**
 * Método para obtener todos los servicios adjuntos al tipo de habitación indicada por cabecera
 * 
 * @param string $tipo_habitacion Tipo de habitación
 * @return array Contiene los servicios
 */
function lista_servicios_tipo_habitacion($tipo_habitacion) {
    try {
        $base = conectar("admin");
        $sql = $base->prepare("SELECT habitacion_servicio.id_servicio, servicios.id, servicios.nombre_servicio FROM habitacion_servicio INNER JOIN servicios ON (habitacion_servicio.id_servicio = servicios.id)WHERE habitacion_servicio.tipo_habitacion = :tipo");
        $sql->bindParam(":tipo", $tipo_habitacion);
        $sql->execute();
        $result[] = $sql->fetchAll();
        return $result;
        $sql = null;
        $base = null;
    } catch (Exception $ex) {
        print $ex->getMessage();
    }
}

/**
 * Metodo que recibe por cabecera un id y un tipo y nos permite
 * borrar de la tabla habitacion la tupla que cumpla la condicion de ser igual al id y el tipo
 * pasado por cabecera 
 * @param string $tipo_habitacion_seleccionada
 * @param int $servicios_a_borrar_id 
 */
function borrar_servicio_tipo_habitacion($tipo_habitacion_seleccionada, $servicios_a_borrar_id) {
    try {
        $base = conectar("admin");
        for ($i = 0; $i < count($servicios_a_borrar_id); $i++) {
            $sql = $base->prepare("DELETE FROM habitacion_servicio WHERE id_servicio=:id AND tipo_habitacion=:tipo");
            $sql->bindParam(":id", $servicios_a_borrar_id[$i]);
            $sql->bindParam(":tipo", $tipo_habitacion_seleccionada);
            $sql->execute();
            $sql = null;
            $base = null;
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

/**
 * Metodo que nos devuelve en un array la tabla reservas unida con la tabla
 * habitaciones reservas 
 * @return array contiene los datos de las dos tablas mencionadas anteriormente 
 */
function listar_reservas() {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT * FROM reservas INNER JOIN habitaciones_reservas ON reservas.num_reserva=habitaciones_reservas.num_reserva INNER JOIN usuarios ON reservas.id_usuario = usuarios.id");
        $sentencia->execute();
        $resultados = $sentencia->fetchAll();
        return $resultados;
        $sentencia = null;
        $base = null;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

/**
 * Metodo que nos permite consultar los datos de un trabajador cuyo id sea el recibido 
 * por cabecera 
 * @param int $id_usuario
 * @return array datos del usuario 
 */
function consultar_datos_trabajadores($id_usuario) {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT * FROM trabajadores WHERE id_usuario=:id_usuario");
        $sentencia->bindParam(":id_usuario", $id_usuario);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll();
        return $resultados;
        $sentencia = null;
        $base = null;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

/**
 * Metodo que nos permite consultar los datos de un administrador cuyo id sea el recibido 
 * por cabecera 
 * @param int $id_usuario
 * @return array con los datos del administrador 
 */
function consultar_datos_administradores($id_usuario) {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT * FROM administradores WHERE id_usuario=:id_usuario");
        $sentencia->bindParam(":id_usuario", $id_usuario);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll();
        return $resultados;
        $sentencia = null;
        $base = null;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

/**
 * Metodo que une la tabla habitaciones reservas con la tabla habitaciones y nos devuelve
 * un array con las reservas de las habitaciones del tipo especificado por cabecera 
 * @param string $tipo
 * @return array con los datos de la tabla habitaciones reservas y la tabla habitaciones
 */
function consultar_reservas_por_tipo($tipo) {
    try {
        $base = conectar('admin');
        $sql = $base->prepare("SELECT * FROM habitaciones_reservas INNER JOIN habitaciones ON habitaciones_reservas.id_habitacion=habitaciones.id WHERE habitaciones.tipo_habitacion=:tipo");
        $sql->bindParam(":tipo", $tipo);
        $sql->execute();
        $resultados = $sql->fetchAll();
        $sql = null;
        $base = null;
        return $resultados;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

/**
 * metodo que a traves de una fecha de entrada y una de salida nos permite ver que habitaciones 
 * estan disponibles en ese rango de tiempo 
 * @param date $fecha_salida
 * @param date $fecha_entrada
 * @return array con el tipo de habitacion y su id  
 */
function consultar_id_reservas($fecha_salida, $fecha_entrada) {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("select * from 
                                      habitaciones as h 
                                     where h.id not in(
                                        select hr.id_habitacion 
                                            from reservas as v inner join habitaciones_reservas as hr 
                                                on v.num_reserva=hr.num_reserva 
                                                    where v.num_reserva like hr.num_reserva 
                                                       and :fecha_salida >= v.fecha_entrada 
                                                         and :fecha_entrada<= v.fecha_salida    
                                                            )");
        $sentencia->bindParam(":fecha_salida", $fecha_salida);
        $sentencia->bindParam(":fecha_entrada", $fecha_entrada);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll();
        return $resultados;
        $sentencia = null;
        $base = null;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

function devolver_imagenes_por_tipo($tipo) {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT * FROM  tipo_habitaciones INNER JOIN imagenes_habitaciones  ON tipo_habitaciones.id=imagenes_habitaciones.id_tipo_habitacion WHERE tipo_habitaciones.tipo_de_habitacion=:tipo ");
        $sentencia->bindParam(":tipo", $tipo);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll();
        return $resultados;
        $sentencia = null;
        $base = null;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

function ver_servicios_tipo($tipo) {
    try {
        $base = conectar('admin');
        $sentencia = $base->prepare("SELECT * FROM servicios as s INNER JOIN habitacion_servicio as h ON s.id=h.id_servicio WHERE h.tipo_habitacion =:tipo");
        $sentencia->bindParam(":tipo", $tipo);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll();
        return $resultados;
        $sentencia = null;
        $base = null;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}
