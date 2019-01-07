<?php
// Mostrar los errores de PHP.
error_reporting(E_ALL);
ini_set('display_errors', '1');

date_default_timezone_set("America/Mexico_City");
setlocale(LC_ALL, "es_MX");
setlocale(LC_MONETARY, "es_MX");
header('Content-Type: text/html; charset=utf-8');
header('Content-language: es');
setlocale(LC_TIME, 'spanish');

include "config/config.php";
include "clases/service/ConexionService.clase.php";
include "clases/service/PaginaService.clase.php";
include "clases/service/CargarImagenService.clase.php";
include "clases/service/HelperService.clase.php";

include ("libs/smarty-3.1.30/libs/Smarty.class.php");


class index {

    public function display() {
        $oPS = new PaginaService();
        $pag = $oPS->obtenerPagina($_SERVER["REQUEST_URI"]);

        // Si no hay página mandamos al index.
        if ($pag == "") {
            $pag = "index";
        }

        switch ($pag) {

            // Home
            case "index":
                $oPS->index($_REQUEST);
                break;

            case "subirImagen":
                $oPS->subirImagen($_REQUEST);
                break;
        }
    }

}

$call = new index();
$call->display();



?>