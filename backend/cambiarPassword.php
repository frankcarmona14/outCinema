<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    session_start(); //Se abre un formulario para que el usuario introduzca su nueva contraseña.
    ?>
    <form action='cambiarPassword.php' method='POST'>
        <span>Por favor,<b> <?php echo $_SESSION['user_email']; ?></b> establezca su nueva contraseña: </span><input type='password' name='pass'><br>
        <span>Repita la contraseña: </span><input type='password' name='newPass'><br><br>
        <input type='submit' name='cambiar' value='Cambiar Contraseña'>
    </form>

    <?php

    if (isset($_POST['cambiar'])) {
        $newPass = $_POST['newPass'];
        $email = $_SESSION['user_email'];
        $new_encript_pass = password_hash($newPass, PASSWORD_BCRYPT); //Se encripta la contraseña antes de registrarla en la BD.
        include 'ConexionBD.php';
        $usuario = new ConexionBD($servidor, $usuario, $pass, $base_datos);
        $usuario->query("UPDATE usuario SET password='$new_encript_pass' WHERE email='$email';"); //Se actualiza su contraseña en la BD, y se redirecciona al inicio para que pueda hacer log in con su correo y su nueva contraseña.
        echo "<script>alert('Contraseña actualizada. Ya puede iniciar sesión con su correo y su nueva contraseña.'); window.location.href='../login.php';</script>";
    }

    ?>
</body>

</html>