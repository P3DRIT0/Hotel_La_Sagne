<?php
require_once './BD_habitaciones.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 if (isset($_POST['nombre']) && isset($_POST['tipo_habitacion']) && isset($_POST['precio']) && isset($_POST['m2'])&& isset($_POST['descripcion'])&& (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0)) {
    $nombre = $_POST['nombre'];
    $tipo_habitacion = $_POST['tipo_habitacion'];
    $precio = $_POST['precio'];
    $m2 = $_POST['m2'];
    $descripcion=$_POST['descripcion'];
    $file_tmp_name = $_FILES["file"]["tmp_name"]; 
    $file_name="../Reservas/Imagenes_habitaciones/". $_FILES["file"]["name"]; 
    copy($file_tmp_name ,$file_name);
    
    
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
    crear_habitacion($m2, $ventana, $tipo_habitacion, $limpieza, $internet, $precio,$file_name,$descripcion);
    añadir_imagenes($file_name,$descripcion);
    header('Location:./Reservas_habitaciones.php');
}
}
?>
<!doctype html>
<html lang="en"> 

    <head>
        <link href="./crear_habitacion.css" rel="stylesheet" type="text/css">
    </head>
    <body>   
        <h1>Crear habitacion</h1>
        <div class="row">
            <div class="col-sm-5 col-xs-12">
                <form action="../Reservas/Crear_habitacion.php"  method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <lable for="subject">Nombre habitacion：</lable>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" required />
                    </div>
                    <div>
                        Tipo de habitacion
                        <select name="tipo_habitacion">
                            <option>Suite</option>
                            <option>Habitacion Doble</option>
                            <option selected>Habitacion Individual:</option>
                        </select>
                    </div>
                    <lable for="subject">Precio de la habitacion：</lable>
                    <input type="number" id="Precio"  name="precio" class="form-control" placeholder="Precio" required /><br>
                    <lable for="subject" >Metros cuadrados：</lable>
                    <input type="number"  name="m2" id="m2" class="form-control" placeholder="m2" required />
                    <div>

                        <label><input type="checkbox"  name="ventana" id="cbox1" value="1_checkbox"> Ventana</label><br>
                        <input type="checkbox" id="cbox2" name="internet"  value="2_checkbox"> Internet</label><br>
                        <input type="checkbox" id="cbox3"  name="limpieza" value="3_checkbox">Servicio de limpieza <label for="cbox3">
                        </label>
                    </div>
                    <div class="col-sm-7 col-xs-12">
                        <textarea id="result" name="descripcion" placeholder="Breve descripcion de la habitacion"></textarea>
                    </div>
                    <input type="file" name="file"><br>
                    <input type="submit" class="btnRegister"  value="Crear habitacion"/>                 
                </form>
            </div>
        </div>
    </body>
</html>