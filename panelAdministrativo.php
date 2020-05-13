<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo</title>
    <style>
        .opciones {
            background-color: gray;
        }

        .opcion {
            width: 300px;
            height: 200px;
            background-color: #eee;
            display: inline-block;
        }

        .scan {
            width: 400px;
            height: 250px;
            background-color: lightgreen;
        }
    </style>
</head>

<body>
    <center>
        <h1>Welcome, admin!</h1>
        <form action='panelAdministrativo.php' method='POST'>
            <button type='submit' name='opcion' value='escanearEntradas' class='scan'>
                <h2>Escanear Entradas</h2>
            </button>
            <div class='opciones'>
                <button type='submit' name='opcion' value='cambiarPrecios' class='opcion'>
                    <h2>Cambiar Precios</h2>
                </button>
                <button type='submit' name='opcion' value='gestionarUsuarios' class='opcion'>
                    <h2>Gestionar Usuarios</h2>
                </button>
                <button type='submit' name='opcion' value='gestionarAdministradores' class='opcion'>
                    <h2>Gestionar Administradores</h2>
                </button>
            </div>
        </form>
    </center>

    <?php
    if (isset($_POST['opcion'])) {
        switch ($_POST['opcion']) {
            case "escanearEntradas":
                header("Location: backend/escanearEntradas.php");
                break;
            case "cambiarPrecios":
                header("Location: backend/cambiarPrecios.php");
                break;
            case "gestionarUsuarios":
                header("Location: backend/gestionarUsuarios.php");
                break;
            case "gestionarAdministradores":
                header("Location: backend/gestionarAdmins.php");
                break;
        }
    }
    ?>


</body>

</html>