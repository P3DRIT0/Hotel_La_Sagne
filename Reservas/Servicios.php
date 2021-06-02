<?php
require_once 'BD_habitaciones.php';

$lista_tipos_habitaciones = lista_tipos_habitaciones();
$lista_servicios = lista_servicios();
$selector_tipo_habita;
$count = 0;


$nombre_servicio = "";
$precio = "";
$descripcion = "";

if (isset($_POST["añadir"])) {
    $nombre_servicio = ucfirst(strtolower($_POST["nombre"]));
    $precio = $_POST["precio"];
    $descripcion = $_POST["descripcion"];
    echo 'Pulsando añadir <br>';
    if (!empty($nombre_servicio) && !empty($precio) && !empty($descripcion)) {
        if (!servicio_comprobar($lista_servicios, $nombre_servicio)) {
            servicio_nuevo($nombre_servicio, $precio, $descripcion);
            echo 'Guardando <br>';
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
    $servicios_a_borrar;
    for ($i = 0; $i < count($lista_servicios[0]); $i++) {
        if (!empty($_POST["servicio$i"])) {
            $servicios_a_borrar[] = $lista_servicios[0][$i]["id"];
        }
    }
    //    print_r($servicios_a_borrar);
    servicio_borrar($servicios_a_borrar);
    echo 'pulsando borrar';
    header('Location:Servicios.php');
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Servicios</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
        <link rel="stylesheet" href="formularios.css" />
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 style="text-align: center; margin-top: 60px">Administrar servicios</h1>
                </div>
            </div>
            <div class="row mt-5">

                <div class="col bg-danger px-5 pt-2 pb-5">
                    <h3 style="text-align: center">Servicios disponibles</h3>
                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                        <table class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Servicio</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Borrar</th>
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
                                        echo "<tr><th scope='row'>$i</th><td>$nombre_s</td><td>$precio_s</td><td>$descripcion_s</td><td><input type='checkbox'" . $i-- . " name='servicio$i'</td></tr>";
                                    }
                                } else {
                                    echo "<p style='color:gray;text-align: center'>No hay servicio para borrar</p>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <input class="btnRegister" type="submit" value="Borrar Servicio" name="borrar" />
                        <input class="btnRegister" type="submit" value="Añadir al tipo" name="borrar" />
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-4 bg-warning px-5 pb-5 pt-2">
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
                        <input class="btnRegister" type="submit" value="Añadir" name="añadir" />
                        <input class="btnRegister" type="button" value="Atras" onclick="location = 'Reservas_habitaciones.php'" />
                    </form>
                </div>
                <div class="col-8 bg-info">
                    <div class="row">
                        <div class="col-4 m-5">

                            <select class="form-select" aria-label="Default select example" name="selector_tipo_habitacion" id="selector_tipo_habitacion">
                                <option selected>Selecciona un tipo de habitación</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>

                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Servicio</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Borrar</th>
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
                                    echo "<tr><th scope='row'>$i</th><td>$nombre_s</td><td>$precio_s</td><td>$descripcion_s</td><td><input type='checkbox'" . $i-- . " name='servicio$i'</td></tr>";
                                }
                            } else {
                                echo "<p style='color:gray;text-align: center'>No hay servicio para borrar</p>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <input class="btnRegister" type="submit" value="Eliminar Servicio" name="borrarDelTipo" id="eli"/>
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
                                $("#selector_tipo_habitacion").on("change",function () {
                                    console.log("<?php
                            
                            echo $count;
                            ?>");
                                })
                                $("#eli").on("click", function () {
                                    <?php
                            $count++;
                            echo $count;
                            ?>




//                                    location = 'Servicios.php';
                                });
                            });
//        onchange = "location = 'Servicios.php'"
    </script>
    <!-- Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <!--Jquery-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

</html>