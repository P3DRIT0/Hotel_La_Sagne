<?php
require_once 'BD_habitaciones.php';

$lista_tipos_habitaciones = lista_tipos_habitaciones();
$lista_servicios = lista_servicios();
$selector_tipo_habita;
$tipo_habitacion_seleccionada;




$count = 0;

$nombre_servicio = "";
$precio = "";
$descripcion = "";

if (isset($_POST["añadir"])) {
    $nombre_servicio = ucfirst(strtolower($_POST["nombre"]));
    $precio = $_POST["precio"];
    $descripcion = $_POST["descripcion"];
    if (!empty($nombre_servicio) && !empty($precio) && !empty($descripcion)) {
        if (!servicio_comprobar($lista_servicios, $nombre_servicio)) {
            servicio_nuevo($nombre_servicio, $precio, $descripcion);
            header('Location:Servicios.php');
        } else {
            echo '<script type="text/javascript">
            alert("Este servicio ya existe");
             window.location.href="Servicios.php";
             </script>';
        }
    } else {
        echo 'Faltan datos';
    }
}
if (isset($_POST["borrar"])) {
    echo 'pulsando borrar';
    $servicios_a_borrar = servicios_seleccionados($lista_servicios, "serviciototal");
    servicio_borrar($servicios_a_borrar);

    header('Location:Servicios.php');
}

if (isset($_POST['selector_tipo_habitacion_2'])) {
    $tipo_habitacion_seleccionada = $_POST['selector_tipo_habitacion_2'];
    if (!empty($tipo_habitacion_seleccionada)) {
        $lista_servicios_tipo_habitacion_selec = lista_servicios_tipo_habitacion($tipo_habitacion_seleccionada);
        if (isset($_POST["borrarDelTipo"])) {
            $servicios_a_borrar_del_tipo = servicios_seleccionados($lista_servicios_tipo_habitacion_selec, "servicioconcreto");
            borrar_servicio_tipo_habitacion($tipo_habitacion_seleccionada, $servicios_a_borrar_del_tipo);
            $lista_servicios_tipo_habitacion_selec = lista_servicios_tipo_habitacion($tipo_habitacion_seleccionada);
        }
    }
}




if (isset($_POST["añadir_a_tipo"])) {
    $tipo = $_POST["selector_tipo_habitacion"];
    $servicios_a_añadir = servicios_seleccionados($lista_servicios, "serviciototal");
    insertar_en_servicios_habitaciones($tipo, $servicios_a_añadir);
}

/**
 * Método que recorre la lista y comprueba los checkboxes seleccionados 
 * 
 * @param array $lista Array de tres dimensiones
 * @param string $id id de la etiqueta html
 * @return array Array con los datos seleccionados
 */
