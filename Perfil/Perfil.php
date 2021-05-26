<?php
session_start();
include_once './Bd_Perfil.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_FILES['nuevaimagen']) && $_FILES['nuevaimagen']['error'] === UPLOAD_ERR_OK) {
        echo "entra";
        $imagen = $_POST['nuevaimagen'];
        $mensaje_error;
//Obtener detalles del fichero
        $fileTmpPath = $_FILES['nuevaimagen']['tmp_name'];
        $fileName = $_FILES['nuevaimagen']['name'];
        $fileSize = $_FILES['nuevaimagen']['size'];
        $fileType = $_FILES['nuevaimagen']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
//Limpiar los caracteres especiales
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
//Creamos un array con las extensiones permitidas
        $allowedfileExtensions = array('jpg', 'gif', 'png');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $directorio = '../Perfil/Multimedia'; //Declaramos un  variable con la ruta donde guardaremos los archivos
//Validamos si la ruta de destino existe, en caso de no existir la creamos
            if (!file_exists($directorio)) {
//0777 son los permisos
                mkdir($directorio, 0777) or die("No se puede crear el directorio;n");
            }
            $dir = opendir($directorio); //Abrimos el directorio de destino
            $target_path = $directorio . '/' . $newFileName; //Indicamos la ruta de destino, así como el nombre del archivo

            if (move_uploaded_file($fileTmpPath, $target_path)) {

                $imagen_actual_ruta = cargar_img_perfil($_SESSION["email"]);
                $imagen_actual_aux = explode("/", $imagen_actual_ruta);
                $imagen_actual = end($imagen_actual_aux);
                //Aqui compruebo si la imagen por defecto es la que esta,si es el caso no la borro pero si no lo es borro la imagen anterior
                if ($imagen_actual === "avatar_defecto.png") {
                    cambiar_img_perfil($_SESSION["email"], $target_path);
                    header('Location:./Perfil.php');
                } else {
                    unlink($imagen_actual_ruta);
                    cambiar_img_perfil($_SESSION["email"], $target_path);
                    header('Location:./Perfil.php');
                }
            } else {
                echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
            }
            closedir($dir); //Cerramos el directorio de destino
        }
    } else {
        $mensaje_error = "El archivo introducido no es una imagen (jpg,gif,png)";
    }
}
?>
<!DOCTYPE html>
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
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Perfil</title>

        <!-- Bootstrap CSS -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
            crossorigin="anonymous"
            />
        <LINK REL=StyleSheet HREF="./estilo_perfil.css" TYPE="text/css" MEDIA=screen>
        <!--Fuentes -->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link
            href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Montserrat&display=swap"
            rel="stylesheet"
            />
    </head>
    <body>
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
<?php } ?>
                            </ul>

                        </form>
                    </div>
                </div>
            </nav>
        </header>
        <form action="Perfil.php" method="post" enctype="multipart/form-data">
            <section>
                <div class="container">
                    <div class="row">
                        <div
                            class="col-12 mx-auto"
                            style="height: 400px; margin-top: 100px"
                            >
                            <div class="row">
                                <div class="col-9">
                                    <div class="row"><h2 style="text-align: center;margin-top: 20px;text-decoration: underline;">Perfil</h2></div>
                                    <div class="row"><div class="col-5 m-auto my-5">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Nombre:     <?php echo $_SESSION["usuario"] ?></li>
                                                <li class="list-group-item">Correo electrónico:     <?php echo $_SESSION["email"] ?></li>
                                                <li class="list-group-item">Número de teléfono:     <?php echo $_SESSION["telf"] ?></li>
                                                <li class="list-group-item">Dirección:      <?php echo $_SESSION["direccion"] ?></li>
                                            </ul>
                                        </div>                                
                                        <div class="col-5 bg-dark">
                                            <div class="container">
                                                <div class="picture-container">
                                                    <div class="picture">
                                                        <img src="<?php echo cargar_img_perfil($_SESSION["email"]) ?>" class="picture-src" id="wizardPicturePreview" title="">
                                                        <input type="file" id="wizard-picture" name="nuevaimagen">
                                                    </div>
                                                    <h6 class="">Cambiar imagen </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="submit" class="btn btn-dark"  value="Guardar Cambios" />
                            </section>

                            </form>
                            </body>
                            <!-- Separate Popper and Bootstrap JS -->
                            <script
                                src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
                                integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
                                crossorigin="anonymous"
                            ></script>
                            <script src="../config/jquery-3.6.0.min.js"></script>
                            <script>
                                $(document).ready(function () {
                                    // Prepare the preview for profile picture
                                    $("#wizard-picture").change(function () {
                                        readURL(this);
                                    });

                                });
                                function readURL(input) {
                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();

                                        reader.onload = function (e) {
                                            $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                                        }
                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }

                            </script>







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
