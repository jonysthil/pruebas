<?php


$arreglo = array(
    0 => array(
        'prodId' => '51',
        'pedprodId' => '',
        'stsId' => '1',
        'mrcId' => '3',
        'catId' => '13',
        'gooId' => '5870',
        'prodModelo' => '440403A',
        'prodSku' => '440403A',
        'prodNombre' => 'Mueller Barra Antideslumbrante ',
        'prodTalla' => '2 cm x 4 cm',
        'prodColor' => 'Negro',
        'prodSexo' => 'Unisex',
        'prodPeso' => '0.01',
        'prodPrecio' => '99.00',
        'prodPrecioOferta' => '79.00'
    ),
    1 => array(
        'prodId' => '51',
        'pedprodId' => '',
        'stsId' => '1',
        'mrcId' => '3',
        'catId' => '13',
        'gooId' => '5870',
        'prodModelo' => '440403A',
        'prodSku' => '440403A',
        'prodNombre' => 'Mueller Barra Antideslumbrante ',
        'prodTalla' => '2 cm x 4 cm',
        'prodColor' => 'Negro',
        'prodSexo' => 'Unisex',
        'prodPeso' => '0.01',
        'prodPrecio' => '99.00',
        'prodPrecioOferta' => '79.00'
    ),
    2 => array(
        'prodId' => '51',
        'pedprodId' => '',
        'stsId' => '1',
        'mrcId' => '3',
        'catId' => '13',
        'gooId' => '5870',
        'prodModelo' => '440403A',
        'prodSku' => '440403A',
        'prodNombre' => 'Mueller Barra Antideslumbrante ',
        'prodTalla' => '2 cm x 4 cm',
        'prodColor' => 'Negro',
        'prodSexo' => 'Unisex',
        'prodPeso' => '0.01',
        'prodPrecio' => '99.00',
        'prodPrecioOferta' => '79.00'
    )
);

/*echo '<pre>';
echo json_encode($arreglo);
die()/
/*echo '<pre>';
print_r($arreglo);
die();*/

$salida = "";

$salida .= "-------- Mostrando en array ------------";
$salida .= "\n";

$salida .= "array(\n";
$i = 0;
foreach($arreglo as $ar) {
    $salida .= "\t[" . $i . "] => array(\n";
    $salida .= "\t\t'prodId' => '" . $ar['prodId'] . "',\n";
    $salida .= "\t\t'pedprodId' => '" . $ar['pedprodId'] . "',\n";
    $salida .= "\t\t'stsId' => '" . $ar['stsId'] . "',\n";
    $salida .= "\t\t'mrcId' => '" . $ar['mrcId'] . "',\n";
    $salida .= "\t\t'catId' => '" . $ar['catId'] . "',\n";
    $salida .= "\t\t'gooId' => '" . $ar['gooId'] . "',\n";
    $salida .= "\t\t'prodModelo' => '" . $ar['prodModelo'] . "',\n";
    $salida .= "\t\t'prodSku' => '" . $ar['prodSku'] . "',\n";
    $salida .= "\t\t'prodNombre' => '" . $ar['prodNombre'] . "',\n";
    $salida .= "\t\t'prodTalla' => '" . $ar['prodTalla'] . "',\n";
    $salida .= "\t\t'prodColor' => '" . $ar['prodColor'] . "',\n";
    $salida .= "\t\t'prodSexo' => '" . $ar['prodSexo'] . "',\n";
    $salida .= "\t\t'prodPeso' => '" . $ar['prodPeso'] . "',\n";
    $salida .= "\t\t'prodPrecio' => '" . $ar['prodPrecio'] . "',\n";
    $salida .= "\t\t'prodPrecioOferta' => '" . $ar['prodPrecioOferta'] . "',\n";
    $salida .= "\t),\n";
    $i++;

}
$salida .= ")";

$salida .= "\n\n";

$salida .= "-------- Mostrando en json ------------";
$salida .= "\n";

$salida .= json_encode($arreglo);

$nombre = "archivo.txt";
$archivo= fopen("./".$nombre, "w+");
fwrite($archivo, $salida);
fclose($archivo);

echo '<pre>';
print_r($salida);



?>