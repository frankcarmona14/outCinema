<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elegir Butacas</title>
    <style>
        input[type='image'] {
            height: 25px;
            width: 20px;
            margin: 0 -5px 0 0;
        }

        .salaCine {
            width: 32%;
        }

        .salaCine hr {
            height: 6px;
            background-color: #000;
        }

        #estadoButaca {
            height: 25px;
            width: 20px;
            margin: 5px 25px -5px 0;
        }
    </style>
    <?php
    session_start();
    $_SESSION['elegirButacas']++;
    $_SESSION['visitarVenta'] = 0;
    //echo $_SESSION['elegirButacas'];

    $numEntradas = $_COOKIE['numEntradas'];
    $peli = $_COOKIE['pelicula'];
    $fecha = $_COOKIE['fecha'];
    $hora = $_COOKIE['hora'];
    echo "<script>";
    echo "sessionStorage.setItem('numEntradas', '$numEntradas');";
    echo "sessionStorage.setItem('peli', '$peli');";
    echo "sessionStorage.setItem('fecha', '$fecha');";
    echo "sessionStorage.setItem('hora', '$hora');";
    echo "sessionStorage.setItem('registros', '0');";
    echo "</script>";
    ?>
</head>

<body>
    <center>
        <h1>Elija sus butacas: </h1>
        <div class='salaCine'>
            <div>
                <span id='pelicula'></span><br>
                <span id='fecha'></span><br>
                <span id='hora'></span><br>
                <span id='numEntradas'></span><br><br>
            </div>
            <div>
                <span>Disponibles: </span><img src='src/img/butacaDisponible.png' id='estadoButaca'>
                <span>Ocupadas: </span><img src='src/img/butacaOcupada.png' id='estadoButaca'>
                <span>Seleccionadas: </span><img src='src/img/butacaSeleccionada.png' id='estadoButaca'>
            </div><br>
            <?php
            require "backend/imprimirButacas.php";
            ?>
            <hr>
            <span>PANTALLA</span>
        </div><br>
        <form action='backend/infoEntradas.php'>
            <input type='submit' id='pagar' value='Realizar Pago'>
        </form>
    </center>

    <script src='src/utils/elegirButacas.js'></script>
    <script src='src/utils/comprobarButacasVendidas.js'></script>
    <script src='src/utils/enviarDatos.js'></script>
    <?php
    if ($_SESSION['elegirButacas'] <= 2) {
        echo "<script>window.location.reload();</script>";
    }
    ?>
</body>
</html>