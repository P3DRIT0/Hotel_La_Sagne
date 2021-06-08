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
             * Envía un correo al usuario especificado conforme se ha registrado con exito 
             * en la pagina web
             */
            $cuerpo = crear_correo($correo, $nombre);
            $correo_Departamento_Pedidos = "Hotel La Sagne"; //Poner al responsable del departamento de pedidos
            return enviar_correo_multiples("$correo, $correo_Departamento_Pedidos",
                    $cuerpo, "Hotel La Sagne");
        }
        function enviar_correo_reserva($correo, $nombre) {
            /*
             * Envía un correo conforme la reserva se ha realizado con exito
             */
            $cuerpo = crear_correo_reserva($nombre);
            $correo_Departamento_Pedidos = "Hotel La Sagne"; //Poner al responsable del departamento de pedidos
            return enviar_correo_multiples("$correo, $correo_Departamento_Pedidos",
                    $cuerpo, "Hotel La Sagne");
        } 
        /**
         * Metodo que crea el cuerpo del correo para el email de confirmacion de 
         * la reserva 
         * @param string $nombre
         * @return string cuerpo del correo
         */
        function crear_correo_reserva($nombre) {
            $texto = "<div title='correo' class='aviso'
    style='max-width:600px; background:#A8A296; color: white !important; padding:10px; font-size:1.2em; background: #00c6ff; background: -webkit-linear-gradient(left, #0d37f1, #00c6ff); background: -webkit-linear-gradient(top,  #0d37f1 0%,#00c6ff 100%); background: linear-gradient(to bottom,  #0d37f1 0%,#00c6ff 100%); filter: progid:DXImageTransform.Microsoft.gradient( startC​​olorstr='#a8a296', endColorstr='#66625b',GradientType=0 );'>
    <div>
        <h1  style='font-weight:bold;text-align: center;'>Hotel La Sagne Informa:</h1>
    </div>
    <div class='recuadro' style='border:1px solid gray; background-color: rgb(33,37,41);
'>
        <div
            style='background-image: url(http://hotelasagne.teis38.dewordpress.org/Pagina_principal/Multimedia/Fondo1.jpg);background-size: 160%;'>
            
            <div style='background-color: rgba(33,37,41, 0.8);  padding:30px 50px ;padding-top: 60px; text-align: center;'>
                <img style='margin:0 auto; display:block' width='150px'
                src='http://hotelasagne.teis38.dewordpress.org/Pagina_principal/Multimedia/logo.png'>
                <p style='padding-top: 30px;font-size: 24;color:white'>Estimado ciente:<strong>$nombre</strong><br>Su reserva ha sido aceptada.
                </p>
                <p style='color:white;font-size: 24'>Gracias por confiar en nosotros. </p>
                <p style='color:white;font-size: 24'>Disfrute de su estancia. </p>
                <p style='color:white;font-size: 24'>Atentamente <strong>Pablo Castiñeira Director Ejecutivo del hotel</strong></p>
                <p style='color:white;font-size: 24'>Contacto: Pablo Castiñeira.
                    <br>Tels.: 318 7560443 - 318 6046760
                    <br>Bogotá - Colombia
                </p>
            </div>
        </div>
        <div style='text-align: center;'>
        <p style='padding: 0 10px; color:white'>Conozca más sobre <a style='color: #205EA0'
                href='http://hotelasagne.teis38.dewordpress.org/Pagina_principal/Pagina_principal.php#Sobre_nosotros'>nosotros</a></p>
        <p style='padding: 0 10px; color:white'>Realice ya su <a style='color: #205EA0'
                href='http://hotelasagne.teis38.dewordpress.org/Inicio_Sesion/Inicio_sesion.php'>reserva</a></p>
        <p style='padding: 0 10px; color:white'>Comentarios o inquietudes no dude en contactarnos respondiendo este
            correo <a style='color: #205EA0' href='mailto:hotellasagne@gmail.com'>o haciendo clic.</a></p>
        </div>
    </div>
</div>";
            return $texto;
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
            $texto = "<div title='correo' class='aviso'
    style='max-width:600px; background:#A8A296; color: white !important; padding:10px; font-size:1.2em; background: #00c6ff; background: -webkit-linear-gradient(left, #0d37f1, #00c6ff); background: -webkit-linear-gradient(top,  #0d37f1 0%,#00c6ff 100%); background: linear-gradient(to bottom,  #0d37f1 0%,#00c6ff 100%); filter: progid:DXImageTransform.Microsoft.gradient( startC​​olorstr='#a8a296', endColorstr='#66625b',GradientType=0 );'>
    <div>
        <h1  style='font-weight:bold;text-align: center;'>Hotel La Sagne Informa:</h1>
    </div>
    <div class='recuadro' style='border:1px solid gray; background-color: rgb(33,37,41);
'>
        <div
            style='background-image: url(http://hotelasagne.teis38.dewordpress.org/Pagina_principal/Multimedia/Fondo1.jpg);background-size: 160%;'>
            
            <div style='background-color: rgba(33,37,41, 0.8);  padding:30px 50px ;padding-top: 60px; text-align: center;'>
                <img style='margin:0 auto; display:block' width='150px'
                src='http://hotelasagne.teis38.dewordpress.org/Pagina_principal/Multimedia/logo.png'>
                <p style='padding-top: 30px;font-size: 24;color:white'>Estimado ciente:<strong>$nombre</strong><br>Su registro en nuestra página web a traves del correo 
                     <strong> $correo</strong> se ha completado con exito.
                </p>
                <p style='color:white;font-size: 24'>Gracias por confiar en nosotros. </p>
                <p style='color:white;font-size: 24'>Atentamente <strong>Pablo Castiñeira Director Ejecutivo del hotel</strong></p>
                <p style='color:white;font-size: 24'>Contacto: Pablo Castiñeira.
                    <br>Tels.: 318 7560443 - 318 6046760
                    <br>Bogotá - Colombia
                </p>
            </div>
        </div>
        <div style='text-align: center;'>
        <p style='padding: 0 10px; color:white'>Conozca más sobre <a style='color: #205EA0'
                href='http://hotelasagne.teis38.dewordpress.org/Pagina_principal/Pagina_principal.php#Sobre_nosotros'>nosotros</a></p>
        <p style='padding: 0 10px; color:white'>Realice ya su <a style='color: #205EA0'
                href='http://hotelasagne.teis38.dewordpress.org/Inicio_Sesion/Inicio_sesion.php'>reserva</a></p>
        <p style='padding: 0 10px; color:white'>Comentarios o inquietudes no dude en contactarnos respondiendo este
            correo <a style='color: #205EA0' href='mailto:hotellasagne@gmail.com'>o haciendo clic.</a></p>
        </div>
    </div>
</div>";
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