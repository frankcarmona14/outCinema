<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../forms/style.css">
    <title>Validar Entradas</title>
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

            <div class="form__login">
                <div class="form-container">
                    <div class="loginEmail">
                        <h2>Validar Entradas</h2>
                        <br><p>Introduce el ID de las entradas del cliente para validarlas.</p>
                        <form action='escanearEntradas.php' method='POST'>
                            <br>
                            <div class="formInput">
                                <input type="text" name="id" placeholder="ID Entradas" required="required" class="formInput-field" />
                                <p class="formInput-error" id=""></p>
                            </div>
                            <input type='submit' class="btn btn-green" value='Scan Tickets'>
                        </form><br>
                        <a href='../panelAdministrativo.php'>Volver al Panel Administrativo</a>
                    </div>
                </div>
            </div>
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