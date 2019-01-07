<?php

$data="";

if( $_GET["pais"]=="1" ){
	$data='[{"stdId":"1","stdNombre":"DF"},{"stdId":"2","stdNombre":"Guanajuato"}]';
}

if( $_GET["pais"]=="2" ){
	$data='[{"stdId":"1","stdNombre":"Texas"},{"stdId":"2","stdNombre":"California"}]';
}


header('Content-Type: application/json');
//echo json_encode($data);
echo $data;

?>