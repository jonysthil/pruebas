<?php
require "vendor/autoload.php";

define("SITE_URL","http://");

// https://developer.paypal.com/
//guerreroangel@hotmail.com
//App: Prueba1

$paypal = new \PayPal\Rest\ApiContext(
	new \PayPal\Auth\OAuthTokenCredential(
		'AVSQv7S09Q-Ie7HtjLD2D8xMUfalNqT9lzTpsY26dUL915ZclODLk5Fr8-ZqL0ALq5p8axkOCUwfCPbP',
		'EMqRklI3zpq0ZJyYrBD0lFJItU-j1D53q-jMX32kuv6b42XW70l6wsT4_D4gsY7Dcx0XTTpd872VuJMI'
	)
);

?>