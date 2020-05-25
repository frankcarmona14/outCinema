<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Administrador</title>
</head>

<body>
    <?php
    require 'ConnectionDB.php';
    ?>
    <center>
        <h1>Agregar Administrador</h1>
        <span>Para agregar un administrador, es necesario que el usuario primero registre su cuenta como usuario normal.</span><br><br>

        <form action='agregarAdministrador.php' method='POST'>
            <span>Introduzca el correo electrónico del usuario: </span><input type='text' name='email'><br><br>
            <input type='submit' name='buscar' value='Buscar Usuario'>
        </form><br><br>

        <?php
        if (isset($_POST['buscar'])) {
            $email = $_POST['email'];
            $query = $pdo->prepare("SELECT * FROM usuario WHERE email='$email';");
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            if ($query->rowCount() > 0) {
                foreach ($results as $result) {
                    if ($result->admin == 0) {
                        echo "<form action='agregarAdministrador.php' method='POST'><table border='1'>";
                        echo "<tr><th>ID</th><th>Nombre</th><th>Teléfono</th><th>E-mail</th></tr>";
                        echo "<tr><td>$result->id_usuario</td><td>$result->nombre</td><td>$result->num_tel</td><td>$result->email</td></tr></table><br>";
                        echo "<input type='hidden' name='id' value='$result->id_usuario'>";
                        echo "<input type='submit' name='agregar' value='Agregarlo como Administrador'>";
                        echo "</form>";
                    } else {
                        echo "<script>alert('El usuario $result->nombre ya es un administrador.'); window.location.href='agregarAdministrador.php';</script>";
                    }
                }
            } else {
                echo "<script>alert('No existe ninguna cuenta asociada a este correo electrónico.'); window.location.href='agregarAdministrador.php';</script>";
            }
        } else if (isset($_POST['agregar'])) {
            $id = $_POST['id'];
            $query = "UPDATE usuario SET admin=? WHERE id_usuario=?";
            $registro = $pdo->prepare($query);
            $registro->execute([1, $id]);
            if ($registro) {
                echo "<script>alert('Información actualizada.'); window.location.href='gestionarAdmins.php';</script>";
            } else {
                echo "<script>alert('Algo ha salido mal al intentar agregar al administrador. Por favor, vuelva a intentarlo más tarde.');</script>";
            }
        }
        ?>
        <br><br><a href="../panelAdministrativo.php">Volver al panel administrativo.</a>
    </center>
</body>

</html>