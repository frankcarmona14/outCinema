<?php
session_start();

include 'Cookies.php';
$cookies = new Cookies();

$user_id = $cookies->desencriptar($_SESSION['user_id'], 'k123');
$user_name = $cookies->desencriptar($_SESSION['user_name'], 'k123');
$user_email = $cookies->desencriptar($_SESSION['user_email'], 'k123');

$pelicula = $_POST['pelicula'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$butacas = $_POST['butaca'];

$_SESSION['pelicula'] = $pelicula;
$_SESSION['fecha'] = $fecha;
$_SESSION['hora'] = $hora;


require_once 'ConnectionDB.php';
$datosButacaVendida = [
    'user_id' => $user_id,
    'user_name' => $user_name,
    'user_email' => $user_email,
    'pelicula' => $pelicula,
    'fecha' => $fecha,
    'hora' => $hora,
    'butacas' => $butacas,
];
//$consulta = "INSERT INTO usuario (nombre, num_tel, email, password) VALUES(:nombre, :num_tel, :email, :password);";
$consulta = "INSERT INTO butacasvendidas(id_usuario, nom_usuario, email_usuario, pelicula, fecha, hora, butaca) VALUES(:user_id, :user_name, :user_email, :pelicula, :fecha, :hora, :butacas);";

$registro = $pdo->prepare($consulta);
$registro->execute($datosButacaVendida);
if ($registro) {
    echo "¡Butacas vendidas exitosamente!";
} else {
    echo "¡Error en la venta de las butacas!";
}

/*
include 'ConexionBD.php';
$registro = new ConexionBD($servidor, $usuario, $pass, $base_datos);
$registro->query("INSERT INTO butacasvendidas(id_usuario, nom_usuario, email_usuario, pelicula, fecha, hora, butaca) VALUES('$user_id', '$user_name', '$user_email', '$pelicula', '$fecha', '$hora', '$butacas');");
echo "¡Butacas vendidas exitosamente!";

 if (!$registro->query("INSERT INTO butacasvendidas VALUES(0, 'nombre1', 'email1', '$pelicula', '$fecha', '$hora', '$butacas');")) {
        echo ("Error description: " . $registro->error);
    } */

    //echo json_encode($_POST);
    //ConexionBD::cerrarConexion($registro);
