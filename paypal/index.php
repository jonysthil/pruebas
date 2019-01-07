
<html>
<body>

<h2>Resumen de compra</h2>
	
<?php

require "config/config.php";
require "clases/PayPalService.clase.php";
require "libs/PayPalApi/vendor/autoload.php";

$pd_id       = uniqid();
$precioTotal = 99;
$costoEnvio  = 5;

$oPayPal=new PayPal();
echo $oPayPal->boton($pd_id, $precioTotal, $costoEnvio);

?>

<p>Serás direccionado al sitio seguro de PayPal para completar la compra.</p>		

</body>
</html>