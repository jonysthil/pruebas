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

    //------------------------------------------------------------

    function pagarPedido($_VAR)
    {
        //$oDB = new ConexionService();
        $oOP = new OpenpayPagoService(null);
        $charge = $oOP->realizarCargo($_VAR);
        //$oDB->desconectar();

        if( $charge!=null )
        {
            header("location: ".$charge->payment_method->url."");
        }

    }

    function pagarPedidoRespuesta($_VAR)
    {
        $oOP = new OpenpayPagoService(null);
        $charge = $oOP->realizarCargoComprobar($_VAR["id"]);

        if( $charge!=null )
        {
            /*
			$oPS = new PedidoService($this->oDB);
			$oPS->actualizarPedido($_VAR,$charge);
            */

            echo "id: ".$charge->id."<br>\n\n";
			echo "status: ".$charge->status."<br>\n\n";
			echo "amount: ".$charge->amount."<br>\n\n";
			echo "authorization: ".$charge->authorization."<br>\n\n";
			echo "currency: ".$charge->currency."<br>\n\n";
        }
    }

    //------------------------------------------------------------

    function pagarSuscripcion($_VAR)
    {
        //$oDB = new ConexionService();
        $oOP = new OpenpaySuscripcionService(null);
        $rst = $oOP->suscribir($_VAR);
        //$oDB->desconectar();


        /*
        if( $rst==true ){
            header("location: ./index.php?msg=payok");
        }else{
            header("location: ./index.php?msg=".$oOP->obtenerError());
        }
        */
    }

    function pagarSuscripcionRespuesta($_VAR)
    {
        //$oDB = new ConexionService();
        $oOP = new OpenpaySuscripcionService(null);
        $rst = $oOP->suscribirRespuesta($_VAR);
        //$oDB->desconectar();

        //print_r($rst);

        /*
        if( $rst==true ){
            header("location: ./index.php?msg=payok");
        }else{
            header("location: ./index.php?msg=".$oOP->obtenerError());
        }
        */
    }

    function webhook()
    {
        /*
        $oOP = new OpenpayWebhookService(null);
        $oOP->validar($_VAR);
        */


        $oDB = new ConexionService();
        $oOP = new OpenpayWebhookService($oDB);
        $rst = $oOP->exec($_VAR);
        $oDB->desconectar();
    }

    //------------------------------------------------------------

}

?>