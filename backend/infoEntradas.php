<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de la Compra</title>
</head>

<body>
    <h1>¡Hemos terminado con la compra de sus entradas!</h1>
    <?php
    session_start();
    include 'Cookies.php';
    $cookies = new Cookies();
    $username = $cookies->desencriptar($_SESSION['user_name'], 'k123');
    $id_transaccion = $_SESSION['id_transaccion'];
    $pelicula = $_SESSION['pelicula'];
    $fecha = $_SESSION['fecha'];
    $hora = $_SESSION['hora'];
    echo "<span>Gracias por su compra, " . $username . ", le adjuntamos la información de sus entradas:</span><br><br>";

    require_once 'ConnectionDB.php';

    $query = $pdo->prepare("SELECT * FROM butacasvendidas WHERE id_transaccion='$id_transaccion' AND nom_usuario='$username' AND pelicula='$pelicula' AND fecha='$fecha' AND hora='$hora';");
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Película</th><th>Fecha</th><th>Hora</th><th>Fila/Butaca</th></tr>";
        foreach ($results as $result) {
            echo "<tr>";
            echo "<td>" . $result->pelicula . "</td>";
            echo "<td>" . $result->fecha . "</td>";
            echo "<td>" . $result->hora . "</td>";
            echo "<td>" . $result->butaca . "</td>";
            echo "</tr>";
        }
        echo "</table><br>";
    }
    ?>
    <a href='imprimirPDF.php'>Ver entradas en PDF</a>
    <br><br><a href='../index.php'>Volver al inicio</a>
</body>

</html>