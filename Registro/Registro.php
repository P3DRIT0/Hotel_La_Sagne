<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once './BD_registro.php';
$nombre = $apellidos = $correo = $direccion =$telefono= "";
$Err_contraseñas="";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['contraseña']) && isset($_POST['contraseña2']) && isset($_POST['email']) && isset($_POST['telefono']) && isset($_POST['direccion'])) {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellido'];
        $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
        $contraseña2 = password_hash($_POST['contraseña2'], PASSWORD_DEFAULT);
        $correo = $_POST['email'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        if (!($_POST['contraseña'] == $_POST['contraseña2'])) {
            $Err_contraseñas="Las contraseñas no coinciden";
        } else {
            registrar_usuario($nombre, $apellidos,$contraseña,$correo,$telefono,$direccion);
        }
    } else {
        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
        }
        if (isset($_POST['apellido'])) {
            $apellidos = $_POST['apellido'];
        }
        if (isset($_POST['email'])) {
            $correo = $_POST['email'];
        }
        if (isset($_POST['telefono'])) {
            $telefono = $_POST['telefono'];
        }
        if (isset($_POST['pregunta'])) {
            $pregunta = $_POST['direccion'];
        }
    }
}
?>
<html style="background-image:url(../Registro//Multimedia/Fondo_pantalla.jpg)";>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
                    <p>Estas a 30 segundos de reservar tus vacaciones</p>
                    <form action="../Login.php" method="post">
                        <input type="submit" name="" value="Login"/><br/>
                    </form>
                </div>
                <div class="col-md-9 register-right">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <h3 class="register-heading">Registrarse</h3>
                            <form action="Registro.php" method="post">
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Nombre*" name="nombre" value="<?php echo $nombre?>"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Primer Apellido *" name="apellido"  value="<?php echo $apellidos?>"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Contraseña *"   name="contraseña"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control"  placeholder="Confirmar contraseña*"  name="contraseña2"/>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email *" name="email" value="<?php echo $correo?>"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" minlength="9" maxlength="9" class="form-control" placeholder="Telefono *" name="telefono" value="<?php echo $telefono?>"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Dirección *"  name="direccion" value="<?php echo $direccion;?>"/>
                                        </div>
                                       
                                        <br>
                                        <input type="submit" class="btnRegister"  value="Registrarse"/>
                                    </div>
                                    <a style="color:red"><?php echo $Err_contraseñas;?></a>
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

