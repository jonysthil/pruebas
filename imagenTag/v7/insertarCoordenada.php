<?php
include_once "conexion.php";

if (isset($_POST['saveCoor'])) {
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
}

if (isset($_GET['deleteCoor'])) {
    echo "borrar etiqueta " . $_GET['deleteCoor'];
    $sql = "DELETE FROM imagenProyecto WHERE id = '".$_GET['deleteCoor']."'";
    
    $result = mysqli_query($mysqli, $sql);

    if ($result) {
    header("Location: index.php");
    }
}

?>