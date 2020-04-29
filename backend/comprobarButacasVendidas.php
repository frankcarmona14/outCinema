<?php

session_start();

$pelicula = $_POST['pelicula'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];

$vendidas = array();

include 'ConexionBD.php';
$registro = new ConexionBD($servidor, $usuario, $pass, $base_datos);
$registro->query("SELECT * FROM butacasvendidas WHERE pelicula='$pelicula' AND fecha='$fecha' AND hora='$hora'");

while ($row = $registro->extraer_registro()) {
    //echo $row['butaca'];
    // $butacas[] = $row['butaca'];
    //echo json_encode($row['butaca']);
    $butaca = $row['butaca'];
    $vendidas[] = array('butacaVendida' => $butaca);
    //$vendidas['butacaVendida'][] = $row['butaca'];

}

$json_butacas = json_encode($vendidas);
echo $json_butacas;

//echo $butacas;
//echo "¡Butacas vendidas exitosamente!";
