
<?php
session_start();
require_once './BD_habitaciones.php';
require_once '../Perfil/Bd_Perfil.php';
?>
<!doctype html>
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
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reservas</title>

        <!-- CSS -->
        <link rel='stylesheet' type='text/css' media='screen' href='./precios_habitaciones.css'>
        <!-- Bootstrap CSS -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
            crossorigin="anonymous"/>

        <!--Fuentes -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Montserrat&display=swap" rel="stylesheet">

    </head>
    <body>
        <nav class="navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                        aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor01 ">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link" href="../Pagina_principal/Pagina_principal.php #habitaciones">Habitaciones</a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Pagina_principal/Pagina_principal.php #Actividades">Explora</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#../Pagina_principal/Pagina_principal.php Sobre_nosotros">Sobre Nosotros</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <div>
                            <a class="titulo" href="../Pagina_principal/Pagina_principal.php">Hotel La Sagne </a>
                        </div>
                    </ul>
                    <form class="d-flex">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <?php if (!empty($_SESSION["usuario"])) { ?>


                                <li class="nav-item dropdown">

                                    <a style=margin-top:10% class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" ><?php echo $_SESSION['usuario'] ?></a>

                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="../Perfil/Perfil.php"> Ver Perfil</a></li>
                                        <li><a class="dropdown-item" href="../Reservas/Reservas_habitaciones.php">Ver Habitaciones </a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="../Perfil/logout.php">Logout</a></li>
                                    </ul>
                                </li>
                                <a href="../Perfil/Perfil.php"><image src="<?php echo cargar_img_perfil($_SESSION["email"]) ?>" href="../Perfil/Perfil.php" width="50" height="50"/></a>
                            <?php } else { ?>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="../Registro/Registro.php">Registro </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../Inicio_Sesion/Inicio_sesion.php">Login</a>
                                </li>

                            <?php } ?>
                        </ul>

                    </form>
                </div>
            </div>


            <div class="barra_busqueda">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarColor01 ">
                        <?php
                        if ($_SESSION['rol'] == "Usuario_administrador") {

                            $visibilidad = "visible";
                        } else {

                            $visibilidad = "hidden";
                        }
                        echo "<ul class='navbar-nav  mb- mb-lg-0' style='visibility: $visibilidad'>";
                        ?>

                        <li class="nav-item" style="margin-top:10px ">
                            <button  class="btn btn-outline-light my-2 my-sm-3" onclick="location = 'Crear_tipo.php'"> Crear tipo 
                        </li>
                        <li class="nav-item" style="margin-top:10px ">
                            <button  class="btn btn-outline-light my-2 my-sm-3" onclick="location = 'Borrar_tipo_habitacion.php'"> Borrar tipo 
                        </li>
                        <li class="nav-item"style="margin-top:10px ">
                            <button  class="btn btn-outline-light my-2 my-sm-3" onclick="location = 'Modificar_tipo.php'"> Modificar Tipo
                        </li>
                        <li class="nav-item"style="margin-top:10px ">
                            <button  class="btn btn-outline-light my-2 my-sm-3" onclick="location = 'Crear_habitacion.php'"> Crear habitacion
                        </li>
                        <li class="nav-item" style="margin-top:10px" >
                            <button  class="btn btn-outline-light my-5 my-sm-3" onclick="location = 'Borrar_habitacion.php'"> Borrar habitacion
                        </li>
                        <li class="nav-item"style="margin-top:10px ">
                            <button  class="btn btn-outline-light my-2 my-sm-3" onclick="location = 'Modificar_Habitacion.php'"> Modificar habitacion
                        </li>



                        </ul>


                        <form class="d-flex" style="width: 65%;margin-left:10% ">

                            <input class="form-control mb-4" type="search" placeholder="Search" aria-label="Search">
                            <button style="padding-bottom :10px " class="btn btn-outline-light mb-4" type="submit" >Buscar</button >
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class='contenedor' >
            <?php
            $tipos = devolver_tipos_imagenes();
            $contar_tipos = contar_tipos();
            echo $contar_tipos;

            $index1 = 0;
            $index2 = 0;
            $titulo = 0;
            $id = 1;

            for ($index = 0; $index < $contar_tipos; $index++) {

//                $numhabitaciones = visualizar_habitaciones();
//               $habitacioncliacada;
                ?>

                <div class='habitacion' id=tipo<?php echo $tipos[$index][3] ?>>
                    <div id="carousel-<?php echo "carrusel" . $index2 ?>" class="carousel slide col-6" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel-<?php echo "carrusel" . $index2 ?>" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carousel-<?php echo "carrusel" . $index2 ?>" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carousel-<?php echo "carrusel" . $index2 ?>" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img
                                    src="<?php echo $tipos[$index1][10]; ?>"
                                    <?php $index1++; ?>
                                    class="img-fluid"
                                    alt="First slide"
                                    />
                            </div>
                            <div class="carousel-item">
                                <img
                                    src="<?php echo $tipos[$index1][10]; ?>"
                                    <?php $index1++; ?>
                                    class="img-fluid"
                                    alt="Second slide"
                                    />
                            </div>
                            <div class="carousel-item">
                                <img
                                    src="<?php echo $tipos[$index1][10]; ?>"
                                    <?php $index1++; ?>
                                    class="img-fluid"
                                    alt="Second slide"
                                    />
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?php echo "carrusel" . $index2 ?>" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?php echo "carrusel" . $index2 ?>" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>


                    <div class="texto col-6" id="tipo<?php echo $id ?>">
                        <h1><?php echo $tipos[$titulo][3]; ?></h1>

                        <p><?php echo $tipos[$titulo][7]; ?></p>

                    </div>
                    <a class='precio'><?php echo $tipos[$titulo][6] . "€"; ?></a>


                </div>

                <?php
                $index2++;
                $titulo = $titulo + 3;
                $id++;
            }
            ?>


            <script>
                for (var i = 1; i <= 3; i++) {
                    console.log(i);
                    var num = parseInt(i, 10);
                    console.log(num);
                    var id = '#tipo' + num;
                    let $i = document.querySelector(id);
                    console.log($i);
                    $i.addEventListener('click', plantilla);
                }

                function plantilla() {
                    console.log("funciona click");
                    var $dato = $(this).attr('id');
                    $("#num_habitaciones").val($dato);
                    console.log($dato);
                    document.formulario1.submit();
                }

            </script>

            <!-- Div invisible que guarda donde se hace click-->
            <div style="visibility:hidden">
                <form action="../Habitacion/Habitacion.php" method="post" name="formulario1">
                    <input type="text" id="num_habitaciones" value="" name="num_habitacion">
                </form>
            </div>

        </div>

    </body>
    <!-- Separate Popper and Bootstrap JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
        crossorigin="anonymous"
    ></script>
    <!--Jquery-->
    <script
        src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"
        type="text/javascript"
    ></script>
</html>
