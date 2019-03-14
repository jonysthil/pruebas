<?php
require "vendor/autoload.php";

use Spipu\Html2Pdf\Html2Pdf;

ob_start();
require_once "print_view.php";
$content = ob_get_clean();


$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($content);
$html2pdf->output('prueba-pdf.pdf');

?>