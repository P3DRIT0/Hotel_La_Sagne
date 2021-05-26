<?php

session_start();
$_SESSION = array();
//setcookie(session_name(), '', time() - 42000);
session_destroy();

header("Location:../Pagina_principal/Pagina_principal.php");
