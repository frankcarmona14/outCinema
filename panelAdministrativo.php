<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/styles/style.css" />
    <link rel="stylesheet" href="src/styles/AdminStyles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
    <title>Panel Administrativo</title>
</head>

<body>
    <?php
    session_start();
    ?>
    <header class="header">
        <nav class="navbar">
            <div class="hamburguer">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <div class="logo">
                <a href="index.php">
                    <img class="logo__img" src="src/img/logo.svg" alt="logo" />
                    <span class="logo__span">OutCinema</span>
                </a>
            </div>
            <ul class="nav-links">
                <li>
                    <?php
                    if (isset($_SESSION['dentro']) && $_SESSION['dentro'] == true) {
                    ?>
                        <div class="nav__user">
                            <a class="btn btn-big" href="backend/Cookies.php?cerrarSesion">Cerrar Sesión</a>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="nav__user">
                            <a class="btn btn-big" href="login.php">Inicia sesión o crea tu cuenta</a>
                        </div>
                    <?php
                    }
                    ?>
                </li>
                <?php
                if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                ?>
                    <li><a href="panelAdministrativo.php" class='active'>Panel Administrativo</a></li>
                <?php
                }
                ?>
                <li><a href="index.php">Cartelera</a></li>
            </ul>
            <div class="menu__user">
                <?php
                if (isset($_SESSION['dentro']) && $_SESSION['dentro'] == true) {
                ?>
                    <a class="btn btn-small" href="backend/Cookies.php?cerrarSesion">Cerrar Sesión</a>
                <?php
                } else {
                ?>
                    <a class="btn btn-small" href="login.php">Iniciar sesión</a>
                    <a class="btn btn-small" href="registro.php">Crear cuenta</a>
                <?php
                }
                ?>
            </div>
        </nav>
    </header>
    <center>
        <div class='options-container'>
            <button value='escanearEntradas' class='op-item'>Validar Entradas</button>
            <button value='cambiarPrecios' class='op-item'>Gestionar Entradas y Precios</button>
            <button value='agregarTipoEntrada' class='op-item'>Agregar nuevo tipo de Entrada</button>
            <button value='gestionarUsuarios' class='op-item'>Gestionar Usuarios</button>
            <button value='gestionarAdmins' class='op-item'>Gestionar Administradores</button>
            <button value='agregarAdministrador' class='op-item'>Agregar Nuevo Administrador</button>
        </div>
    </center>
    <script src="src/utils/Navbar.js"></script>
    <script src='src/utils/options.js'></script>
</body>

</html>