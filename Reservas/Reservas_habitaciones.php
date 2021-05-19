
<?php
session_start();
require_once './BD_habitaciones.php';
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link rel='stylesheet' type='text/css' media='screen' href='./precios_habitaciones.css'>
        <title>Reservas</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Montserrat&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <script src="./jquery-3.6.0.min.js" type="text/javascript"></script>   
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
                            <a class="titulo" href="#Arriba">Hotel La Sagne </a>
                        </div>
                    </ul>


                    <p class="usuario"><?php echo $_SESSION['usuario'] ?></p>
                    <img  class="avatar" src="./multimedia/avatar.png">

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
                            <button  class="btn btn-outline-light my-2 my-sm-3" onclick="location = 'Crear_habitacion.php'"> Crear habitacion
                        </li>
                        <li class="nav-item" style="margin-top:10px" >
                            <button  class="btn btn-outline-light my-5 my-sm-3" onclick="location = 'Borrar_habitacion.php'"> Borrar habitacion
                        </li>
                        <li class="nav-item"style="margin-top:10px ">
                            <button  class="btn btn-outline-light my-2 my-sm-3" onclick="location = 'Modificar_Habitaciones.php'"> Modificar habitacion
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






        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper --

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
        -->
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</html>
