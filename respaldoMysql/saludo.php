<?php


//$mysqli = new mysqli('127.0.0.1', 'root', '96XM8F.XcXBFhyA!-', 'respaldo');
//$mysqli = new mysqli('127.0.0.1', 'root', '96XM8F.XcXBFhyA!-');
$mysqli = new mysqli('localhost', 'root', 'pocoyojony12');
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    echo "<br>";
} else {
    echo "conexión exitosa";
    echo "<br>";
}
echo $mysqli->host_info . "\n";

echo "se envio saludo";

$arch = fopen(realpath( '.' )."/cron.log", "a+"); 
fwrite($arch, "[".date("Y-m-d H:i:s")."][success - enviando saludo]\n");
fclose($arch);

?>