<?php
include_once "conexion.php";

$sql = "INSERT INTO imagenProyecto (
            idImagen,
            idProveedor,
            tagPositionX,
            tagPositionY)
        VALUE (
            '".$_POST['idImagen']."',
            '".$_POST['idProveedor']."',
            '".$_POST['tagPositionX']."',
            '".$_POST['tagPositionY']."')";
//echo $sql;
$result = mysqli_query($mysqli, $sql);

if ($result) {
    header("Location: index.php");
}

?>