function servicios_seleccionados($lista, $id) {

    for ($i = 0; $i < count($lista[0]); $i++) {
        if (isset($_POST[$id . "" . $i])) {
            $seleccionados[] = $lista[0][$i]["id"];
        }
    }
    return $seleccionados;
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
          <link rel="apple-touch-icon" sizes="57x57" href="../config/ico/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../config/ico/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../config/ico/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../config/ico/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../config/ico/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../config/ico/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../config/ico/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../config/ico/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../config/ico/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../config/ico/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../config/ico/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../config/ico/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../config/ico/favicon-16x16.png">
    <link rel="manifest" href="../config/ico//manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../config/ico/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Servicios</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
        <link rel="stylesheet" href="formularios.css" />
    </head>

    <body>
        <div class="container">

            <!--            <div class="row">
                            <div class="col">
                                <h1 style="text-align: center; margin-top: 60px">Administrar servicios</h1>
                            </div>
                        </div>-->
            <div class="row mt-5">

                <div class="col px-5 py-3 bg-dark text-light" >
                    <h3 style="text-align: center">Servicios disponibles</h3>

                    <form action="" method="post">
                        <table class="table table-striped table-dark ">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Servicio</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Seleccionar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($lista_servicios[0])) {
                                    for ($i = 0; $i < count($lista_servicios[0]); $i++) {
                                        $id = $lista_servicios[0][$i]['id'];
                                        $nombre_s = $lista_servicios[0][$i]["nombre_servicio"];
                                        $precio_s = $lista_servicios[0][$i]["precio_servicio"];
                                        $descripcion_s = $lista_servicios[0][$i]["descripcion"];
                                        $i++;
                                        echo "<tr><th scope='row'>$i</th><td>$nombre_s</td><td>$precio_s</td><td>$descripcion_s</td><td><input type='checkbox'" . $i-- . " name='serviciototal$i'</td></tr>";
                                    }
                                } else {
                                    echo '</tbody>
                        </table>';
                                    echo "<p style='color:gray;text-align: center'>No existen servicios en la base de datos, inserte uno en el cuadro de abajo</p>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col d-flex">


                                <input class="btn btn-secondary btn-sm px-4 mx-3 btnRegister" type="submit" value="Borrar Servicio" name="borrar" />

                                <input class="btn btn-secondary btn-sm px-4 ms-3 btnRegister" type="submit" value="Añadir al tipo" name="añadir_a_tipo" />
                                <div class="col-2 mx-2">

                                    <select class="form-select" aria-label="Default select example" name="selector_tipo_habitacion">
                                        <option selected>Selecciona un tipo de habitación</option>
                                        <?php
                                        for ($i = 0; $i < count($lista_tipos_habitaciones); $i++) {
                                            $tipo = $lista_tipos_habitaciones[$i]["tipo_de_habitacion"];
                                            echo "<option value='$tipo' id='option$tipo'>$tipo</option>";
                                        }
                                        ?>
                                    </select>


                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-4 px-5 py-2">
                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                        <h3 style="text-align: center">Añadir servicio</h3>
                        <div>
                            <lable for="subject">Nombre del servicio：</lable>
                            <input type="text" id="nombre" name="nombre" class="form-control"><br />
                        </div>
                        <div>
                            <lable for="subject">Precio del servicio：</lable>
                            <input type="number" id="precio" name="precio" class="form-control"><br />
                        </div>
                        <div>
                            <lable for="subject">Descripción del servicio：</lable>
                            <input type="text" id="descripcion" name="descripcion" class="form-control"><br />
                        </div>

                        <input class="btn btn-secondary btn-sm px-4 mx-2 btnRegister" type="submit" value="Añadir" name="añadir" />
                        <input class="btn btn-secondary btn-sm px-4 mx-2 btnRegister" type="button" value="Atras" onclick="location = 'Reservas_habitaciones.php'" />
                    </form>
                </div>
                <div class="col-8 my-3 px-5 bg-dark text-light">
                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" id="formulario">
                        <div class="row">
                            <div class="col-8 pl-5 py-5"><h4 style="text-align: end">Servicios disponibles para el tipo de habitación</h3></div>
                            <div class="col-3 py-5">


                                <select class="form-select" aria-label="Default select example" name="selector_tipo_habitacion_2" id="selector_tipo_habitacion_2">
                                    <option selected><?php
                                        if (isset($tipo_habitacion_seleccionada)) {
                                            echo $tipo_habitacion_seleccionada;
                                        } else {
                                            echo"Selecciona un tipo de habitación";
                                        }
                                        ?></option>
                                    <?php
                                    for ($i = 0; $i < count($lista_tipos_habitaciones); $i++) {
                                        $tipo = $lista_tipos_habitaciones[$i]["tipo_de_habitacion"];
                                        echo "<option value='$tipo' id='option$tipo'>$tipo</option>";
                                    }
                                    ?>
                                </select>


                            </div>
                        </div>
                        <table class="table table-striped table-dark">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Servicio</th>
                                    <th scope="col">Borrar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($lista_servicios_tipo_habitacion_selec[0])) {
                                    for ($i = 0; $i < count($lista_servicios_tipo_habitacion_selec[0]); $i++) {
                                        $id = $lista_servicios_tipo_habitacion_selec[0][$i]['id'];
                                        $nombre_s = $lista_servicios_tipo_habitacion_selec[0][$i]["nombre_servicio"];
                                        $i++;
                                        echo "<tr><th scope='row'>$i</th><td>$nombre_s</td><td><input type='checkbox'" . $i-- . " name='servicioconcreto$i'</td></tr>";
                                    }
                                } else {
                                    echo '</tbody>
                        </table>';
                                    echo "<p style='color:gray;text-align: center'>No hay servicios disponibles para el tipo de habitacion seleccionado, incluye alguno de la tabla de arriba</p>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <input class="btn btn-secondary btn-sm px-4 mx-3 btnRegister" type="submit" value="Eliminar Servicio" name="borrarDelTipo" id="eli"/>
                    </form>
                </div>
            </div>

        </div>
    </body>
    <script
        src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"
    ></script>
    <script>
                            $(document).ready(function () {
                                $("#selector_tipo_habitacion_2").on("change", function () {
                                    $("#formulario").submit();
                                });
                                $("#eli").on("click", function () {
                                    $("#formulario").submit();
                                });
                            });
    </script>
    <!-- Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <!--Jquery-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

</html>