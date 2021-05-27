      
<?php
require_once './Bd_habitacion.php';
require_once '../Perfil/Bd_Perfil.php';

if (isset($_POST['num_habitacion'])) {
    $tipo = $_POST['num_habitacion'];
    $habitacion = obtener_habitacion($tipo);
    $imagen1 = $habitacion[1][0][2];
    $imagen2 = $habitacion[1][1][2];
    $imagen3 = $habitacion[1][2][2];
    $titulo = $habitacion[0][0][3];
    $descripcion = $habitacion[0][0][7];
    $precio = $habitacion[0][0][6];
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
    <div class="load"></div>
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habitación</title>
    <link rel="stylesheet" type="text/css" media="screen" href="pagina_habitacion.css">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
        />
    <link
        href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Montserrat&display=swap"
        rel="stylesheet"
        />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

</head>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                          <li class="nav-item dropdown">
                                    
                                   <a style=margin-top:10% class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" ><?php echo $_SESSION['usuario'] ?></a>
                                    
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="../Perfil/Perfil.php"> Ver Perfil</a></li>
                                        <li><a class="dropdown-item" href="../Reservas/Reservas_habitaciones.php">Habitaciones </a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="../Perfil/logout.php">Logout</a></li>
                                    </ul>
                                </li>
                                <a href="../Perfil/Perfil.php"><img src='<?php echo cargar_img_perfil($_SESSION['email']);?>' style="width: 50px;height: 50px"></a>
                    </ul>
                    </form>
                    </ul>
                </form>
            </div>
        </div>
    </nav>
</header>
<body>

    <!--contenedor principal-->
    <div class="contenedor">
        <!--zona reserva-->
        <div class="reservationcalendar">
            <div class="datosreservas" >
                <div class="infohotel">
                    <h1><?php echo $titulo ?></h1>
                    <img src="../Pagina_principal/Multimedia/logo.png" height="150px">
                </div>
                <div class="reservationinfo">

                    <ul class="minicalendar">
                        <li class="datein">
                            <label>Fecha de llegada:</label>
                            <input id="checkin" class="login__input" maxlength="10" value="12-05-2021">
                        </li>
                        <img src="./Multimedia/arrow.png" height="25px">
                        <li class="dateout">
                            <label>Fecha de salida:</label>
                            <input id="checkout" class="login__input" maxlength="10" value="15-05-2021">
                        </li>
                    </ul>

                    <div class="contenedor_calendario">
                        <div class="real_calendar">
                            <div class="calendar">
                                <div class="month">
                                    <i class="fas fa-angle-left prev"></i>
                                    <div class="date">
                                        <h1></h1>
                                    </div>
                                    <i class="fas fa-angle-right next"></i>
                                </div>
                                <div class="weekdays">
                                    <div>Lun</div>
                                    <div>Mar</div>
                                    <div>Mié</div>
                                    <div>Jue</div>
                                    <div>Vie</div>
                                    <div>Sáb</div>
                                    <div>Dom</div>
                                </div>
                                <div class="days">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--zona habitacion-->
        <div class="room">
            <div class="datosreservas" >
                <!--imagen de habitacion-->
                <div class="roomimg">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src='<?php echo $imagen1 ?>' class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src='<?php echo $imagen2 ?>' class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src='<?php echo $imagen3 ?>' class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <!--descripción de habitacion-->
                <div class="roominfo">
                    <p style="color: white"><?php echo $descripcion ?></p>
                </div>
                <!--precio de habitacion-->
                <div class="roomprice">
                    <p style=" color:white;font-family: 'Alex Brush', cursive;"><?php echo $precio ?>€</p>
                </div>
                <!--botones-->
                <div class="buttons">
                    <input type="submit" value="Cancelar" id="cancel">
                    <input type="submit" value="Reservar online" id="select">
                </div>
            </div>
        </div>
    </div>
    <script src="calendario.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>

</html>
