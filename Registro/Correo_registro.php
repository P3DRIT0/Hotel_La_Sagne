<html>
 <head>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Alex+Brush&display=swap" rel="stylesheet"> 
<link rel='stylesheet' type='text/css' media='screen' href='estilo_correo.css'>
 </head>
 <body>
  <?php
/*
 * Utilizamos la librería de terceros PHPMailer proporcionada por Composer
 */
use PHPMailer\PHPMailer\PHPMailer;

require dirname(__FILE__) . "/../vendor/autoload.php";

function enviar_correos($correo,$nombre) {
    /*
     * Envía un correo de confirmación al restaurante que ha realizado el pedido
     * y al departamento de pedidos. El correo incluye el número del pedido, el 
     * restaurante que lo realiza y una tabla HTML con los productos del pedido.
     */
    $cuerpo = crear_correo($correo,$nombre);
    $correo_Departamento_Pedidos = "Hotel La Sagne"; //Poner al responsable del departamento de pedidos
    return enviar_correo_multiples("$correo, $correo_Departamento_Pedidos",
            $cuerpo, "Hotel La Sagne");
}

function crear_correo($correo,$nombre) {
    /*
     * Crea el correo para informar al usuario de que se ha completado el registro
     * en nuestra pagina web
     */
    

    $texto = "<h1 class='titulo'> Hotel La Sagne</h1>";
    $texto .= "Registro exitoso:";
    $texto .= "<p>Estimado ciente ,$nombre</p>";
    $texto .="<p>Su registro en nuestra página web a traves del correo  $correo  se ha completado con exito </p>";
     $texto .="<p>Gracias por confiar en nosotros.</p>";
    return $texto;
}

function enviar_correo_multiples($lista_correos, $cuerpo, $asunto = "Registro Exitoso") {
    /*
     * Recibe un array de direcciones de correo, el cuerpo del correo y el asunto.
     * Envía el correo a todas las direcciones.
     */
    $res = leer_configCorreo(dirname(__FILE__) . "/../config/correo.xml", dirname(__FILE__) . "/../config/correo.xsd");
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug = 0;  // cambiar a 1 o 2 para ver errores
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->Username = $res[0];  //usuario de gmail
    $mail->Password = $res[1]; //contraseña de gmail          
    $mail->SetFrom('usuario_correo@gmail.com', 'Hotel La Sagne');
    $mail->Subject = utf8_decode($asunto);
    $mail->MsgHTML($cuerpo);
    /* Divide la lista de correos por la coma */
    $correos = explode(",", $lista_correos);
    foreach ($correos as $correo) {
        $mail->AddAddress($correo, $correo);
    }
    if (!$mail->Send()) {
        return $mail->ErrorInfo;
    } else {
        return TRUE;
    }
}

function leer_configCorreo($nombre, $esquema) {
    /*
     * Recibe dos parámetros: 
     * 1. $nombre: fichero de configuración con los datos (usuario y clave) para enviar un correo
     * 2. $esquema: fichero de validación,para comprobar la estructura que se espera
     * del fichero de configuración 
     */
    $config = new DOMDocument();
    $config->load($nombre);
    $res = $config->schemaValidate($esquema);
    if ($res === FALSE) {
        throw new InvalidArgumentException("Revise fichero de configuración");
    }
    $datos = simplexml_load_file($nombre);
    $usu = $datos->xpath("//usuario");
    $clave = $datos->xpath("//clave");
    $resul = [];
    $resul[] = $usu[0];
    $resul[] = $clave[0];
    return $resul;
}
?>
</body>
</html>



