<?php
// Mostrar los errores de PHP.
error_reporting(E_ALL);
ini_set('display_errors', '1');

date_default_timezone_set("Mexico/General");
setlocale(LC_ALL, "es_MX");
setlocale(LC_MONETARY, "es_MX");
header('Content-Type: text/html; charset=utf-8');
header('Content-language: es');
setlocale(LC_TIME, 'spanish');

include "config/config.php";
include "libs/Openpay/config.php";

include "clases/service/ConexionService.clase.php";
include "clases/service/PaginaService.clase.php";
include "clases/service/PedidoService.clase.php";

include "clases/service/OpenpayPagoService.clase.php";
include "clases/service/OpenpaySuscripcionService.clase.php";
include "clases/service/OpenpayWebhookService.clase.php";

include "clases/service/SuscripcionService.clase.php";

include "libs/Smarty/libs/Smarty.class.php";
//include "libs/Openpay/libs/Smarty.class.php";


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

            case "pagarPedido":
                $oPS->pagarPedido($_REQUEST);
                break;

            case "pagarSuscripcion":
                $oPS->pagarSuscripcion($_REQUEST);
                break;

            case "webhook":
                $oPS->webhook($_REQUEST);
                break;
        }
    }

}

$call = new index();
$call->display();



?>