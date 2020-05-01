<?php

session_start();

require_once __DIR__ . '/mPDF/autoload.php';

$mpdf = new \Mpdf\Mpdf();

include 'Cookies.php';
$cookies = new Cookies();
$username = $cookies->desencriptar($_SESSION['user_name'], 'k123');
$pelicula = $_SESSION['pelicula'];
$fecha = $_SESSION['fecha'];
$hora = $_SESSION['hora'];
echo "<span>Gracias por su compra, " . $username . ", le adjuntamos la información de sus entradas:</span><br><br>";

require_once 'ConnectionDB.php';
$query = $pdo->prepare("SELECT * FROM butacasvendidas WHERE nom_usuario='$username' AND pelicula='$pelicula' AND fecha='$fecha' AND hora='$hora';");
$query->execute();

$mpdf->WriteHTML("<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
    <style>
        h1{
            color:black;
        }
    </style>
</head>
<body>
    <h1>CONFIRMACIÓN</h1>");
$mpdf->WriteHTML("<span><b>" . $username . "</b></span><br><br>");
$mpdf->WriteHTML("<h1>" . $pelicula . "</h1>");
$mpdf->WriteHTML("<span>" . $fecha . "</span><span> - " . $hora . "</span><br><br>");
$mpdf->WriteHTML("<table border=1>");
$mpdf->WriteHTML("<tr><td>Fila/Butaca</td><td>Tipo Entrada</td><td>Precio</td></tr>");
$results = $query->fetchAll(PDO::FETCH_OBJ);
if ($query->rowCount() > 0) {
    foreach ($results as $result) {
        $mpdf->WriteHTML("<tr><td>" . $result->butaca . "</td>");
        $mpdf->WriteHTML("<td>Normal</td><td>8.00 €</td></tr>");
    }
}
$mpdf->WriteHTML("</table></body></html>");
$mpdf->Output();
