<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/styles/style.css">
    <title>Elegir Butacas</title>
    <style>
        input[type='image'] {
            height: 25px;
            width: 20px;
            margin: 0 -5px 0 0;
        }

        #estadoButaca {
            height: 25px;
            width: 20px;
            margin: 5px 25px -5px 0;
        }

        .pantalla{
            display: flex;
            font-weight: bolder;
            justify-content: center;
            align-items: center;
            background-color: #4682b4;
            width: 60vw;
            color: gainsboro;
            height: 30px;
        }
    </style>
    <?php
    session_start();
    $_SESSION['elegirButacas']++;
    $_SESSION['visitarVenta'] = 0;
    $numEntradas = $_COOKIE['numEntradas'];
    $peli = $_COOKIE['pelicula'];
    $fecha = $_COOKIE['fecha'];
    $hora = $_COOKIE['hora'];
    echo "<script>";
    echo "sessionStorage.setItem('numEntradas', '$numEntradas');";
    echo "sessionStorage.setItem('peli', '$peli');";
    echo "sessionStorage.setItem('fecha', '$fecha');";
    echo "sessionStorage.setItem('hora', '$hora');";
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
            <div class="info">
                <span>Disponibles: </span><img src='src/img/butacaDisponible.png' id='estadoButaca'>
                <span>Ocupadas: </span><img src='src/img/butacaOcupada.png' id='estadoButaca'>
                <span>Seleccionadas: </span><img src='src/img/butacaSeleccionada.png' id='estadoButaca'>
            </div><br>
            <?php
            require "backend/imprimirButacas.php";
            ?>
            <span class="pantalla">PANTALLA</span>
        </div><br>
        <form action='realizarPago.php'>
            <input type='submit' id='pagar' class="btn btn-continuar" value='Seleccionar'>
        </form>
    </center>

    <script src='src/utils/elegirButacas.js'></script>
    <script src='src/utils/comprobarButacasVendidas.js'></script>
    <?php
    if ($_SESSION['elegirButacas'] <= 2) {
        echo "<script>window.location.reload();</script>";
    }
    ?>
</body>

</html>