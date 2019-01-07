<?php
if(isset($_FILES["file"]["type"]))
{
$validextensions = array("jpeg", "jpg", "png");
$temporary = explode(".", $_FILES["file"]["name"]);
$file_extension = end($temporary);
if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
) && ($_FILES["file"]["size"] < 100000)//Approx. 100kb files can be uploaded.
&& in_array($file_extension, $validextensions)) {
if ($_FILES["file"]["error"] > 0)
{
echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
}
else
{
if (file_exists("upload/" . $_FILES["file"]["name"])) {
echo $_FILES["file"]["name"] . " <span id='invalid'><b>Archivo ya existe.</b></span> ";
}
else
{
$sourcePath = $_FILES['file']['tmp_name']; // Ruta del fichero
$targetPath = "upload/".$_FILES['file']['name']; // Destino de la imagen cargada
move_uploaded_file($sourcePath,$targetPath) ; // Mover el fichero a destino
echo "<span id='success'>Imagen subida satisfactoriamente...!!</span><br/>";
echo "<br/><b>Arhivo:</b> " . $_FILES["file"]["name"] . "<br>";
echo "<b>Tipo:</b> " . $_FILES["file"]["type"] . "<br>";
echo "<b>Tamaño:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
echo "<b>Archivo temporal:</b> " . $_FILES["file"]["tmp_name"] . "<br>";
}
}
}
else
{
echo "<span id='invalid'>***Tamaño de Archivo Invalido y/o tipo de archivo incorrecto***<span>";
}
}
?>