<?php
session_start();
include_once '../Perfil/Bd_Perfil.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!doctype html>
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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link href="./estilo.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
        crossorigin="anonymous"
        />
    <!--Fuentes -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Montserrat&display=swap"
        rel="stylesheet"
        />

    <title>Hotel La sagne </title>

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
                        <a class="nav-link" href="#habitaciones">Habitaciones</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Actividades">Explora</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Sobre_nosotros">Sobre Nosotros</a>
                    </li>
                </ul>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <div>
                        <a class="titulo" href="#Arriba">Hotel La Sagne </a>
                    </div>
                </ul>
                <form class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
                            <a href="../Perfil/Perfil.php"><image src="<?php echo cargar_img_perfil($_SESSION["email"]) ?>"width="50" height="50"/></a>
                    </form>
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
    </nav>
</header>

<body>
    <a name="Arriba"></a>
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-item active">
                <img src="./Multimedia/Fondo1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="display">Hotel La Sagne</h1>
                    <p>Las vacaciones que necesitas a un precio que no podras olvidar .</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./Multimedia/Fondo2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="titulo_carousel">Gran variedad de habitaciones </h1>
                    <p>Para que encuentres tu habitación ideal al mejor precio</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./Multimedia/Fondo3.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Multitud de actividades</h1>
                    <p>Disfruta de nuestra multitud de actividades de ocio tanto si vienes solo como acompañado</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>
    <a name="habitaciones"></a>
    <div class="habitaciones">
        <div class="texto_habitaciones">
            <nav style="background-color: transparent;" class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a id="suite">Suite</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav me-auto mb-1 mb-lg-0">
                        <li class="nav-item">
                            <a id="individual">Individual</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a id="doble">Doble</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="texto_cambiante" class="texto_cambiante">
                <h1 id="titulo_habitaciones" class="titulo_habitaciones"></h1>
                <p id="descripcion_habitacion" class="descripcion_habitacion"></p>
                <ul class="habitaciones_tipos">
                    <li id="opcion1">
                    </li>
                    <p id="caracteristicas_habitacion1"> </p>
                    <li id="opcion2"></li>
                    <p id="caracteristicas_habitacion2"> </p>
                    <li id="opcion3"></li>
                    <p id="caracteristicas_habitacion3"> </p>
                    <li id="opcion4"></li>
                    <p id="caracteristicas_habitacion4"> </p>
                    <li id="opcion5"></li>
                    <p id="caracteristicas_habitacion5"> </p>
                    <li id="opcion6"></li>
                    <p id="caracteristicas_habitacion6"> </p>
                </ul>
            </div>

        </div>
        <div class="imagenes_habitaciones">
            <div id="carouselExampleControls" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img id="habitaciones_img1" src="" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img id="habitaciones_img2" src="" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img id="habitaciones_img3" src="" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>







    <div class="seccion2">

        <nav class="navbar bg-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <button id="oceano"> Snorkel</button>
                </li>
                <li class="nav-item">
                    <button id="deportes_acuaticos">Kayak </button>
                </li>
                <li class="nav-item">
                    <button id="avion"> Avioneta </button>
                </li>
                <li class="nav-item">
                    <button id="ciudad"> Ciudad </button>
                </li>
            </ul>
        </nav>

        <div class class="Contenedor_video_generico">

            <div id="contenedorv1" class="opacidad">

                <div class="ancla">
                    <a name="Actividades"></a>
                     
                </div>
                <div class="submarinismo">

                    <button class="h1_titulos" id="boton_texto">Snorkel</button>
                    <div id="texto_emergente" class="opacidad_actividades">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis molestias minus itaque fuga, autem
                            nihil laboriosam sequi culpa sapiente quas, quaerat fugiat odit quis numquam cum aspernatur temporibus
                            reiciendis facilis.</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab veniam porro voluptatibus assumenda ratione
                            voluptatem pariatur unde enim! Reprehenderit numquam deserunt incidunt asperiores explicabo enim cum
                            eaque, ut ad perferendis?</p>

                    </div>
                </div>
            </div>
        </div>



        <video id="v1" loop autoplay muted class="opacidad" style="opacity: 100;">
            <source src="./Multimedia/oceano.mp4" type="video/mp4">
            </source>
        </video>
        <video id="v4" loop autoplay muted class="opacidad" style="opacity: 0;">
            <source src="./Multimedia/ciudad.mp4" type="video/mp4">
            </source>
        </video>
        <video id="v2" loop autoplay muted class="opacidad" style="opacity: 0;">
            <source src="./Multimedia/avion.mp4" type="video/mp4">
            </source>
        </video>

        <video id="v3" loop autoplay muted class="opacidad" style="opacity: 0;">
            <source src="./Multimedia/kayak.mp4" type="video/mp4">
            </source>
        </video>
    </div>
