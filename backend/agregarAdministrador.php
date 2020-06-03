<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../forms/style.css">
    <title>Agregar Administrador</title>
</head>

<body>
    <?php
    require 'ConnectionDB.php';
    if (isset($_POST['buscar'])) {
        $email = $_POST['email'];
        $query = $pdo->prepare("SELECT * FROM usuario WHERE email='$email';");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            foreach ($results as $result) {
                if ($result->admin == 0) {
    ?>
                    <div class="form__login">
                        <div class="form-container">
                            <div class="loginEmail">
                                <h2>Agregar Administrador</h2>
                                <br>
                                <p>Confirma que estos datos corresponden al usuario al que quieres otorgarle privilegios administrativos.</p><br>
                                <form action='agregarAdministrador.php' method='POST'>
                                    <div class='formInput'>
                                        <input type='text' value='ID: <?php echo $result->id_usuario ?>' class='formInput-field' disabled>
                                    </div>
                                    <div class='formInput'>
                                        <input type='text' value='Nombre: <?php echo $result->nombre ?>' class='formInput-field' disabled>
                                    </div>
                                    <div class='formInput'>
                                        <input type='text' value='Teléfono: <?php echo $result->num_tel ?>' class='formInput-field' disabled>
                                    </div>
                                    <div class='formInput'>
                                        <input type='text' value='E-mail: <?php echo $result->email ?>' class='formInput-field' disabled>
                                    </div>
                                    <input type='hidden' name='id' value='<?php echo $result->id_usuario ?>'>
                                    <input type='submit' class='btn btn-green' name='agregar' value='Otorgar privilegios administrativos'>
                                </form><br>
                                <a href='agregarAdministrador.php'>Introducir otro E-mail</a><br><br>
                                <a href='../panelAdministrativo.php'>Volver al Panel Administrativo</a>
                            </div>
                        </div>
                    </div>
        <?php
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
    } else {
        ?>
        <div class="form__login">
            <div class="form-container">
                <div class="loginEmail">
                    <h2>Agregar Administrador</h2>
                    <br>
                    <p>Para agregar un administrador, es necesario que el sujeto ya tenga una cuenta de usuario normal.</p>
                    <form action='agregarAdministrador.php' method='POST'>
                        <br>
                        <div class="formInput">
                            <input type="text" name="email" placeholder="E-mail del usuario" required="required" class="formInput-field" />
                            <p class="formInput-error" id=""></p>
                        </div>
                        <input type='submit' class="btn btn-green" name='buscar' value='Buscar Usuario'>
                    </form><br>
                    <a id='volver' href='../panelAdministrativo.php'>Volver al Panel Administrativo</a>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</body>

</html>