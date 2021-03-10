<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once './Bd_login.php';
$correo ="";
$Err_contraseñas="";
$Err_email="";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['contraseña'])&& isset($_POST['email'])) {
        $contraseña = $_POST['contraseña'];
        $correo = $_POST['email'];
     
    
      if (comprobar_usuario($correo)){
          if(cotejar_contraseñas($contraseña,$correo)){
             crear_sesion($correo);
          }else{
              $Err_contraseñas="Contraseña incorrecta";
          }
      }else{
          $Err_email="Email incorrecto";
      }
    }
    }
?>
<html>
    <head>
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
             <img class="icono" src ="../Registro/logo.png" alt=""/>
		<label for="login-input-user" class="login__label">
			Correo
		</label>
		<input id="email" class="login__input" type="text" name="email" />
                
                <a  class="letras_error "style="color:red"><?php echo $Err_email;?></a>
		<label for="login-input-password" class="login__label">
			Contraseña
		</label>
		<input id="contraseña" class="login__input" type="password" name="contraseña" />
                <a class="letras_error" style="color:red"><?php echo $Err_contraseñas;?></a>
                <input type="submit" class="login__submit"  value="Sign in" />
               
	</form>
	<a href="#" class="login__forgot">Forgot Password?</a>
</div>
</div>
    </body>
</html>

