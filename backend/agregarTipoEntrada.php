<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require 'ConnectionDB.php';
    ?>
    <center>
        <h1>Agregar nuevo tipo de entrada</h1>
        <form action='agregarTipoEntrada.php' method='POST'>
            <table border='1'>
                <tr>
                    <th>Tipo Entrada</th>
                    <th>Precio (€)</th>
                    <th>Agregar</th>
                </tr>
                <tr>
                    <td><input type='text' name='tipo' autofocus></td>
                    <td><input type='number' name='precio'></td>
                    <td><input type='submit' name='agregar' value='Agregar'></td>
                </tr>
            </table>
        </form><br><br>
        <a href='../panelAdministrativo.php'>Volver al panel administrativo</a>
    </center>
    <?php
    if (isset($_POST['agregar'])) {
        $tipo = $_POST['tipo'];
        $precio = $_POST['precio'];

        $datosEntrada = [
            'tipo' => $tipo,
            'precio' => $precio,
        ];
        //$consulta = "INSERT INTO usuario (nombre, num_tel, email, password) VALUES(:nombre, :num_tel, :email, :password);";
        $query = "INSERT INTO precios(tipo, precio) VALUES(:tipo, :precio);";
        $registro = $pdo->prepare($query);
        $registro->execute($datosEntrada);
        if ($registro) {
            echo "<script>alert('El nuevo tipo de entrada ``$tipo`` se ha agregado exitosamente.'); window.location.href='cambiarPrecios.php';</script>";
        } else {
            echo "<script>alert('Error al agregar el nuevo tipo de entrada. Por favor, vuelva a intentarlo más tarde.'); window.location.href='agregarTipoEntrada.php';</script>";
        }
    }
    ?>
</body>

</html>