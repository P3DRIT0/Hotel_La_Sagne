<?php
require_once './BD_habitaciones.php';
$lista_tipos = lista_tipos_habitaciones();
?>
<html>
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
        <title>Modificar habitacion</title>
    </head>
    <body>
        <div id="caja" class="col-10">
            <h3>Modificar tipo de habitación</h3>
            <div class="col-10" id="formulario">
                <form action='./Modificar_tipo.php' method='post'> 
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Modificar</th>
                                <th scope="col">Tipo de habitación</th>
                                <th scope="col">Numero</th>
                                <th scope="col">m2</th>
                                <th scope="col">Ventana</th>
                                <th scope="col">Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($lista_tipos)) {
                                for ($i = 0; $i < count($lista_tipos); $i++) {
                                    $id = $lista_tipos[$i]['id'];
                                    $m2 = $lista_tipos[$i]['m2'];
                                    $ventana = $lista_tipos[$i]['ventana'];
                                    $tipo = $lista_tipos[$i]['tipo_de_habitacion'];
                                    $servicio_limpieza = $lista_tipos[$i]['servicio_limpieza'];
                                    $internet = $lista_tipos[$i]['internet'];
                                    $precio = $lista_tipos[$i]['precio'];

                                    echo "<tr><th scope='row'>$i</th>";
                                    if (isset($_POST["tipo_habitacion"])) {
                                        if ($_POST["tipo_habitacion"] == $i) {
                                            echo "<td><input type='radio' name='tipo_habitacion' value='$i' checked </td>";
                                        } else {
                                            echo "<td><input type='radio' name='tipo_habitacion' value='$i' </td>";
                                        }
                                    } else {
                                        echo "<td><input type='radio' name='tipo_habitacion' value='$i' </td>";
                                    }

                                    echo "<td>$tipo</td><td>$id</td><td>$m2</td><td>$ventana</td><td>$precio €</td></tr>";
                                }
                                echo '</tbody></table>';
                            } else {
                                echo '</tbody></table>';
                                echo "<p style='color:gray;text-align: center'>No existen tipos de habitaciones que borrar";
                            }
                            ?>

                        <input id="boton" type='submit' name='modificar' value='Modificar'/>
                        <input id="boton" type="button" class="btnRegister"  value="Atras" onclick="location = 'Reservas_habitaciones.php'"/> 
                </form>
<!--                <p style='visibility:<?php echo $visibilidad ?>;color:red;text-align: center'> Ninguna habitación seleccionada </p>-->

                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['modificar'])) {
                        $tipo_seleccionado = $_POST['tipo_habitacion'];
                        $m2 = $lista_tipos[$tipo_seleccionado]['m2'];
                        $tipo = $lista_tipos[$tipo_seleccionado]['tipo_de_habitacion'];
                        $precio = $lista_tipos[$tipo_seleccionado]['precio'];
                        echo "<form action='./Procesar_modificaciones.php' method='post'>
                    <table class='table table-striped table-dark text-light'>
                        <thead class='thead-light'>
                            <tr>
                                <th scope='col'>#</th>
                                <th scope='col'>Tipo de habitación</th>
                                <th scope='col'>Numero</th>
                                <th scope='col'>m2</th>
                                <th scope='col'>Ventana</th>
                                <th scope='col'>Precio</th>
                            </tr>
                        </thead>
                        <tr><th scope='row'>#</th><td>$tipo</td><td>$id</td><td><input type='text' name='metros' value=$m2></td>";


                        echo "<input type='hidden' name='id' value='$id'>";


                        if ($lista_tipos[$tipo_seleccionado]['ventana'] == 1) {
                            echo "<td><input type='checkbox' name='ventana' value='true' checked ></td>";
                        } else {
                            echo "<td><input type='checkbox' name='ventana' value='true'></td>";
                        }
                        echo "<td><input type='text' name='precios' value=$precio> €</td></tr>";
                        echo '</tbody></table>';
                        echo "<input type='submit' value='Guardar' name='guardar'>";
                        echo "</form>";
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>