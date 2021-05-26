<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once './Bd_login.php';
$correo = "";
$Err_contraseñas = "";
$Err_email = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['contraseña']) && isset($_POST['email'])) {
        $contraseña = $_POST['contraseña'];
        $correo = $_POST['email'];


        if (comprobar_usuario($correo)) {
            if (cotejar_contraseñas($contraseña, $correo)) {
                crear_sesion($correo);
            } else {
                $Err_contraseñas = "Contraseña incorrecta";
            }
        } else {
            $Err_email = "Email incorrecto";
        }
    }
}
?>
<html>
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

        <!-- Bootstrap CSS -->

        <LINK REL=StyleSheet HREF="../Inicio_Sesion/inicio_sesion.css" TYPE="text/css" MEDIA=screen>
    </head>
    <body>
        <div class="login">
            <div class="login-container">
                <form action="Inicio_sesion.php" class="form-login" method="post">
                    <a href="../Pagina_principal/Pagina_principal.php">
                        <img class="icono" src ="../Registro/Multimedia/logo.png" alt=""/></a>
                    <label for="login-input-user" class="login__label">
                        Correo
                    </label>
                    <input id="email" class="login__input" type="text" name="email" />

                    <a  class="letras_error "style="color:red"><?php echo $Err_email; ?></a>
                    <label for="login-input-password" class="login__label">
                        Contraseña
                    </label>
                    <input id="contraseña" class="login__input" type="password" name="contraseña" />
                    <a class="letras_error" style="color:red"><?php echo $Err_contraseñas; ?></a>
                    <input type="submit" class="login__submit"  value="Sign in" />

                </form>
                <a href="#" class="login__forgot">Forgot Password?</a>
            </div>
        </div>
    </body>
</html>

