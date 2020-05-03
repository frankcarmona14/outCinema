<?php

session_start();

$pelicula = $_POST['pelicula'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];

$vendidas = array();

require_once 'ConnectionDB.php';

$query = $pdo->prepare("SELECT * FROM butacasvendidas WHERE pelicula='$pelicula' AND fecha='$fecha' AND hora='$hora';");
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
if ($query->rowCount() > 0) {
    foreach ($results as $result) {
        $butaca = $result->butaca;
        $vendidas[] = array('butacaVendida' => $butaca);
    }
}
$json_butacas = json_encode($vendidas);
echo $json_butacas;