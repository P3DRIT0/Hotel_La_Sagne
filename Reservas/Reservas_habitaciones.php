
<?php
require_once './BD_habitaciones.php';
session_start();
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
                    
                    if($_SESSION['rol']=="Usuario_administrador"){
                        
                        $visibilidad="visible";
                    }else{
             
                        $visibilidad="hidden";
                    }
                        echo "<ul class='navbar-nav  mb- mb-lg-0' style='visibility: $visibilidad'>";
                 
                         ?>
                    
                        <li class="nav-item" style="margin-top:10px ">
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

        <div class='contenedor'>
            <?php
            visualizar_habitaciones();
            ?>
        </div>





        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
        -->
    </body>
</html>
