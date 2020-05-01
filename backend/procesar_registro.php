<?php
session_start();

if (isset($_REQUEST['validado'])) {
    $nombre = $_SESSION['nombre'];
    $num_tel = $_SESSION['num_tel'];
    $email = $_SESSION["email"];
    $password = $_SESSION["pass"];
    $encript_pass = password_hash($password, PASSWORD_BCRYPT); //Se encripta la contraseña antes de registrarla en la BD.

    require_once 'ConnectionDB.php';
    $datosUsuario = [
        'nombre' => $nombre,
        'num_tel' => $num_tel,
        'email' => $email,
        'password' => $encript_pass,
    ];
    $consulta = "INSERT INTO usuario (nombre, num_tel, email, password) VALUES(:nombre, :num_tel, :email, :password);";
    $registro = $pdo->prepare($consulta);
    $registro->execute($datosUsuario);
    if ($registro) {
        echo "<script>alert('¡Enhorabuena! Hemos terminado tu registro en OutCinema, ya puedes iniciar sesión y comenzar a disfrutar de tu cuenta.'); window.location.href='../login.php'</script>";
    } else {
        echo "<script>alert('Algo ha salido mal en tu registro. Vuelve a intentarlo más tarde.');</script>";
    }
} else {

    $nombre = $_POST['nombre'];
    $num_tel = $_POST['num_tel'];
    $email = $_POST["email"];
    $password = $_POST["pass"];

    $comprobante = false;

    require_once 'ConnectionDB.php';

    $query = $pdo->prepare("SELECT * FROM usuario;");
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            if ($result->email == $email) {
                $comprobante = false;
                echo "<script>alert('Ya existe una cuenta asociada a esa dirección de correo electrónico. Por favor, introduzca un correo válido.'); window.location.href='../registro.php'</script>";
            } else if ($result->num_tel == $num_tel) {
                $comprobante = false;
                echo "<script>alert('Ya existe una cuenta asociada a ese número de teléfono. Por favor, introduzca un número de teléfono válido.'); window.location.href='../registro.php'</script>";
            } else {
                $comprobante = true; //Significa que los datos introducidos no existen en otro usuario ya registrado, y se da el visto bueno.
            }
        }
    } else {
        $comprobante = true;
    }

    if ($comprobante == true) {
        echo "Comprobante ok";
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
