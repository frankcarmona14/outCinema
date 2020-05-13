<?php
session_start();

$tipoEntrada = $_POST['tipoEntrada'];

require_once 'ConnectionDB.php';

$query = $pdo->prepare("SELECT * FROM precios WHERE tipo='$tipoEntrada';");
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
if ($query->rowCount() > 0) {
    foreach ($results as $result) {
        echo $result->precio;
    }
}
