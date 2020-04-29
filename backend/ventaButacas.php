<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de la Compra</title>
    <?php
    session_start();
    $_SESSION['visitarVenta']++;
    if ($_SESSION['visitarVenta'] == 1) {
        echo "<script src='../src/utils/enviarDatos.js'></script>";
        //echo "<script>window.location.href='ventaButacas.php';</script>";
        echo "<script>window.location.reload();</script>";
    }
    ?>
</head>

<body>
    <h1>¡Hemos terminado con la compra de sus entradas!</h1>
    <?php
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

    echo "<table border='1'>";
    echo "<tr><th>Película</th><th>Fecha</th><th>Hora</th><th>Fila/Butaca</th></tr>";
    while ($row = $usuario->extraer_registro()) {
        echo "<tr>";
        echo "<td>" . $row['pelicula'] . "</td>";
        echo "<td>" . $row['fecha'] . "</td>";
        echo "<td>" . $row['hora'] . "</td>";
        echo "<td>" . $row['butaca'] . "</td>";
        echo "</tr>";
    }
    echo "</table><br>";
    ?>
    <a href='imprimirPDF.php'>Ver entradas en PDF</a>
    <br><br><a href='../index.php'>Volver al inicio</a>
</body>

</html>