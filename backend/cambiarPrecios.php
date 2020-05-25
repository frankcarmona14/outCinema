<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Precios</title>
</head>

<body>
    <?php
    require 'ConnectionDB.php';
    $query = $pdo->prepare("SELECT * FROM precios;");
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    ?>
    <center>
        <h1>Gestionar Entradas y Precios</h1>
        <form action='cambiarPrecios.php' method='POST'>
            <table border='1'>
                <tbody>
                    <tr>
                        <th>Tipo Entrada</th>
                        <th>Precio Establecido (€)</th>
                        <th>Cambiar Precio</th>
                        <th>Eliminar Entrada</th>
                    </tr>
                    <?php
                    foreach ($results as $result) {
                        echo "<tr>";
                        echo "<td>$result->tipo</td>";
                        echo "<td>$result->precio</td>";
                        echo "<td><button type='submit' name='editar' value='$result->tipo'>Editar</button></td>";
                        echo "<td><button type='submit' name='eliminar' value='$result->tipo'>Eliminar</button></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </form>
        <?php
        if (isset($_POST['editar'])) {
            echo "<h1>Cambiar: " . $_POST['editar'] . "</h1>";
            $tipoEntrada = $_POST['editar'];
            $query = $pdo->prepare("SELECT * FROM precios WHERE tipo='$tipoEntrada';");
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            foreach ($results as $result) {
        ?>
                <form action='cambiarPrecios.php' method='POST'>
                    <span>Tipo Entrada: </span><input type='text' name='tipoEntrada' value='<?php echo $result->tipo ?>'><br>
                    <span>Precio (€): </span><input type='text' name='precioEntrada' value='<?php echo $result->precio ?>'><br><br>
                    <input type='hidden' name='tipo' value='<?php echo $result->tipo ?>'>
                    <input type='submit' name='confirmarCambios' value='Confirmar Cambios'>
                </form>
        <?php
            }
        } else if (isset($_POST['eliminar'])) {
            $tipo = $_POST['eliminar'];
            $registro = $pdo->prepare("DELETE FROM precios WHERE tipo=?;");
            $registro->execute([$tipo]);
            if ($registro) {
                echo "<script>alert('El tipo de entrada ``$tipo`` ha sido eliminado exitosamente.'); window.location.href='cambiarPrecios.php';</script>";
            } else {
                echo "<script>alert('Algo ha salido mal al intentar eliminar el tipo de entrada. Por favor, vuelva a intentarlo más tarde.');</script>";
            }
        } else if (isset($_POST['confirmarCambios'])) {
            $tipoEntrada = $_POST['tipoEntrada'];
            $precioEntrada = $_POST['precioEntrada'];
            $tipo = $_POST['tipo'];

            $query = "UPDATE precios SET tipo=?, precio=? WHERE tipo=?";
            $registro = $pdo->prepare($query);
            $registro->execute([$tipoEntrada, $precioEntrada, $tipo]);
            if ($registro) {
                echo "<script>alert('Información actualizada.'); window.location.href='cambiarPrecios.php';</script>";
            } else {
                echo "<script>alert('Algo ha salido mal al intentar cambiar el tipo de entrada. Por favor, vuelva a intentarlo más tarde.');</script>";
            }
        }
        ?>
        <br><a href='../panelAdministrativo.php'>Volver al panel administrativo</a>
    </center>
</body>

</html>