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
}else{
    echo "<script>alert('Necesita crear una cuenta para poder iniciar sesion.'); window.location.href='../registro.php';</script>";
}