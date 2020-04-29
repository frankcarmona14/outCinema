<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>Cambio de Contraseña</h1>
    <?php
    session_start();
    //Estar aquí significa que ya hemos enviado un correo con un código de acceso, el cual le dará permiso para cambiar la contraseña.
    echo "<p>Hemos enviado un código de acceso privisional al correo <b>" . $_SESSION['user_email'] . "</b><br>Introduzca ese código para poder cambiar su contraseña.</p>";
    ?>

    <form action='passwordProvisional.php' method='POST'>
        <span>Código: </span><input type='text' name='codigo'>
        <input type='submit' name='enviarCodigo' value='Enviar Código'>
    </form><br>
    <a href='../recuperacion.php'>¿No has recibido ningún correo? ¡Vuelve a intentarlo!</a>

    <?php
    if (isset($_POST['enviarCodigo'])) {
        if ($_POST['codigo'] == $_SESSION['codigoRandom']) { //Se valida que el código que el usuario introduzca, sea el mismo que le enviamos al correo.
            echo "<script>window.location.href='cambiarPassword.php';</script>";
        } else {
            echo "<script>alert('Código inválido. Por favor, introduzca el código que le hemos enviado a su correo.');</script>";
        }
    }
    ?>

</body>

</html>