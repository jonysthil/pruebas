<?php

//echo $_SERVER["HTTP_HOST"];

if ($_SERVER["HTTP_HOST"] == "127.0.0.1" || $_SERVER["HTTP_HOST"] == "localhost") {
    $cfg["db"]["servidor"] = "127.0.0.1";
    $cfg["db"]["baseDeDatos"] = "openpay";
    $cfg["db"]["usuario"] = "root";
    $cfg["db"]["clave"] = "angel.76";
    $cfg["dir"] = "http://localhost/openpay/";
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



// Configuración de llaves privadas y publicas del openpay.

// Llaves de openpay.
$cfg["openpay"]["id"] = "ma1cuvd3onsyjspxa8dp";
$cfg["openpay"]["llavePrivada"] ="sk_4707cccf975743c2ab62088580563ad0";
$cfg["openpay"]["llavePublica"] = "pk_9391fa8e512642059fcd265148cc5f09";

// Planes.
$cfg["openpay"]["plan500"]  = "p3odwoysv1mf7klyucqm";
$cfg["openpay"]["plan1000"] = "p6vulv8xt5usoucoa3aa";
?>
