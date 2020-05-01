<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="forms/style.css" />
    <title>Recuperación de Contraseña</title>
</head>

<body>
    <div class="form__login">
        <div class="form-container">
            <div class="loginEmail">
                <form action='recuperacion.php' method='POST'>
                    <div class="formInput">
                        <span>Introduzca el correo electrónico con el que se registró en la app: </span><br><br>
                        <input type="email" name="email" id="email" placeholder="Tu email" required="required" class="formInput-field" />
                        <p class="formInput-error" id="emailE"></p>
                    </div>
                    <input type='submit' class="btn btn-green" name='Enviar' value='Enviar'>
                </form><br>
                <a href='login.php'>Iniciar Sesión</a><br>
            </div>
            <div class="accountFooter">
                <span>¿Aún no tienes una cuenta?</span>
                <div class="accountFooter-link">
                    <a href="registro.php"><button class="btn btn-account">Regístrate</button></a>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
if (isset($_POST['Enviar'])) {

    session_start();

    $email = $_POST['email'];
    include 'backend/ConexionBD.php';
    $usuario = new ConexionBD($servidor, $usuario, $pass, $base_datos);
    $usuario->query("SELECT * FROM usuario;");
    $comprobante = false;
    while ($row = $usuario->extraer_registro()) {
        if ($email == $row['email']) { //Se comprueba que el corre introducido corresponda a un usuario de la aplicación.

            include 'backend/GenerarCodigo.php';
            $codigoRandom = new CodigoRandom();

            $_SESSION['user_email'] = $email; //Se guarda el correo en sesión
            $_SESSION['codigoRandom'] = $codigoRandom->generarCodigoRandom(); //Y también la cadena de caracteres generada como código de acceso.

            $comprobante = true;
            break;
        }
    }
    if ($comprobante) {
        header("Location: backend/enviarCorreo.php?motivo=cambiarPassword"); //Si el correo existe, redireccionamos.
    } else { //Si no, tiene que introducir uno válido.
        echo "<script>alert('El correo introducido no está asociado a ninguna cuenta en OutCinema. Por favor, introduzca un correo válido.');</script>";
    }
}
?>

</html>