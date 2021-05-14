<?php
require_once './BD_habitaciones.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$resultados = lista_habitaciones();
$habitaciones_borrar;
for ($index1 = 0; $index1 < count($resultados); $index1++) {
    $habitaciones = "habitacion$index1";
    if (isset($_POST[$habitaciones])) {
        $habitaciones_borrar[] = $resultados[$index1]['id'];
    }
}
if (!empty($habitaciones_borrar)) {
    borrar_habitaciones($habitaciones_borrar);
}
?>

<html>
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
        <title>Borrar habitacion</title>
    </head>
    <body>
        <div id="caja" class="col-6">
            <h3>Borrar habitación</h3>
            <div class="col-10" id="formulario">
                <form action='./Borrar_habitacion.php' method='post'> 
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Borrar</th>
                                <th scope="col">Id</th>
                                <th scope="col">Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($resultados)) {
                                for ($index = 0; $index < count($resultados); $index++) {
                                    $id = $resultados[$index]['id'];
                                    $tipo_habitacion = $resultados[$index]['tipo_habitacion'];
                                    echo "<tr><th scope='row'>$index</th><td><input type='checkbox' name='habitacion$index'</td><td>$id</td><td>$tipo_habitacion</td></tr>";
                                }
                            } else {
                                echo "No existen habitaciones que borrar";
                            }
                            ?>
                        </tbody>
                    </table>
                    <input id="boton" type='submit' name='borrar' value='Borrar'/>
                    <input id="boton" type="button" class="btnRegister"  value="Atras" onclick="location = 'Reservas_habitaciones.php'"/> 
                </form>
            </div>
        </div>
    </body>
</html>
