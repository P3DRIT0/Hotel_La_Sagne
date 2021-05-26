<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once './BD_habitaciones.php';

$tipos = ver_tipos_existentes();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['tipo_habitacion'])) {
        $tipo = $_POST['tipo_habitacion'];
        crear_habitacion($tipo);
    }
}
?>
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
        <link rel="stylesheet" href="formularios.css" />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
            crossorigin="anonymous"
            />
    </head>
    <title>Crear habitacion</title>
    <div id="caja" class="col-6">
        <h3>Crear habitaciones</h3>
        <form id="formulario" class="col-10" action="../Reservas/Crear_Habitacion.php"  method="post" enctype="multipart/form-data">
            <select  class="col-11 pt-2" name="tipo_habitacion">
                <?php
                for ($index = 0; $index < count($tipos); $index++) {
                    echo "<option>" . $tipos[$index][0] . "</option>";
                }
                ?>
            </select>
            <input id="boton" type="submit" class="btnRegister"  value="Crear Habitacion"/>   
            <input id="boton" type="button" class="btnRegister"  value="Atras" onclick="location = 'Reservas_habitaciones.php'"/>    



            <?php
            echo "<table class='table table-striped'>";
            echo '<thead class="thead-light">';
            echo " <tr>";
            echo '  <th scope="col">Id</th>';
            echo '  <th scope="col">Tipo_habitacion</th>';
            echo "</tr>";
            echo '  </thead>';
            echo '   <tbody>';
            $habitaciones = listar_habitaciones();
            if (!empty($habitaciones)) {
                for ($index1 = 0; $index1 < count($habitaciones); $index1++) {
                    $id = $habitaciones[$index1][0];
                    $tipo = $habitaciones[$index1][1];

                    echo "<tr>";
                    echo "<td scope='row'>$id</td>";
                    echo "<td scope='row'>$tipo</td>";
                    echo "</tr>";
                }
            } else {
                echo "<p style='color:gray;text-align: center'>No hay habitaciones introducidas</p>";
            }
            ?>
            </tbody>
            </table>
        </form>

    </div>
</html>