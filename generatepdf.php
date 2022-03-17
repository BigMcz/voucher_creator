<?php
// Require composer autoload
require_once './vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

// Write some HTML code:
$mpdf->WriteHTML('Ahoj Lukáši Hrdličko');
$mpdf->WriteHTML('Tady máš vtip:');
$mpdf->WriteHTML('<br>');

$mpdf->WriteHTML('Víš, jaký je rozdíl mezi Vánoci a tornádem?');
$mpdf->WriteHTML('Žádný, při obou máš strom v obýváku.');

// Output a PDF file directly to the browser
$mpdf->Output();