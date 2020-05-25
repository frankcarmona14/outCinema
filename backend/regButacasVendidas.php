<?php
session_start();

include 'Cookies.php';
$cookies = new Cookies();

$user_id = $cookies->desencriptar($_SESSION['user_id'], 'k123');
$user_name = $cookies->desencriptar($_SESSION['user_name'], 'k123');
$user_email = $cookies->desencriptar($_SESSION['user_email'], 'k123');

$id_transaccion = $_POST['id_transaccion'];
$pelicula = $_POST['pelicula'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$butaca = $_POST['butaca'];
$tipoEntrada = $_POST['tipoEntrada'];
$precioAsignado = $_POST['precioAsignado'];

$_SESSION['id_transaccion'] = $id_transaccion;
$_SESSION['pelicula'] = $pelicula;
$_SESSION['fecha'] = $fecha;
$_SESSION['hora'] = $hora;
$_SESSION['tipoEntrada'] = $tipoEntrada;
$_SESSION['precioAsignado'] = $precioAsignado;

require_once 'ConnectionDB.php';
$datosButacaVendida = [
    'id_transaccion' => $id_transaccion,
    'id_user' => $user_id,
    'name_user' => $user_name,
    'tipo_entrada' => $tipoEntrada,
    'precio' => $precioAsignado,
    'pelicula' => $pelicula,
    'fecha' => $fecha,
    'hora' => $hora,
    'butaca' => $butaca,
];
//$consulta = "INSERT INTO usuario (nombre, num_tel, email, password) VALUES(:nombre, :num_tel, :email, :password);";
$consulta = "INSERT INTO butacasvendidas(id_transaccion, id_usuario, nom_usuario, tipo_entrada, precio, pelicula, fecha, hora, butaca) VALUES(:id_transaccion, :id_user, :name_user, :tipo_entrada, :precio, :pelicula, :fecha, :hora, :butaca);";

$registro = $pdo->prepare($consulta);
$registro->execute($datosButacaVendida);
if (!$registro) {
    echo "¡Error en la venta de las butacas!";
}
