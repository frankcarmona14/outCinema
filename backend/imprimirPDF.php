<?php

require_once __DIR__ . '/mPDF/autoload.php';

$mpdf = new \Mpdf\Mpdf();
//$mpdf->WriteHTML('<h1>¡Hola, Mundo!</h1>');
$mpdf->WriteHTML("<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
    <style>
        h1{
            color:red;
        }
    </style>
</head>
<body>
    <h1>Prueba de HTML dentro del PDF</h1>
</body>
</html>");
$mpdf->Output();