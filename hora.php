<?php

if(isset($_GET["envia"])) {
    print_r($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <form action="hora.php?envia" method="POST">

    <input type="date" name="fecha">
    
    <input type="submit" value="Enviar">

    </form>

</body>
</html>