</div>


</div>
<a name="Sobre_nosotros"></a>
<div class="quienes_somos" id="contenedorv2" class="opacidad">
    <div class="contenido_quienes_somos">
        <button class="h1_titulos" id="boton_texto2">Quienes Somos</button>
        <div id="texto_emergente2" class="opacidad_actividades">
            <p class="texto_quines_somos">
                El Hotel La Sagne es un alojamiento cerca de la playa de las Maldivas diseñado por Frank Gehry. Es uno de los
                destinos favoritos de la zona ya que además del diseño del edificio, las vistas de la playa son idílicas.
            </p>
            <br>

            </html>
            <p class="texto_quines_somos">
                Contamos con instalaciones de golf, tenis, piscina y spa; pero estas no son las únicas actividades disponibles ya que
                el hotel está situado en una zona cerca de rutas y actividades al aire libre. Ofrecemos bufet libre.
            </p>
        </div>
    </div>
</div>
</div>
</div>




<script>
    window.onload = function () {
        imagenes_suite();
    }
    const TIEMPO_INTERVALO_MILESIMAS_SEG = 1000;
    let $oceano = document.querySelector('#oceano');
    let $deportes_acuaticos = document.querySelector('#deportes_acuaticos');
    let $avion = document.querySelector('#avion');
    let $ciudad = document.querySelector('#ciudad');
    let $video = document.querySelector('#video');
    let $v1 = document.querySelector('#v1');
    let $v2 = document.querySelector('#v2');
    let $v3 = document.querySelector('#v3');
    let $v4 = document.querySelector('#v4');
    let $texto = document.querySelector('#texto_emergente');
    let $boton_texto = document.querySelector('#boton_texto');
    let $texto2 = document.querySelector('#texto_emergente2');
    let $boton_texto2 = document.querySelector('#boton_texto2');
    let $contenedorv1 = document.querySelector('#contenedorv1');
    let $contenedorv2 = document.querySelector('#contenedorv2');
    /*Botones havitaciones */
    let $suite = document.querySelector('#suite');
    let $individual = document.querySelector('#individual');
    let $doble = document.querySelector('#doble');

    function oceano() {
        $v4.style.opacity = 0;
        $v4.pause();
        $v3.style.opacity = 0;
        $v3.pause();
        $v2.style.opacity = 0;
        $v2.pause();
        $v1.play();
        $v1.style.opacity = 100;
        $contenedorv1.style.opacity = 100;
    }
    function deportes() {
        $v4.style.opacity = 0;
        $v4.pause();
        $v3.play();
        $v3.style.opacity = 100;
        $v1.pause();
        $v1.style.opacity = 0;
        $v2.pause();
        $v2.style.opacity = 0;
        $contenedorv1.style.opacity = 0;

    }
    function avion() {
        $v4.style.opacity = 0;
        $v4.pause();
        $v3.style.opacity = 0;
        $v3.pause();
        $v1.style.opacity = 0;
        $v1.pause();
        $v2.play();
        $v2.style.opacity = 100;
        $contenedorv1.style.opacity = 0;
    }
    function ciudad() {
        $v4.style.opacity = 100;
        $v4.play();
        $v3.pause();
        $v3.style.opacity = 0;
        $v1.pause();
        $v1.style.opacity = 0;
        $v2.pause();
        $v2.style.opacity = 0;
        $contenedorv1.style.opacity = 0;
    }
    function texto() {
        $texto.style.opacity = 100;
    }
    function texto2() {
        $texto2.style.opacity = 100;
    }
    function texto_oculto() {
        $texto.style.opacity = 0;
    }
    function texto_oculto2() {
        $texto2.style.opacity = 0;
    }

    function imagenes_suite() {
        $("#habitaciones_img1").attr("src", "./Multimedia/1.jpg");
        $("#habitaciones_img2").attr("src", "./Multimedia/2.jpg");
        $("#habitaciones_img3").attr("src", "./Multimedia/3.jpg");
        $("#titulo_habitaciones").text("Suite")
        $("#descripcion_habitacion").text("Disfruta de nuestra gran variedad de suits en la playa,escoja entre nuestro amplio catalogo de habitaciones para encontrar la que mejor se adapte a usted.");
        $("#opcion1").text("-Beach Suite")
        $("#caracteristicas_habitacion1").text("Vistas a la playa con terraza")
        $("#opcion2").text("-Infinito Suite")
        $("#caracteristicas_habitacion2").text("Vistas a la playa con balcon")
        $("#opcion3").text("-Business Suite")
        $("#caracteristicas_habitacion3").text("Vistas a la playa con zona de negocios")
        $("#opcion4").text("-Immenso Suite")
        $("#caracteristicas_habitacion4").text("Vistas a la playa con doble altura")
    }
    function imagenes_individual() {
        $("#habitaciones_img1").attr("src", "./Multimedia/11.jpg");
        $("#habitaciones_img2").attr("src", "./Multimedia/12.jpg");
        $("#habitaciones_img3").attr("src", "./Multimedia/13.jpg");
        $("#titulo_habitaciones").text("Individual")
        $("#descripcion_habitacion").text("Encuentre la habitacion perfecta para usted dentro de nuestro amplio catalogo de habitaciones");
        $("#opcion1").text("-Simple room")
        $("#caracteristicas_habitacion1").text("Habitacion basica y acojedora ")
        $("#opcion2").text("-Large room ")
        $("#caracteristicas_habitacion2").text("Habitacion con cocina")
        $("#opcion3").text("-Immenso room")
        $("#caracteristicas_habitacion3").text("Habitacion con cocina y salon")
        $("#opcion4").text("-Delux room")
        $("#caracteristicas_habitacion4").text("Immenso room + piscina privada")

    }
    function imagenes_doble() {
        $("#habitaciones_img1").attr("src", "./Multimedia/6.jpg");
        $("#habitaciones_img2").attr("src", "./Multimedia/7.jpg");
        $("#habitaciones_img3").attr("src", "./Multimedia/8.jpg");
        $("#titulo_habitaciones").text("Doble")
        $("#descripcion_habitacion").text("Encuentren su habitacion perfecta para conmemorar esa ocasion especial dentro de nuestro amplio abanico de habitaciones");
        $("#opcion1").text("-Basic room")
        $("#caracteristicas_habitacion1").text("Habitacion basica y acojedora ")
        $("#opcion2").text("-Spacious room ")
        $("#caracteristicas_habitacion2").text("Habitacion con cocina")
        $("#opcion3").text("-Duplex")
        $("#caracteristicas_habitacion3").text("Habitacion con cocina y salon")
        $("#opcion4").text("-Delux room")
        $("#caracteristicas_habitacion4").text("Duplex + piscina privada")
    }
    // Eventos
    $oceano.addEventListener('click', oceano);
    $deportes_acuaticos.addEventListener('click', deportes);
    $avion.addEventListener('click', avion);
    $ciudad.addEventListener('click', ciudad);
    $boton_texto.addEventListener('mouseover', texto);
    $boton_texto.addEventListener('mouseout', texto_oculto);
    $boton_texto2.addEventListener('mouseover', texto2);
    $boton_texto2.addEventListener('mouseout', texto_oculto2);
    $suite.addEventListener('click', imagenes_suite);
    $individual.addEventListener('click', imagenes_individual);
    $doble.addEventListener('click', imagenes_doble);

</script>




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
</body>

</html>