<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../forms/style.css">
    <title>Agregar nuevo tipo de Entrada</title>
</head>

<body>
    <div class="form__login">
        <div class="form-container">
            <div class="loginEmail">
                <h2>Agregar nuevo tipo de Entrada</h2>
                <br><p>Introduce el nuevo tipo de entrada que quieres agreagar y establece su precio.</p>
                <form action='agregarTipoEntrada.php' method='POST'>
                    <br>
                    <div class="formInput">
                        <input type="text" name="tipo" placeholder="Tipo de entrada" required="required" class="formInput-field" />
                        <p class="formInput-error" id=""></p>
                    </div>
                    <div class="formInput">
                        <input type="number" name="precio" placeholder="Precio" required="required" class="formInput-field" />
                        <p class="formInput-error" id=""></p>
                    </div>
                    <input type='submit' class="btn btn-green" name='agregar' value='Agregar'>
                </form><br>
                <a href='../panelAdministrativo.php'>Volver al Panel Administrativo</a>
            </div>
        </div>
    </div>

    <?php
    require 'ConnectionDB.php';
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