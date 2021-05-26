<?php
require_once './BD_habitaciones.php';

$error_tipo_existente = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['m2']) && isset($_POST['descripcion'])) {
        $tipo_habitacion = ucfirst($_POST['nombre']);
        $existe = comprobar_tipo($tipo_habitacion);
        if (empty($existe)) {
            $precio = $_POST['precio'];
            $m2 = $_POST['m2'];
            $descripcion = $_POST['descripcion'];

            if (isset($_POST['ventana'])) {
                $ventana = true;
            } else {
                $ventana = false;
            }

            if (isset($_POST['internet'])) {
                $internet = true;
            } else {
                $internet = false;
            }
            if (isset($_POST['limpieza'])) {
                $limpieza = true;
            } else {
                $limpieza = false;
            }

            crear_tipo_habitacion($m2, $ventana, $tipo_habitacion, $limpieza, $internet, $precio, $descripcion);
            $numero = asignar_nombres() * 5;
            $rutas = array();
//Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
            foreach ($_FILES["archivo"]['tmp_name'] as $key => $tmp_name) {
//Validamos que el archivo exista
                if ($_FILES["archivo"]["name"][$key]) {

                    $numero++;
                    $filename = $numero . ".jpg"; //Obtenemos el nombre original del archivo

                    print_r($filename);
                    $source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
                    $directorio = '../Reservas/Imagenes_habitaciones'; //Declaramos un  variable con la ruta donde guardaremos los archivos
//Validamos si la ruta de destino existe, en caso de no existir la creamos
                    if (!file_exists($directorio)) {
//0777 son los permisos
                        mkdir($directorio, 0777) or die("No se puede crear el directorio;n");
                    }
                    $dir = opendir($directorio); //Abrimos el directorio de destino
                    $target_path = $directorio . '/' . $filename; //Indicamos la ruta de destino, así como el nombre del archivo
                    $rutas[] = $target_path;
//Movemos y validamos que el archivo se haya cargado correctamente
//El primer campo es el origen y el segundo el destino
                    if (move_uploaded_file($source, $target_path)) {
                        echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
                    } else {
                        echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
                    }
                    closedir($dir); //Cerramos el directorio de destino
                }
            }


            añadir_imagenes($rutas, $tipo_habitacion);
            header('Location:./Reservas_habitaciones.php');
        } else {
            $error_tipo_existente = "El tipo " . $tipo_habitacion . " ya existe en la base de datos";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="apple-touch-icon" sizes="57x57" href="../config/ico/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="../config/ico/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="../config/ico/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="../config/ico/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="../config/ico/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="../config/ico/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="../config/ico/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="../config/ico/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../config/ico/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="../config/ico/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../config/ico/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="../config/ico/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../config/ico/favicon-16x16.png">
        <link rel="manifest" href="../config/ico//manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="../config/ico/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- Bootstrap CSS -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
            crossorigin="anonymous"
            />
        <link rel="stylesheet" href="formularios.css" />
        <title>Crear Tipo Habitacion</title>
    </head>
    <body>   
        <div id="caja" class="col-6">
            <h3>Crear tipo habitacion</h3>
            <div class="col-10" id="formulario">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <form action="../Reservas/Crear_tipo.php"  method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <lable  for="subject">Nombre del nuevo tipo：</lable>
                                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" required />
                            </div>
                            <div class="col-12 pt-3">
                                <lable for="subject">Precio de la habitacion：</lable>
                                <input type="number" id="Precio"  name="precio" class="form-control" placeholder="Precio" required /><br>
                                <lable for="subject" >Metros cuadrados：</lable>
                                <input type="number"  name="m2" id="m2" class="form-control" placeholder="m2" required />
                            </div>
                            <div class="col-12 pt-3">

                                <label><input type="checkbox"  name="ventana" id="cbox1" value="1_checkbox"> Ventana</label><br>
                                <input type="checkbox" id="cbox2" name="internet"  value="2_checkbox"> Internet</label><br>
                                <input type="checkbox" id="cbox3"  name="limpieza" value="3_checkbox"> Servicio de limpieza <label for="cbox3">
                                </label>
                            </div>
                            <div class="col-12 pt-3">
                                <textarea  style="width:100%" id="result" name="descripcion" placeholder="Breve descripcion de la habitacion"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Archivos</label>
                                <a style="color: red"><?php echo $error_tipo_existente ?></a>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" id="archivo[]" name="archivo[]" multiple="">
                                </div>
                                <input id="boton" type="submit" class="btnRegister"  value="Crear nuevo tipo"/>  
                                <input id="boton" type="button" class="btnRegister"  value="Atras" onclick="location = 'Reservas_habitaciones.php'"/> 


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>