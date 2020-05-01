<?php

session_start();

$email = $_POST["email"];
$password = $_POST["pass"];

require_once 'ConnectionDB.php';

$query = $pdo->prepare("SELECT * FROM usuario;");
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
if ($query->rowCount() > 0) {
    foreach ($results as $result) {
        if ($result->email == $email && password_verify($password, $result->password)) {
            $_SESSION["email"] = $email;
            $_SESSION["password"] = $password; //Se guardan estos datos en session, para posteriormente guardarlos en Cookies (SÓLO SI EL USUARIO ACEPTA).

            if ($result->admin == 1) { //Si el usuario es adiministrador, se crea ese identificador en Session, y una vez dentro, la app reconocerá-
                $_SESSION['admin'] = true;
            }

            include 'Cookies.php';
            $cookies = new Cookies();

            $_SESSION['user_id'] = $cookies->encriptar($resulto->id_usuario, 'k123');
            $_SESSION['user_name'] = $cookies->encriptar($result->nombre, 'k123');
            $_SESSION['user_email'] = $cookies->encriptar($result->email, 'k123');

            $_SESSION['dentro'] = true;
            header("Location: ../index.php");
        } else {
            echo "<script>alert('Correo o contraseña incorrectos.'); window.location.href='../login.php';</script>";
        }
    }
}



/*$usuario->query("SELECT * FROM usuario");
while ($row = $usuario->extraer_registro()) {
    if ($row['email'] == $email && password_verify($password, $row['password'])) { //La contraseña es el único campo encriptado en la BD, así que se desencripta y se compara
        //si algun registro de la BD coincide en E-mail y en Password.
        $_SESSION["email"] = $email;
        $_SESSION["password"] = $password; //Se guardan estos datos en session, para posteriormente guardarlos en Cookies (SÓLO SI EL USUARIO ACEPTA).

        if ($row['admin'] == 1) { //Si el usuario es adiministrador, se crea ese identificador en Session, y una vez dentro, la app reconocerá-
            $_SESSION['admin'] = true;
        }

        include 'Cookies.php';
        $cookies = new Cookies();

        $_SESSION['user_id'] = $cookies->encriptar($row['id_usuario'], 'k123');
        $_SESSION['user_name'] = $cookies->encriptar($row['nombre'], 'k123');
        $_SESSION['user_email'] = $cookies->encriptar($row['email'], 'k123');

        $_SESSION['dentro'] = true;
        header("Location: ../index.php");
    } else {
        echo "<script>alert('Correo o contraseña incorrectos.'); window.location.href='../login.php';</script>";
    }
}
 */
