<?php
session_start();

require_once 'ConnectionDB.php';
if (isset($_POST['comprobar'])) {
    $query = $pdo->prepare("SELECT tipo FROM precios");
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $tiposEntradas = [];
        foreach ($results as $result) {
            //echo $result->tipo;
            $tiposEntradas[] = $result->tipo;
        }
        echo json_encode($tiposEntradas);
    }
} else {
    $tipoEntrada = $_POST['tipoEntrada'];
    $query = $pdo->prepare("SELECT * FROM precios WHERE tipo='$tipoEntrada';");
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            echo $result->precio;
        }
    }
}
