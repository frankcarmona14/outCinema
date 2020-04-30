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

    include 'ConexionBD.php';
    $usuario = new ConexionBD($servidor, $usuario, $pass, $base_datos);
    $usuario->query("SELECT * FROM butacasvendidas WHERE nom_usuario='$username' AND pelicula='$pelicula' AND fecha='$fecha' AND hora='$hora'");

    //GENERAR CODIGO QR
    $textqr = "ENTRADAS VENDIDAS"; //Recibo la variable pasada por post
    $sizeqr = "200"; //Recibo la variable pasada por post
    include 'mPDF/autoload.php'; //Llamare el autoload de la clase que genera el QR
    use Endroid\QrCode\QrCode;
    
    $qrCode = new QrCode($textqr); //Creo una nueva instancia de la clase
    $qrCode->setSize($sizeqr); //Establece el tamaño del qr
    //header('Content-Type: '.$qrCode->getContentType());
    $image = $qrCode->writeString(); //Salida en formato de texto
    
    $imageData = base64_encode($image); //Codifico la imagen usando base64_encode
    
    //echo '<img src="data:image/png;base64,' . $imageData . '">';


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
    $mpdf->WriteHTML("<img src='data:image/png;base64,$imageData'><br><br>");
    $mpdf->WriteHTML("<span><b>".$username."</b></span><br><br>");
    $mpdf->WriteHTML("<h1>".$pelicula."</h1>");
    $mpdf->WriteHTML("<span>".$fecha."</span><span> - ".$hora."</span><br><br>");
    $mpdf->WriteHTML("<table border=1>");
    $mpdf->WriteHTML("<tr><td>Fila/Butaca</td><td>Tipo Entrada</td><td>Precio</td></tr>");
    while ($row = $usuario->extraer_registro()) {
            $mpdf->WriteHTML("<tr><td>". $row['butaca'] . "</td>");
            $mpdf->WriteHTML("<td>Normal</td><td>8.00 €</td></tr>");
    }
$mpdf->WriteHTML("</table></body></html>");
$mpdf->Output();