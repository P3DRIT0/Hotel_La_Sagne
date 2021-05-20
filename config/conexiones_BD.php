<?php

/* 
 *Clase para realizar las conexiones a la Base de datos
 */
function conectar ($rol){
    try{
    $campos = configuracion('../config/BD_configuracion.xml', '../config/BD_configuracion.xsd', $rol);
    $usuario="administrador";
    $contraseña="1234";
    $server="localhost";
    $dbname="hotel";
    $base = new PDO("mysql:dbname=$dbname;host=$server", $campos[0], $campos[1]);
        return $base;
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
function configuracion($name, $xsd, $rol) {

    //Devuelve un array de 2 strings: nombre y password
    $conf = new DOMDocument();
    $conf->load($name);

    if (!$conf->schemaValidate($xsd)) {
        throw new PDOException("Ficheiro de usuarios no valido");
    }


    $xml = simplexml_load_file($name);
//Conversión a cadena de texto con "", porque si no, el xpath nos devuelve
//un objeto de tipo SimpleXMLElement
    $array = [
        "" . $xml->xpath('//nombre[../rol="' . $rol . '"]')[0],
        "" . $xml->xpath('//password[../rol="' . $rol . '"]')[0]
    ];
    return $array;
}