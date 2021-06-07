<?php
session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once './BD_habitaciones.php';
require_once '../Perfil/Bd_Perfil.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['fecha_entrada']) && isset($_POST['fecha_salida'])) {
        $fecha_entrada = $_POST['fecha_entrada'];
        $fecha_salida = $_POST['fecha_salida'];
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
        <title>Reservas</title>

        <!-- CSS -->
        <link rel='stylesheet' type='text/css' media='screen' href='./estilos_tipos_habitaciones.css'>
        <link href="../Pagina_principal/accesibilidad.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />

        <!--Fuentes -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Montserrat&display=swap" rel="stylesheet">

    </head>
    <div class="filtro" style="width: 100%; filter: none">

        <header>
            <nav class="navbar-expand-md navbar-dark fixed-top bg-dark">
                <div class="container-fluid">
                    <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarColor01 ">

                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item">
                                <a class="nav-link" href="../Pagina_principal/Pagina_principal.php#habitaciones">Habitaciones</a>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../Pagina_principal/Pagina_principal.php#Actividades">Explora</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../Pagina_principal/Pagina_principal.php#Sobre_nosotros">Sobre Nosotros</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav me-auto mb-2  mb-lg-0" style="margin-right: 30%">
                            <div>
                                <a class="titulo" href="../Pagina_principal/Pagina_principal.php">Hotel La Sagne </a>
                                </form>
                            </div>
                    </div>
            </nav>
        </header>
        <body>
            <div class="divhabitaciones" style="display: flex;justify-content: center;padding-top: 5%" >
                <div class="datoshabitaciones">
                    <div class="container">
                        <?php
                        $id_habitaciones = consultar_id_reservas($fecha_salida, $fecha_entrada);
                        $tipos_diferentes;
                        for ($index3 = 0; $index3 < count($id_habitaciones); $index3++) {
                            $tipos_diferentes[] = $id_habitaciones[$index3][1];
                        }
                        $contar_habitaciones_tipo = (array_count_values($tipos_diferentes));
                        print_r($contar_habitaciones_tipo);
                        $separado_por_comas = implode(",", $tipos_diferentes);

                        $tipos_diferentes = implode(',', array_unique(explode(',', $separado_por_comas)));
                        $array_tipos_diferentes = explode(",", $tipos_diferentes);
                        $index1 = 0;
                        $index2 = 0;
                        $titulo = 0;
                        $id = 1;

                        for ($index = 0; $index < count($array_tipos_diferentes); $index++) {
                            $tipos = devolver_imagenes_por_tipo($array_tipos_diferentes[$index]);
                            $habitacioncliacada;
                            ?>

                            <div class='row habitacion2 my-3 border border-1 rounded' id="tipo"<?php
                            echo $tipos[0][3];
                            $tipo_seleccionado = $tipos[0][3]
                            ?> >
                                <div class="col-4 p-2">
                                    <img src="<?php echo $tipos[0][10] ?>" style="width: 100%;height: 100%; margin:0px; padding: 0px">
                                </div>
                                <div class="col-4 p-2">
                                    <div class="row texto" style="height: 80%" id="tipo<?php echo $id ?>" value='<?php echo $tipos[0][3] ?>'>
                                        <h1 class="titulo"><?php echo $tipos[0][3]; ?></h1>

                                        <p><?php echo $tipos[0][7]; ?></p>


                                    </div>
                                    <div class="row" style="height: 10%;">
                                        <p class='cantidad'>Habitaciones disponibles :<?php echo $contar_habitaciones_tipo[$tipo_seleccionado]; ?></p>
                                    </div>
                                </div>

                                <div class=" texto2 col-4 p-2 bg-dark text-light" style="height:315px">
                                    <h3 style="text-align: center">Servicios disponibles</h3>

                                    <table class="table table-striped table-dark">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Servicio</th>
                                                <th scope="col">Precio</th>
                                                <th scope="col">Descripción</th>
                                                <th scope="col">Seleccionar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $lista_servicios = ver_servicios_tipo($tipo_seleccionado);
                                            if (!empty($lista_servicios[0])) {
                                                for ($i = 0; $i < count($lista_servicios); $i++) {
                                                    $nombre_s = $lista_servicios[$i]["nombre_servicio"];
                                                    $precio_s = $lista_servicios[$i]["precio_servicio"];
                                                    $descripcion_s = $lista_servicios[$i]["descripcion"];
                                                    $i++;
                                                    echo "<tr><th scope='row'>$nombre_s</th><td id='$nombre_s'>$precio_s" . "€</td><td>$descripcion_s</td><td><input id='$tipo_seleccionado$i'   onclick='sumar_precio($tipo_seleccionado$i,texto$tipo_seleccionado)' value='$precio_s' type='checkbox'; " . $i-- . " name='serviciototal$i'</td></tr>";
                                                }
                                            } else {

                                                echo "<p style='color:gray;text-align: center'>No existen servicios en la base de datos</p>";
                                            }
                                            ?>
                                        </tbody> </table>

                                    <p class='precio align-self-end' id="<?php echo 'texto' . $tipo_seleccionado; ?>"><?php echo $tipos[0]['precio'] . "€"; ?></p>
                                </div>
                            </div>

                            <?php
                            $index2++;
                            $titulo = $titulo + 3;
                            $id++;
                        }
                        ?>
                    </div>
                </div>
            </div>



        </body>
        <!---------------------------------------------------->
        <!------------------ Complementos -------------------->
        <!---------------------------------------------------->

        <div class="contenedor_accesibilidad">
            <div class="boton-accesibilidad">
                <div class="perrete">
                    <img
                        src="../Pagina_principal/Multimedia/logo.png"
                        alt=""
                        width="100%"
                        />
                </div>
            </div>
            <div class="accesibilidad">
                <h5
                    style="
                    text-align: center;
                    padding-top: 10px;
                    border-bottom: solid black 2px;
                    "
                    >
                    Accesibilidad
                </h5>
                <ul style="display: flex; flex-direction: column; align-items: center">
                    <input
                        value="Invertido"
                        type="button"
                        name=""
                        id="btn_color1"
                        style="margin: 10px; width: 60%"
                        /><input
                        value="Sepia"
                        type="button"
                        name=""
                        id="btn_color2"
                        style="margin: 10px; width: 60%"
                        />
                    <input
                        value="Saturado"
                        type="button"
                        name=""
                        id="btn_color3"
                        style="margin: 10px; width: 60%"
                        />
                    <input
                        value="Sin filtro"
                        type="button"
                        name=""
                        id="btn_color4"
                        style="margin: 10px; width: 60%"
                        />
                </ul>
            </div>
        </div>
        <script
            src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"
        ></script>
        <script>
            $(document).ready(function () {
                $(".filtro").css("filter", "none");

                $(".perrete").on("click", function () {
                    console.log("en accesibilidad");
                    $(".contenedor_accesibilidad").toggleClass("mostrar");
                });
                $("#btn_color1").on("click", function () {
                    $(".filtro").css("filter", "invert()");
                });
                $("#btn_color2").on("click", function () {
                    console.log("colorendo de azul");
                    $(".filtro").css("filter", "sepia(100%)");
                });
                $("#btn_color3").on("click", function () {
                    $(".filtro").css("filter", "saturate(200%)");
                });
                $("#btn_color4").on("click", function () {
                    $(".filtro").css("filter", "none");
                });
            });
        </script>


        <!-- Separate Popper and Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
        <!--Jquery-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <script src="../config/jquery-3.6.0.min.js" type="text/javascript"></script>
        <script>
            function sumar_precio(id, tipo) {

                console.log(document.getElementById(tipo.id).value);
                var precio = parseFloat(id.value);
                var precio_total = parseFloat(tipo.innerHTML);
                if (id.checked) {
                    tipo.innerHTML = precio_total + precio + "€";
                } else {
                    tipo.innerHTML = precio_total - precio + "€";
                }

            }

        </script>
</html>