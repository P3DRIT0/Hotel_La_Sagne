<?php
require_once './BD_habitaciones.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "llega hasta aqui";
    if (isset($_POST['nombre'])&& isset($_POST['precio']) && isset($_POST['m2']) && isset($_POST['descripcion']) && (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0)) {
   echo "entra";
        $tipo_habitacion = $_POST['nombre'];
        $precio = $_POST['precio'];
        $m2 = $_POST['m2'];
        $descripcion = $_POST['descripcion'];
        $file_tmp_name = $_FILES["file"]["tmp_name"];
        $file_name = "../Reservas/Imagenes_habitaciones/" . $_FILES["file"]["name"];
        copy($file_tmp_name, $file_name);


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
        añadir_imagenes($file_name,$tipo_habitacion);
        header('Location:./Reservas_habitaciones.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
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
                    <div class="col-sm-7 col-xs-12">
                        <form action="../Reservas/Crear_tipo.php"  method="post" enctype="multipart/form-data">
                            <div class="form-group m-2">
                                <lable for="subject">Nombre del nuevo tipo：</lable>
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
                                <input type="checkbox" id="cbox3"  name="limpieza" value="3_checkbox">Servicio de limpieza <label for="cbox3">
                                </label>
                            </div>
                            <div class="col-12 pt-3">
                                <textarea id="result" name="descripcion" placeholder="Breve descripcion de la habitacion"></textarea>
                            </div>
                            <input type="file" name="file"><br>
                            <input id="boton" type="submit" class="btnRegister"  value="Crear nuevo tipo"/>  
                            <input id="boton" type="button" class="btnRegister"  value="Atras" onclick="location= 'Reservas_habitaciones.php'"/> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>