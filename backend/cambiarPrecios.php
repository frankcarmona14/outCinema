<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../forms/style.css">
    <link rel="stylesheet" href="../src/styles/tablesStyle.css">
    <title>Gestionar Entradas y Precios</title>
</head>

<body>
    <center>
        <?php
        require 'ConnectionDB.php';
        $query = $pdo->prepare("SELECT * FROM precios;");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if (isset($_POST['editar'])) {
            $tipoEntrada = $_POST['editar'];
            $query = $pdo->prepare("SELECT * FROM precios WHERE tipo='$tipoEntrada';");
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            foreach ($results as $result) {
        ?>
                <div class="form__login">
                    <div class="form-container">
                        <div class="loginEmail">
                            <h2>Modificar Datos de la Entrada</h2>
                            <br>
                            <p>Puedes modificar el nombre de la entrada y/o su precio correspondiente.</p>
                            <form action='cambiarPrecios.php' method='POST'>
                                <br>
                                <div class="formInput">
                                    <input type="text" placeholder="Tipo de entrada" required="required" class="formInput-field" name='tipoEntrada' value='<?php echo $result->tipo ?>' />
                                    <p class="formInput-error" id=""></p>
                                </div>
                                <div class="formInput">
                                    <input type="text" placeholder="Precio" required="required" class="formInput-field" name='precioEntrada' value='<?php echo $result->precio ?>' />
                                    <p class="formInput-error" id=""></p>
                                </div>
                                <input type='hidden' name='tipo' value='<?php echo $result->tipo ?>'>
                                <input type='submit' class="btn btn-green" name='confirmarCambios' value='Confirmar Cambios'>
                            </form><br>
                            <a href='cambiarPrecios.php'>Modificar otro tipo de entrada</a><br><br>
                            <a href='../panelAdministrativo.php'>Volver al Panel Administrativo</a>
                        </div>
                    </div>
                </div>

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
        } else {
            ?>
            <div class="table-responsive">
                <form action='cambiarPrecios.php' method='POST'>
                    <table>
                        <h2>Gestionar Entradas y Precios</h2><br>
                        <thead>
                            <tr>
                                <th>Tipo de Entrada</th>
                                <th>Precio Establecido (€)</th>
                                <th>Cambiar Tipo/Precio</th>
                                <th>Eliminar Entrada</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($results as $result) {
                            ?>
                                <tr>
                                    <td data-title="Tipo de Entrada"><?php echo $result->tipo ?></td>
                                    <td data-title="Precio Establecido (€)"><?php echo $result->precio ?></td>
                                    <td data-title="Cambiar Tipo/Precio"><button class="btn btn-green" type='submit' name='editar' value='<?php echo $result->tipo ?>'>Modificar</button></td>
                                    <td data-title="Eliminar Entrada"><button class="btn btn-green" type='submit' name='eliminar' value='<?php echo $result->tipo ?>'>Eliminar</button></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
            <br><a href='../panelAdministrativo.php'>Volver al panel administrativo</a>

        <?php
        }
        ?>
    </center>
</body>

</html>