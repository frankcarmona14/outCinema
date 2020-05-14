<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escanear Entradas</title>
</head>

<body>
    <?php
    session_start();
    if ($_COOKIE['admin'] && $_COOKIE['admin'] == true) {
        if (isset($_POST['id'])) {
            scanTickets($_POST['id']);
        } else if (isset($_REQUEST['id'])) {
            scanTickets($_REQUEST['id']);
        } else {
    ?>
            <h1>Escanear Entradas</h1>
            <form action="escanearEntradas.php" method='POST'>
                <span>ID Entradas: </span><input type='text' name='id'>
                <input type='submit' value='Scan Tickets'>
            </form>
    <?php
        }
    } else {
        echo "<script>alert('Tienes que iniciar sesión como administrador.'); window.location.href='../login.php'</script>";
    }

    function scanTickets($id)
    {
        require_once "ConnectionDB.php";

        $query = $pdo->prepare("SELECT * FROM butacasvendidas WHERE id_transaccion='$id';");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            foreach ($results as $result) {
                if ($result->scan == 1) {
                    echo "<script>alert('Este ticket ya ha sido escaneado.'); window.close(); window.location.href='../index.php';</script>";
                    
                } else {
                    $consulta = "UPDATE butacasvendidas SET scan=? WHERE id_transaccion=?;";
                    $scan = $pdo->prepare($consulta);
                    $scan->execute(['1', $id]);
                    if (!$scan) {
                        echo "<script>alert('No se ha podido scanear el ticket.');</script>";
                    }
                }
            }
        }
    }
    echo "<script>window.close();</script>";
    ?>
</body>

</html>