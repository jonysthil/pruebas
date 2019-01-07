<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Calcular fecha de nacimiento con PHP</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <link rel="stylesheet" href="style.css" type="text/css" />
         
</head>
    <body>
        <div id="container">
            <div id="body">
                <div class="mainTitle" >Calcular fecha de nacimiento con PHP</div>
                <div class="height10"></div>
               
                 <div class="height10"></div>
                <article>
                    <div style="text-align: left">
<?php

 function Calculando_anyo($fec) {
    $vari = '';
    $vari .= ($fec->invert == 1) ? ' - ' : '';
    if ($fec->y > 0) {
        // Calculando años
        $vari .= ($fec->y > 1) ? $fec->y . ' Años ' : $fec->y . ' Año ';
    } if ($fec->m > 0) {
        // Calculando mes
        $vari .= ($fec->m > 1) ? $fec->m . ' Meses ' : $fec->m . ' Mes ';
    } if ($fec->d > 0) {
        // Calculando dias
        $vari .= ($fec->d > 1) ? $fec->d . ' Dias ' : $fec->d . ' Dia ';
    } if ($fec->h > 0) {
        // Calculando horas
        $vari .= ($fec->h > 1) ? $fec->h . ' Horas ' : $fec->h . ' Hora ';
    } if ($fec->i > 0) {
        // Calculando Minutos
        $vari .= ($fec->i > 1) ? $fec->i . ' Minutos ' : $fec->i . ' Minuto ';
    } if ($fec->s > 0) {
        // Calculando segundos
        $vari .= ($fec->s > 1) ? $fec->s . ' Segundos ' : $fec->s . ' Segundo ';
    }
    echo $vari;
}
?>

<p>Dias transcurridos</p>

<?php
$fecha1 = new DateTime("1993-07-30"); 
$fecha2 = new DateTime("now"); 
$diferencia = $fecha1->diff($fecha2); 
echo Calculando_anyo($diferencia);
?>
                                
                                
                                  <div class="height10"><br><br><br></div>
                                    <div class="title" style="text-decoration: none;font-size:18px;" ><img src="cake.png" alt="" width="32" height="32" > Total de minutos de un rango de fechas</div>
                                  <div class="height10"></div>

<?php
$fecha1 = new DateTime("2012-09-19 18:49:10");
$fecha2 = new DateTime("now"); 
$diferencia = $fecha1->diff($fecha2); // 38 minutes to go [number is variable] 
echo ( ($diferencia->days * 24 ) * 60 ) + ( $diferencia->i ) . ' Minutos'; // passed means if its negative and to go means if its positive 
echo ($diferencia->invert == 1 ) ? ' passed ' : ' Total ';
?>
                  </div>
                </article>
                <div class="height30"></div>
                <footer>
                <br><br>
                    <div class="copyright"></div>
                    <div class="footerlogo">
                    Ir a la Pagina del Ejemplo <a href="http://www.baulphp.com/calcular-fecha-de-nacimiento-con-php/">Calcular fecha de nacimiento con PHP</a>
                    </div>
                </footer>
            </div>
        </div>

    </body>
</html>