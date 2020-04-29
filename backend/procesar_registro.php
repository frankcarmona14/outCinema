<?php
session_start();

include 'ConexionBD.php';
$registro = new ConexionBD($servidor, $usuario, $pass, $base_datos);

if (isset($_REQUEST['validado'])) {
    $nombre = $_SESSION['nombre'];
    $num_tel = $_SESSION['num_tel'];
    $email = $_SESSION["email"];
    $password = $_SESSION["pass"];

    $encript_pass = password_hash($password, PASSWORD_BCRYPT); //Se encripta la contraseña antes de registrarla en la BD.
    $registro->query("INSERT INTO usuario (nombre, num_tel, email, password) VALUES('$nombre', '$num_tel', '$email', '$encript_pass');");
    echo "<script>alert('¡Enhorabuena! Hemos terminado tu registro en OutCinema, ya puedes iniciar sesión y comenzar a disfrutar de tu cuenta.'); window.location.href='../login.php'</script>";
} else {

    $nombre = $_POST['nombre'];
    $num_tel = $_POST['num_tel'];
    $email = $_POST["email"];
    $password = $_POST["pass"];

    $registro->query("SELECT * FROM usuario");

    $comprobante;
    while ($row = $registro->extraer_registro()) {
        if ($row['email'] == $email) {
            $comprobante = false;
            echo "<script>alert('Ya existe una cuenta asociada a esa dirección de correo electrónico. Por favor, introduzca un correo válido.'); window.location.href='../registro.php'</script>";
        } else if ($row['num_tel'] == $num_tel) {
            $comprobante = false;
            echo "<script>alert('Ya existe una cuenta asociada a ese número de teléfono. Por favor, introduzca un número de teléfono válido.'); window.location.href='../registro.php'</script>";
        } else {
            $comprobante = true; //Significa que los datos introducidos no existen en otro usuario ya registrado, y se da el visto bueno.
        }
    }
    if ($comprobante) {
        $_SESSION['nombre'] = $nombre;
        $_SESSION['num_tel'] = $num_tel;
        $_SESSION['email'] = $email;
        $_SESSION['pass'] = $password;

        include 'GenerarCodigo.php';
        $codigoRandom = new CodigoRandom();

        $_SESSION['user_email'] = $email;
        $_SESSION['codigoRandom'] = $codigoRandom->generarCodigoRandom();
        header("Location: enviarCorreo.php?motivo=confirmarCuenta");
    }
}
