<?php
require_once './BD_habitaciones.php';
$lista_tipos_habitaciones = lista_tipos_habitaciones();
$tipos_habitaciones_a_borrar;
$id_tipo;
for ($index1 = 0; $index1 < count($lista_tipos_habitaciones); $index1++) {
    $habitaciones = "habitacion$index1";
    if (isset($_POST[$habitaciones])) {
        $tipos_habitaciones_a_borrar[] = $lista_tipos_habitaciones[$index1]['tipo_de_habitacion'];
        $id_tipo[] = $lista_tipos_habitaciones[$index1]['id'];
    }
}
if (!empty($tipos_habitaciones_a_borrar)) {

    for ($i = 0; $i < count($tipos_habitaciones_a_borrar); $i++) {
        $consulta = consultar_reservas_por_tipo($tipos_habitaciones_a_borrar[$i]);
        if (empty($consulta)) {
            echo 'Borrando';
            borrar_tipo_habitaciones($tipos_habitaciones_a_borrar[$i], $id_tipo[$i]);
            header('Location:Borrar_tipo_habitacion.php');
        } else {
            echo "<div class='wrapper red' style='height:450px'>
                                 <div class='header__wrapper'>
                                 <div class='header'>
                                 <div class='sign'><span></span></div>
                                  </div>
                                  </div>
                                  <h1 style='padding-top: 30px;'>Opps</h1>
                                  <p>La habitaciones de tipo $tipos_habitaciones_a_borrar[$i] no se pueden borrar ya que existen habitaciones de este tipo con reservas vigentes</p>";
            echo '<script>
    console.log(document.getElementById("caja"))
    </script>';
            
            ?>
            <button onclick="location = '../Reservas/Reservas_habitaciones.php'">Ver otras habitaciones </button>
            <?php
            echo '</div>';
        }
    }
}

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
        <LINK REL=StyleSheet HREF="../Habitacion/Botones_estilo.css" TYPE="text/css" MEDIA=screen>
        <title>Borrar habitacion</title>
    </head>
    <body>
        <div id="caja" class="col-6">
            <h3>Borrar tipo de habitación</h3>
            <div class="col-10" id="formulario">
                <form action='./Borrar_tipo_habitacion.php' method='post'> 
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
                            if (!empty($lista_tipos_habitaciones)) {
                                for ($index = 0; $index < count($lista_tipos_habitaciones); $index++) {
                                    $id = $lista_tipos_habitaciones[$index]['id'];
                                    $tipo_habitacion = $lista_tipos_habitaciones[$index]['tipo_de_habitacion'];
                                    echo "<tr><th scope='row'>$index</th><td><input type='checkbox' name='habitacion$index'</td><td>$id</td><td>$tipo_habitacion</td></tr>";
                                }
                            } else {
                                echo "<p style='color:gray;text-align: center'>No hay habitaciones para borrar</p>";
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
    
    <script>
  función getStyle(visibilidad){
. document.getElementById ("caja") style.visibility = visibilidad;
} 
    
    </script>
</html>

