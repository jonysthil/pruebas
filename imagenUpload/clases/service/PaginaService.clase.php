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

    function index($_VAR) {
        $smarty = new Smarty();

        $smarty->display('string:' . file_get_contents($this->dirPlantillas . "index.html"));
    }

    function subirImagen($_VAR) {
        $oCIS = new CargarImagenService();
        $valida = $oCIS->subirImagen($_VAR);

        if($valida == "god") {
            header("Location: index.html?v=god");
        } elseif ($valida == "grande") {
            header("Location: index.html?v=peso");
            //echo "El tamaño de la imagen es muy grande";
        } elseif ($valida == "formato") {
            header("Location: index.html?v=tipo");
            //echo "El formato no es valido";
        }
    }

}

?>