<?php
$dias= array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
$meses= array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiemre","Octubre","Noviembre","Diciembre");
echo $dias[date('w')]." ".date('d')." de ".date('m') ." del ".date('Y');
echo "<br>";
echo date('Y-m-d H:i:s');
echo "<br>";
$f1 = date('Y-m-d H:i:s');
$f2 = date('2018-04-04 11:02:00');
$datetime1 = new DateTime($f1);
$datetime2 = new DateTime($f2);
$interval = $datetime1->diff($datetime2);
echo $interval->format('%a');
echo "hola";

?>