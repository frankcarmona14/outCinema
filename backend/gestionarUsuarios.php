<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Usuarios</title>
</head>

<body>
    <?php
    require 'ConnectionDB.php';
    $query = $pdo->prepare("SELECT * FROM usuario WHERE admin = 0;");
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    ?>
    <center>
        <h1>Gestionar Usuarios</h1>
        <form action='gestionarUsuarios.php' method='POST'>
            <table border='1'>
                <tbody>
                    <tr>
                        <th>ID Usuario</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Editar</th>
                        <th>Eliminar Usuario</th>
                    </tr>
                    <?php
                    foreach ($results as $result) {
                        echo "<tr>";
                        echo "<td>$result->id_usuario</td>";
                        echo "<td>$result->nombre</td>";
                        echo "<td>$result->num_tel</td>";
                        echo "<td>$result->email</td>";
                        echo "<td><button type='submit' name='editar' value='$result->id_usuario'>Editar</button></td>";
                        echo "<td><button type='submit' name='eliminar' value='$result->id_usuario'>Editar</button></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </form>
        <?php
        if (isset($_POST['editar'])) {
            echo "<h1>Editar datos del usuario:</h1>";
            $id_usuario = $_POST['editar'];
            $query = $pdo->prepare("SELECT * FROM usuario WHERE id_usuario='$id_usuario';");
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            foreach ($results as $result) {
        ?>
                <form action='gestionarUsuarios.php' method='POST'>
                    <span>Nombre: </span><input type='text' name='nombre' value='<?php echo $result->nombre ?>'><br>
                    <span>Teléfono: </span><input type='text' name='num_tel' value='<?php echo $result->num_tel ?>'><br>
                    <span>E-mail: </span><input type='text' name='email' value='<?php echo $result->email ?>'><br><br>
                    <input type='hidden' name='id_usuario' value='<?php echo $result->id_usuario ?>'>
                    <input type='submit' name='confirmarCambios' value='Confirmar Cambios'>
                </form>
        <?php
            }
        } else if (isset($_POST['eliminar'])) {
            $id = $_POST['eliminar'];
            $registro = $pdo->prepare("DELETE FROM usuario WHERE id_usuario=?;");
            $registro->execute([$id]);
            if ($registro) {
                echo "<script>alert('El usuario ha sido eliminado exitosamente.'); window.location.href='gestionarUsuarios.php';</script>";
            } else {
                echo "<script>alert('Algo ha salido mal al intentar eliminar el usuario. Por favor, vuelva a intentarlo más tarde.'); window.location.href='gestionarUsuarios.php';</script>";
            }
        } else if (isset($_POST['confirmarCambios'])) {
            $nombre = $_POST['nombre'];
            $num_tel = $_POST['num_tel'];
            $email = $_POST['email'];
            $id_usuario = $_POST['id_usuario'];

            $consulta = "UPDATE usuario SET nombre=?, num_tel=?, email=? WHERE id_usuario=?";
            $registro = $pdo->prepare($consulta);
            $registro->execute([$nombre, $num_tel, $email, $id_usuario]);
            if ($registro) {
                echo "<script>alert('Información actualizada.'); window.location.href='gestionarUsuarios.php';</script>";
            } else {
                echo "<script>alert('Algo ha salido mal al intentar cambiar el tipo de entrada. Por favor, vuelva a intentarlo más tarde.');</script>";
            }
        }
        ?>
        <br><a href='../panelAdministrativo.php'>Volver al panel administrativo</a>
    </center>
</body>

</html>