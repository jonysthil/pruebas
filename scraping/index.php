
<?php 
$data = file_get_contents('https://customcoding.com.mx/'); //Convierte la información de la URL en cadena


preg_match('/<title>([^<]+)<\/title>/i', $data, $matches);
$title = $matches[1];

preg_match('/<img[^>]*src=[\'"]([^\'"]+)[\'"][^>]*>/i', $data, $matches);
$img = $matches[1];

echo $title."<br>\n";
echo $img;
?>
