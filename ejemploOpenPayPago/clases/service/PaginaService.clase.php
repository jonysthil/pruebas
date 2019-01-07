<?php

class PaginaService {

    var $dirPlantillas;
    var $cfg;

    function __construct() {
        $this->dirPlantillas = "./templates/";
        global $cfg;
        $this->cfg = $cfg;
    }

    function obtenerPagina($url) {
        $url = str_replace(".html", "", $url);
        $url = str_replace(".php", "", $url);
        $url = explode("/", $url);
        $url = $url[count($url) - 1];
        $url = explode("?", $url);

        return $url[0];
    }

    function index($_VAR)
    {
        Global $cfg;
        $smarty = new Smarty();

        $smarty->assign("id",     $cfg["openpay"]["id"]);
        $smarty->assign("apiKey", $cfg["openpay"]["llavePublica"]);




        $smarty->display('string:' . file_get_contents($this->dirPlantillas . "index.html"));
    }

    function pagarPedido($_VAR)
    {
        $oDB = new ConexionService();
        $oOP = new OpenpayPagoService($oDB);
        $rst = $oOP->realizarCargo($_VAR);
        $oDB->desconectar();

        if( $rst==true ){
            header("location: ./index.php?msg=payok");
        }else{
            header("location: ./index.php?msg=".$oOP->obtenerError());
        }
    }
}

?>