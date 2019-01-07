<?php

//echo $_SERVER["HTTP_HOST"];

if ($_SERVER["HTTP_HOST"] == "127.0.0.1" || $_SERVER["HTTP_HOST"] == "localhost") {
    $cfg["db"]["servidor"] = "127.0.0.1";
    $cfg["db"]["baseDeDatos"] = "openpay";
    $cfg["db"]["usuario"] = "root";
    $cfg["db"]["clave"] = "pocoyojony12";
    $cfg["dir"] = "http://localhost/Aplicaciones/ejemploOpenpay/";
} else {
    $cfg["db"]["servidor"] = "127.0.0.1";
    $cfg["db"]["baseDeDatos"] = "proy_phc2018";
    $cfg["db"]["usuario"] = "mastache";
    $cfg["db"]["clave"] = "Amcl72_1";
    $cfg["dir"] = "http://www.proyectosweb.mx/demos/mastache/web/";
}

// Envio de correo electrónico.
//$cfg["mail"]["servidor"] = "mexbest.com";
//$cfg["mail"]["puerto"] = "587";
//$cfg["mail"]["usuario"] = "noreply@mexbest.com";
//$cfg["mail"]["clave"] = "t0zgL6$0";
//$cfg["mail"]["deNombre"] = "mexbest";
//$cfg["mail"]["deEmail"] = "noreply@mexbest.com";
//$cfg["emailStaff"] = "mexbest@mexbest.com";

?>
