<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);
		
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
		
require "config/config.php";
require "clases/PayPalService.clase.php";
require "libs/PayPalApi/vendor/autoload.php";

$oPayPal = new PayPal();
$rst = $oPayPal->pagar($_REQUEST);

if( $rst==false )
{
    echo $oPayPal->obtenerError();
}

?>