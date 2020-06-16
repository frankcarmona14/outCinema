<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../forms/style.css">
    <title>Validación de Cuenta</title>
    <script src="../forms/validarFormularios.js"></script>
</head>

<body>
    <div class="form__login">
        <div class="form-container">
            <div class="loginEmail">
                <h2>Validación de Cuenta</h2>
                <?php
                session_start();
                // Estar aquí significa que ya hemos enviado un correo con un código de validación, el cual confirmará el registro del usuario.
                echo "<p>¡Ya casi terminamos de crear tu cuenta!<br>Hemos enviado un código de validación al correo <b>" . $_SESSION['user_email'] . "</b><br>Introduzca ese código para poder validar su cuenta.</p>";
                ?>

                <form action='validarConfirmacion.php' method='POST'>
                    <br>
                    <div class="formInput">
                        <input id="codigo"type="text" name="codigo" placeholder="Tu código" required="required" class="formInput-field" />
                        <p id="codigoE" class="formInput-error" id=""></p>
                    </div>
                    <input id="validar" type='submit' class="btn btn-green" name='enviarCodigo' value='Enviar Código'>
                </form><br>
                <a href='../registro.php'>¿No has recibido ningún correo? ¡Vuelve a intentarlo!</a>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['enviarCodigo'])) {
        if ($_POST['codigo'] == $_SESSION['codigoRandom']) { //Se valida que el código que el usuario introduzca, sea el mismo que le enviamos al correo.
            echo "<script>window.location.href='procesar_registro.php?validado';</script>";
        } else {
            echo "<script>alert('Código inválido. Por favor, introduzca el código que le hemos enviado al correo.');</script>";
        }
    }
    ?>

</body>

</html>