<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once './BD_habitaciones.php';
require_once '../Perfil/Bd_Perfil.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['fecha_entrada']) && isset($_POST['fecha_salida'])){
      $fecha_entrada=$_POST['fecha_entrada'];
      $fecha_salida=$_POST['fecha_salida'];
echo $fecha_entrada,$fecha_salida;
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
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />

        <!--Fuentes -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Montserrat&display=swap" rel="stylesheet">

    </head>

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
                            </div>
                        </ul>
                        <form class="d-flex">
                            <ul class="navbar-nav mt-2 ">
                                <?php if (!empty($_SESSION["usuario"])) { ?>


                                    <li class="nav-item dropdown">

                                        <a style=margin-top:10% class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" ><?php echo $_SESSION['usuario'] ?></a>

                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="../Perfil/Perfil.php"> Ver Perfil</a></li>
                                            <li><a class="dropdown-item" href="../Reservas/Reservas_habitaciones.php">Habitaciones </a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="../Perfil/logout.php">Logout</a></li>
                                        </ul>
                                    </li>

                                    <a href="../Perfil/Perfil.php"><image src="<?php echo cargar_img_perfil($_SESSION["email"]) ?>" href="../Perfil/Perfil.php" width="50" height="50"/></a>
                                <?php } ?>
                            </ul>

                        </form>
                        </nav>
    </header>
 <body>
        <div class="divhabitaciones" style="display: flex;justify-content: center;padding-top: 5%; padding-left: 10%" >
            <div class="datoshabitaciones">
                <div >
                    <?php
                    $id_habitaciones= consultar_id_reservas($fecha_salida, $fecha_entrada);
                    $tipos_diferentes;
                    for ($index3 = 0; $index3 < count($id_habitaciones); $index3++) {
                    $tipos_diferentes[]=$id_habitaciones[$index3][1];
                    }
                    $separado_por_comas = implode(",", $tipos_diferentes);
                    
                    $tipos_diferentes= implode(',',array_unique(explode(',', $separado_por_comas))); 
                    $array_tipos_diferentes = explode(",", $tipos_diferentes);
                    $index1 = 0;
                    $index2 = 0;
                    $titulo = 0;
                    $id = 1;
 
                    for ($index = 0; $index < count($array_tipos_diferentes); $index++) {
                        $tipos= devolver_imagenes_por_tipo($array_tipos_diferentes[$index]);
                    $habitacioncliacada;
                    
                    
                    
                        ?>
                        <div class='habitacion2' id=tipo<?php echo $tipos[0][3] ?> >
                            <img src="<?php echo $tipos[0][10]?>" style="width: 30%;height: 100%">
                            <div class="texto  col-6" id="tipo<?php echo $id ?>" value='<?php echo $tipos[0][3] ?>'>
                                <h1><?php echo $tipos[0][3]; ?></h1>

                                <p><?php echo $tipos[0][7]; ?></p>

                            </div>
                            <a class='precio'><?php echo $tipos[0]['precio'] . "€"; ?></a>


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
                <!-- Separate Popper and Bootstrap JS -->
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
                <!--Jquery-->
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

                </html>