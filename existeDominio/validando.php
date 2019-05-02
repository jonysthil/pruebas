<?php

    $buscaweb = $_POST["dominio"];
    $dom = $_POST["dom"];

    /*$dominio[1] = '.com';
    $dominio[2] = '.com.mx';
    $dominio[3] = '.mx';
    //$dominio[4]='.net';
    //$dominio[5]='.org';
    //$dominio[6]='.biz';
    //$dominio[7]='.es';
    
    for ($x=1; $x<4; $x++) {

        $pagina = 'http://www.' . $buscaweb . $dominio[$x];

        $nombre = str_replace('http://www.', '', $pagina);

        if (@fopen($pagina,'r')) {
            echo '<p style="color:red;"><b>'.$nombre.'</b> no disponible</p>';
        } else {
            echo' <p><b>'.$nombre.'</b> esta disponible</p>';
        }
    }*/

    $d1 = "www." . $buscaweb . "." . $dom;

    $r1 = checkdnsrr($d1);

    if ($buscaweb == ' ' || $buscaweb =='') {
        echo "<p class='text-danger'>Ingresa un nombre de dominio.</p>";
    } elseif ($r1 == true) {
        echo "<p class='text-danger'>El dominio <b>" . $d1 . "</b> esta en uso.</p>";
    } else {
        echo "<p class='text-success'>El dominio <b>" . $d1 . "</b> esta disponible.</p>";
    }

    ?>