<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../forms/style.css">
    <title>Document</title>
    <script src="../forms/validarFormularios.js"></script>
</head>

<body>
    <?php
    session_start(); //Se abre un formulario para que el usuario introduzca su nueva contraseña.
    ?>

    <div class="form__login">
        <div class="form-container">
            <div class="loginEmail">
                <form action='cambiarPassword.php' method='POST'>
                    <div class="formInput">
                        <span>Por favor, establezca una nueva contraseña para su cuenta: </span><br><br>
                        <input id="pass1" type="password" name="pass" required="required" class="formInput-field" /><br>
                        <p id="pass1E" class="formInput-error" id=""></p>
                    </div>
                    <div class="formInput">
                        <span>Repita la contraseña: </span><br><br>
                        <input id="pass2" type="password" name="newPass" required="required" class="formInput-field" /><br>
                        <p id="pass2E" class="formInput-error" id=""></p>
                    </div>
                    <input id="cambiarPass" type='submit' name='cambiar' class="btn btn-green" value='Cambiar Contraseña'>
                </form>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['cambiar'])) {
        $newPass = $_POST['newPass'];
        $email = $_SESSION['user_email'];
        $new_encript_pass = password_hash($newPass, PASSWORD_BCRYPT); //Se encripta la contraseña antes de registrarla en la BD.

        require_once 'ConnectionDB.php';

        $consulta = "UPDATE usuario SET password=? WHERE email=?;";

        $registro = $pdo->prepare($consulta);
        $registro->execute([$new_encript_pass, $email]);
        if ($registro) {
            echo "<script>alert('Contraseña actualizada. Ya puede iniciar sesión con su correo y su nueva contraseña.'); window.location.href='../login.php';</script>";
        } else {
            echo "<script>alert('Algo ha salido mal al intentar cambiar tu contraseña. Vuelve a intentarlo más tarde.');</script>";
        }
    }
    ?>
</body>

</html>