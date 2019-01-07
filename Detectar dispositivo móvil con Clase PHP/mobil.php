<?php
//Incluir el fichero user_agent
include_once 'user_agent.php';

//La creacion de una instancia de la clase UserAgent
$movil= new UserAgent();

//Si detecta que ingresaron via movil, redireeciona a una pagina apto para dispositivo movil
if($movil->is_mobile()){
    header("Location:http://m.baulphp.com");
    exit;
} else {
    echo "no es movil";
}
?>
