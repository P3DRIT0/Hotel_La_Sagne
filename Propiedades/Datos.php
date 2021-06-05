<?php
include_once './Propiedades_admin.php';
if ($_SESSION['rol'] == "Usuario_administrador") {
    añadir_datos_administradores();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['fecha_nac']) && isset($_POST['dni']) && isset($_POST['nacionalidad']) && isset($_POST['sexo'])){
        $fecha_nac=$_POST['fecha_nac'];
        $dni=strtoupper($_POST['dni']);
        $nacionalidad=ucfirst (strtolower($_POST['nacionalidad']));
        $sexo=ucfirst (strtolower($_POST['sexo']));
        añadir_datos_trabajadores($fecha_nac, $dni, $nacionalidad, $sexo);
        header('Location:../Reservas/Reservas_habitaciones.php');
    }
}



?>
<!DOCTYPE html>
<html style="background-image:url(../Registro//Multimedia/Fondo_pantalla.jpg)">
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
        <title>Datos trabajadores</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <LINK REL=StyleSheet HREF="../Registro/estilo.css" TYPE="text/css" MEDIA=screen>
    </head>
    <body style="background:transparent">

        <div class="container register">
            <div class="row">
                <div class="col-md-3 register-left">
                    <img class="icono" src ="../Registro/Multimedia/logo.png" alt=""/>
                    <h3>Bienvenido</h3>
                    <p>Estamos encantados de contar contigo en nuestra gran familia</p>
                    <form action="" method="post">
                        <input type="submit" name="" value="Atras"/><br/>
                    </form>
                </div>
                <div class="col-md-9 register-right">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <h3 class="register-heading">Introduce unos datos mas</h3>
                            <form action="./Añadir_datos_trabajadores.php" method="post">
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            Fecha nacimiento
                                            <input type="date" class="form-control"  name="fecha_nac" value="1980-01-01" min="1900-01-01" max="2020-12-31"/>
                                        </div>
                                       
                                        <div class="form-group">
                                             DNI
                                            <input type="text" class="form-control" placeholder="39490454M *" name="dni"  value=""/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                           <div class="form-group">
                                               Nacionalidad
                                               <input type="text" class="form-control" placeholder="Española*"   name="nacionalidad"/>
                                        </div>
                                       <div class="form-group">
                                           Sexo
                                            <input type="text" class="form-control"  placeholder="Hombre/Mujer*"  name="sexo"/>
                                        </div>
                                        
                                        <br>
                                        <input type="submit" class="btnRegister"  value="Hecho"/>
                                    </div>
                               
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>





        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
        -->


    </body>
</html>
