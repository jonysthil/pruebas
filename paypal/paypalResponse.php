<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);
		
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
		
require "config/config.php";
require "clases/PayPalService.clase.php";
require "libs/PayPalApi/vendor/autoload.php";


// Archivo de respuesta de paypal.
if( isset($_REQUEST["success"],$_REQUEST["paymentId"],$_REQUEST["PayerID"]) )
{
	if( (bool)$_REQUEST["success"]===true )
	{
		$oPayPal = new PayPal();
		$data = $oPayPal->pagoRespuesta($_REQUEST);

		if( $data!=false )
		{
			echo "id:      ".$data->id."<br>";
			echo "Estatus: ".$data->state."<br>";
			echo "Amount:  ".$data->transactions[0]->amount->total." ".$data->transactions[0]->amount->currency."<br>";
			echo "Fecha:   ".$data->create_time."<br>";

			echo "Pedido: ".$data->transactions[0]->invoice_number."<br>";
			echo "Descripcion: ".$data->transactions[0]->description."<br>";
			echo "Productos: ".$data->transactions[0]->item_list->items[0]->name."<br>";

		}
		else
		{
    		echo $oPayPal->obtenerError();
		}
	}
	else
	{
		echo "El pago no ha sido procesado.";
	}
}
else
{
	echo "El pago no ha sido procesado.";
}

?>