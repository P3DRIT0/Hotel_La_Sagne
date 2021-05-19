
<?php
require_once './BD_habitaciones.php';
/* 
 * Metodo para modificar las habitaciones 
 */
$visibilidad="hidden";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if(isset($_POST['habitacion'])){
    $habitacion_seleccionada=$_POST['habitacion'];
    $nuevo_tipo=$_POST['tipo_habitacion'.$habitacion_seleccionada];
    modificar_habitacion($habitacion_seleccionada, $nuevo_tipo);

    
}else{
  
$visibilidad="visible";
}
}


$resultados = lista_habitaciones();
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
        <title>Modificar habitacion</title>
    </head>
    <body>
        <div id="caja" class="col-6">
            <h3>Modificar habitación</h3>
            <div class="col-10" id="formulario">
                <form action='./Modificar_Habitacion.php' method='post'> 
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Modificar</th>
                                <th scope="col">Id</th>
                                <th scope="col">Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             $tipos = ver_tipos_existentes();
                            if (!empty($resultados)) {
                               
                                
                                for ($index = 0; $index < count($resultados); $index++) {
                                    $id = $resultados[$index]['id'];
                                    $tipo_habitacion = $resultados[$index]['tipo_habitacion'];
                                    echo "<tr><th scope='row'>$index</th><td><input type='radio' name='habitacion' value='$id'</td><td>$id</td><td>";
                                    echo "<select  class='col-11 pt-2' name='tipo_habitacion$id'>";
                                    
                                    for ($index1 = 0; $index1 < count($tipos); $index1++) {
                                       
                                echo "<option>" . $tipos[$index1][0] . "</option>";
                }
                
                                echo "<option selected>".$tipo_habitacion."</option></td></tr>";
                               
                                }
                            } else {
                                echo "<p style='color:gray;text-align: center'>No hay habitaciones para borrar</p>";
                                
                            }
                             
                            ?>
                        </tbody>
                    </table>
                    <input id="boton" type='submit' name='seleccionar' value='Modificar'/>
                    <input id="boton" type="button" class="btnRegister"  value="Atras" onclick="location = 'Reservas_habitaciones.php'"/> 
                </form>
                <p style='visibility:<?php echo $visibilidad?>;color:red;text-align: center '> Ninguna habitación seleccionada </p>"
            </div>
        </div>
    </body>
</html>