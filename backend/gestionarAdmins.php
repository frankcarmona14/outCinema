<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../forms/style.css">
    <link rel="stylesheet" href="../src/styles/tablesStyle.css">
    <title>Gestionar Administradores</title>
</head>

<body>
    <center>
        <?php
        require 'ConnectionDB.php';
        $query = $pdo->prepare("SELECT * FROM usuario WHERE admin = 1;");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if (isset($_POST['editar'])) {
            $id_usuario = $_POST['editar'];
            $query = $pdo->prepare("SELECT * FROM usuario WHERE id_usuario='$id_usuario';");
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            foreach ($results as $result) {
        ?>
                <div class="form__login">
                    <div class="form-container">
                        <div class="loginEmail">
                            <h2>Modificar datos del Administrador</h2>
                            <br>
                            <p>Puedes modificar el nombre, teléfono y el email del administrador.</p>
                            <form action='gestionarAdmins.php' method='POST'>
                                <br>
                                <div class="formInput">
                                    <input type="text" placeholder="Nombre" required="required" class="formInput-field" name='nombre' value='<?php echo $result->nombre ?>' />
                                    <p class="formInput-error" id=""></p>
                                </div>
                                <div class="formInput">
                                    <input type="text" placeholder="Teléfono" required="required" class="formInput-field" name='num_tel' value='<?php echo $result->num_tel ?>' />
                                    <p class="formInput-error" id=""></p>
                                </div>
                                <div class="formInput">
                                    <input type="text" placeholder="Teléfono" required="required" class="formInput-field" name='email' value='<?php echo $result->email ?>' />
                                    <p class="formInput-error" id=""></p>
                                </div>
                                <input type='hidden' name='id_usuario' value='<?php echo $result->id_usuario ?>'>
                                <input type='submit' class="btn btn-green" name='confirmarCambios' value='Confirmar Cambios'>
                            </form><br>
                            <a href='gestionarAdmins.php'>Seleccionar otro administrador</a><br><br>
                            <a href='../panelAdministrativo.php'>Volver al Panel Administrativo</a>
                        </div>
                    </div>
                </div>
            <?php
            }
        } else if (isset($_POST['eliminar'])) {
            $id = $_POST['eliminar'];
            $registro = $pdo->prepare("DELETE FROM usuario WHERE id_usuario=?;");
            $registro->execute([$id]);
            if ($registro) {
                echo "<script>alert('El usuario administrador ha sido eliminado exitosamente.'); window.location.href='gestionarAdmins.php';</script>";
            } else {
                echo "<script>alert('Algo ha salido mal al intentar eliminar el usuario administrador. Por favor, vuelva a intentarlo más tarde.'); window.location.href='gestionarAdmins.php';</script>";
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
                echo "<script>alert('Información actualizada.'); window.location.href='gestionarAdmins.php';</script>";
            } else {
                echo "<script>alert('Algo ha salido mal al intentar cambiar el tipo de entrada. Por favor, vuelva a intentarlo más tarde.');</script>";
            }
        } else {
            ?>
            <div class="table-responsive">
                <form action='gestionarAdmins.php' method='POST'>
                    <table>
                        <h2>Gestionar Administradores</h2><br>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>E-mail</th>
                                <th>Modificar Datos</th>
                                <th>Eliminar Administrador</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($results as $result) {
                            ?>
                                <tr>
                                    <td data-title="ID"><?php echo $result->id_usuario ?></td>
                                    <td data-title="Nombre"><?php echo $result->nombre ?></td>
                                    <td data-title="Teléfono"><?php echo $result->num_tel ?></td>
                                    <td data-title="E-mail"><?php echo $result->email ?></td>
                                    <td data-title="Modificar Datos"><button class="btn btn-green" type='submit' name='editar' value='<?php echo $result->id_usuario ?>'>Modificar</button></td>
                                    <td data-title="Eliminar Administrador"><button class="btn btn-green" type='submit' name='eliminar' value='<?php echo $result->id_usuario ?>'>Eliminar</button></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
            <br><a href='../panelAdministrativo.php'>Volver al panel administrativo</a>

        <?php
        }
        ?>
    </center>
</body>

</html>