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

        /**
         * Método que envía un correo de confirmación al usuario que acaba de registrarse.
         * 
         * @param string $correo Correo del usuario 
         * @param string $nombre Nombre del usuario
         * @return type
         */
        function enviar_correos($correo, $nombre) {
            /*
             * Envía un correo de confirmación al restaurante que ha realizado el pedido
             * y al departamento de pedidos. El correo incluye el número del pedido, el 
             * restaurante que lo realiza y una tabla HTML con los productos del pedido.
             */
            $cuerpo = crear_correo($correo, $nombre);
            $correo_Departamento_Pedidos = "Hotel La Sagne"; //Poner al responsable del departamento de pedidos
            return enviar_correo_multiples("$correo, $correo_Departamento_Pedidos",
                    $cuerpo, "Hotel La Sagne");
        }

        /**
         * Método que crea el correo para informar al usuario de que se ha completado 
         * el registro en nuestra pagina web. Recibe por cabecera el correo del 
         * usuario y su nombre.
         * 
         * @param string $correo Correo del usuario
         * @param string $nombre Nombre del usuario
         * @return string Texto predefinido con los datos del usuario 
         */
        function crear_correo($correo, $nombre) {
            $texto = "<h1 class='titulo'> Hotel La Sagne</h1>";
            $texto .= "Registro exitoso:";
            $texto .= "<p>Estimado ciente ,$nombre</p>";
            $texto .= "<p>Su registro en nuestra página web a traves del correo  $correo  se ha completado con exito </p>";
            $texto .= "<p>Gracias por confiar en nosotros.</p>";
            return $texto;
        }

        /**
         * Método que recibe por cabecera un array con las direcciones de correo, 
         * el texto del correo y el asunto del mismo, para envíaselo a estas direcciones 
         * de correo. 
         * 
         * @param array $lista_correos Lista de correos
         * @param string $cuerpo Texto del correo
         * @param string $asunto Asunto 
         * @return boolean Verdadero si el correo es enviado correctamente
         */
        function enviar_correo_multiples($lista_correos, $cuerpo, $asunto = "Registro Exitoso") {
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

        /**
         * Método que recibe por cabecera un fichero con el usuario y la clave 
         * necesarios para enviar el correo y el fichero de validación para 
         * comprobar la estructura esperada.
         *  
         * @param file $nombre Contiene el usuario y la clave
         * @param file $esquema Contiene la estructura ha cumplir
         * @return array Contiene el usuario y la clave
         * @throws InvalidArgumentException Excepcion para indicarnos que ha fallado
         */
        function leer_configCorreo($nombre, $esquema) {
            /*
             * Recibe dos parámetros: 
             * 1. $nombre: fichero de configuración con los datos (usuario y clave) para enviar un correo
             * 2. $esquema: fichero de validación,para comprobar la estructura que se espera
             * del fichero de configuración 
             */
            $config = new DOMDocument();
            $config->load($nombre);
            //Validamos el documento basandonos en el esquema
            $res = $config->schemaValidate($esquema);
            if ($res === FALSE) {
                throw new InvalidArgumentException("Revise fichero de configuración");
            }
            //Interpretamos el fichero xml
            $datos = simplexml_load_file($nombre);
            //Buscamos el SimpleXML entre los hijos que cumpla 
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