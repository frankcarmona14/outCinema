<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='../forms/style.css'>
    <link rel="stylesheet" href="../src/styles/tablesStyle.css">
    <title>Datos de la Compra</title>
    <style>
        th,
        td {
            width: 15%;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    require_once __DIR__ . '/vendor/autoload.php';
    include 'Cookies.php';
    $cookies = new Cookies();
    $username = $cookies->desencriptar($_SESSION['user_name'], 'k123');
    $user_id = $cookies->desencriptar($_SESSION['user_id'], 'k123');
    $id_transaccion = $_SESSION['id_transaccion'];
    $pelicula = $_SESSION['pelicula'];
    $fecha = $_SESSION['fecha'];
    $hora = $_SESSION['hora'];
    require_once 'ConnectionDB.php';
    $query = $pdo->prepare("SELECT * FROM butacasvendidas WHERE id_transaccion='$id_transaccion' AND nom_usuario='$username' AND pelicula='$pelicula' AND fecha='$fecha' AND hora='$hora';");
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    ?>
    <center>
        <div class="table-responsive">
            <table>
                <h2>¡Hemos terminado con la compra de tus entradas!</h2>
                <thead>
                    <tr>
                        <th>Fila/Butaca</th>
                        <th>Tipo de Entrada</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo "<p>Gracias por tu compra, " . $username . ". A continuación, te adjuntamos la información de sus entradas:</p><br>";
                    echo "<h3>$pelicula</h3>";
                    echo "<b>$fecha</b><br><br>";
                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) {
                            echo "<tr>";
                            echo "<td data-title='Fila/Butaca'>" . $result->butaca . "</td>";
                            echo "<td data-title='Tipo de Entrada'>" . $result->tipo_entrada . "</td>";
                            echo "<td data-title='Precio'>" . $result->precio . "€</td>";
                            echo "</tr>";
                        }
                        echo "</tbody></table>";
                    }
                    $textqr = "https://192.168.1.41/outCinema/backend/escanearEntradas.php?id=$id_transaccion";
                    $sizeqr = "200";

                    use Endroid\QrCode\QrCode;

                    $qrCode = new QrCode($textqr);
                    $qrCode->setSize($sizeqr);

                    $image = $qrCode->writeString();
                    $imageData = base64_encode($image);

                    echo '<img src="data:image/png;base64,' . $imageData . '">';
                    echo "<br><br>Localizador: <b>$id_transaccion</b><br><br>";
                    ?>
                    <a id='verPDF' href='EntradasConfirmadas/<?php echo $id_transaccion; ?>.pdf' target="_blank"><button class="btn btn-green" name='verPDF'>Ver entradas en PDF</button></a><br>
                    <br><a href='../index.php'>Volver al inicio</a><br><br>
        </div>
    </center>

    <?php
    if (!isset($_REQUEST['resumen'])) {
        $user_e = $cookies->desencriptar($_SESSION['user_email'], 'k123');
        $_SESSION['user_email'] = $user_e;

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML("<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='../forms/style.css'>
        <title>Entradas - $username</title><style>
            h1{color:black;}
            img{margin-left: 33.5%;}
            p{text-align: center;}
            table{margin-left:6%;width: 600px;text-align:center;border: 1px solid;}
            th{background-color: rgb(28, 54, 67);color: #FFF;}
            tr{border: 1px solid;}</style>
    </head>
    <body>");
        $mpdf->WriteHTML("<span>Confirmación&nbsp;&nbsp; - &nbsp;&nbsp;" . date("d") . "/" . date("m") . "/" . date("Y") . "</span><br><br>");
        $mpdf->WriteHTML("<span>Agradecemos mucho tu preferencia " . $username . ". A continuación, te adjuntamos la información de tu compra: </span>");
        $mpdf->WriteHTML("<img align='center' src='data:image/png;base64,$imageData'>");
        $mpdf->WriteHTML("<p><b>" . $id_transaccion . "</b></p>");
        $mpdf->WriteHTML("<h1>" . $pelicula . "</h1>");
        $mpdf->WriteHTML("<h3>" . $fecha . " - " . $hora . "</h3>");
        $mpdf->WriteHTML("<table><tr><th>Fila/Butaca</th><th>Tipo de Entrada</th><th>Precio</th></tr>");
        foreach ($results as $result) {
            $mpdf->WriteHTML("<tr><td>" . $result->butaca . "</td>");
            $mpdf->WriteHTML("<td>" . $result->tipo_entrada . "</td>");
            $mpdf->WriteHTML("<td>" . $result->precio . "€</td></tr>");
        }
        $mpdf->WriteHTML("</table><br><br><br><span>Para validar tus entradas: </span><br><br>");
        $mpdf->WriteHTML("<b>Con tu smartphone: </b>Ten preparado en la pantalla de tu smartphone el código QR adjunto. Dirígete directamente a la entrada
    de las salas y escanea el código en el control de acceso de los pasillos para acceder. Para utilizar tu
    smartphone confirma que el documento se ha descargado correctamente y que la luminosidad de la pantalla
    está al máximo. El código QR tiene que verse completo.<br><br>");
        $mpdf->WriteHTML("<b>Documento impreso: </b>Imprime este justificante para poder acceder directamente a la sala. Escanea tú mismo el código QR adjunto en el control de acceso de los pasillos.<br><br>");
        $mpdf->WriteHTML("<b>Código del justificante: </b>Acércate al personal de control de acceso e indícales el código alfanumérico adjunto debajo del código QR escaneable.");
        $mpdf->WriteHTML("</body></html>");
        $mpdf->Output('EntradasConfirmadas/' . $id_transaccion . '.pdf', 'F');
        echo "<script>window.location.href='enviarCorreo.php?motivo=enviarEntradas';</script>";
    }
    ?>
</body>

</html>