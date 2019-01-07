<?php

include_once "./phpqrcode/qrlib.php";
 
// --- url
$qr = uniqid();
$url = $_POST["qrUrl"];
$nivel = $_POST["qrNivel"];
$tamano = $_POST["qrTamano"];

$filepath = "temp/".$qr.".png";

if ($_FILES["qrLogo"]["name"] != "") {
    $dir_subida = 'icono/';
    $fichero_subido = $dir_subida . basename($_FILES['qrLogo']['name']);
    if (move_uploaded_file($_FILES['qrLogo']['tmp_name'], $fichero_subido)) {
        $logopath = $dir_subida . basename($_FILES['qrLogo']['name']);
    }
}
 
QRcode::png($url, $filepath, QR_ECLEVEL_.$nivel, $tamano, 2);

if ($_FILES["qrLogo"]["name"] != "") {

    $QR = imagecreatefrompng($filepath);

    // START TO DRAW THE IMAGE ON THE QR CODE
    $logo = imagecreatefromstring(file_get_contents($logopath));
    $QR_width = imagesx($QR);
    $QR_height = imagesy($QR);

    $logo_width = imagesx($logo);
    $logo_height = imagesy($logo);

    // Scale logo to fit in the QR Code
    $logo_qr_width = $QR_width/3;
    $scale = $logo_width/$logo_qr_width;
    $logo_qr_height = $logo_height/$scale;

    imagecopyresampled($QR, $logo, $QR_width/3, $QR_height/3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

    // Save QR code again, but with logo on it
    imagepng($QR,$filepath);
    // outputs image directly into browser, as PNG stream
    //readfile($filepath);
}
header("Location: index.php?qr=".$qr);

?>