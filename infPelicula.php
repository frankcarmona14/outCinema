<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="src/styles/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
  <title>Película</title>
  <script>
    sessionStorage.clear();
  </script>
</head>

<body>
  <?php
  session_start();
  $_SESSION['elegirButacas'] = 0;
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
            echo "<script>sessionStorage.setItem('dentro', 1);</script>";
          ?>
            <div class="nav__user">
              <a class="btn btn-big" href="backend/Cookies.php?cerrarSesion">Cerrar Sesión</a>
            </div>
          <?php
          } else {
            echo "<script>sessionStorage.setItem('dentro', 0);</script>";
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
          <li><a href="panelAdministrativo.php">Panel Administrativo</a></li>
        <?php
        }
        ?>
        <li><a href="index.php">Cartelera</a></li>
        <li><a href="#">Estrenos</a></li>
        <li><a href="#">Proximamente</a></li>
        <li><a href="#">Promos</a></li>
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
  <main>
    <section class="info-pelicula" id="infoPelicula">
    </section>
    <section class="horario">
      <h3>Seleccione un día</h3>
      <div class="horario_dia">
        <div class="dia_item selected"></div>
        <div class="dia_item"></div>
        <div class="dia_item"></div>
      </div>
      <h3>Seleccione la hora de su función</h3>
      <div class="horario_hora">
        <div class="hora_item"><span>18:30</span></div>
        <div class="hora_item"><span>20:30</span></div>
        <div class="hora_item"><span>22:30</span></div>
      </div>
      <h3>Seleccione el número de entradas</h3>
      <span>(Máximo <b>9</b> entradas por transacción)</span>
      <div class="horario_entradas">
        <div>Tipo de Entrada:</div>
        <div>
          <select id='tipoEntrada'>
            <option id='general' selected>Entrada general</option>
            <option id='reducida'>Entrada reducida</option>
          </select>
        </div>
        <div class="entrada_datos">
          <div id='precioMostrado'></div>
          <div class="cantidad" id="add">+</div>
          <div class="cantidad" id="drop">-</div>
          <div class="total" id="total"></div>
        </div>
      </div>
      <div>Importe total: </div>
      <div class="total" id="precioTotal"></div>
      <a class="btn btn-continuar" id='btnContinuar'>Continuar</a>
    </section>
  </main>
  <footer class="footer">
    <div class="footer__redes">
      <i class="fab fa-facebook fa-2x"></i>
      <i class="fab fa-twitter fa-2x"></i>
      <i class="fab fa-instagram fa-2x"></i>
      <i class="fab fa-youtube fa-2x"></i>
    </div>
    <div class="footer__derechos">
      <span>Copyright© 2020 todos los derechos reservados Out Cinema ® SAS.</span>
    </div>
  </footer>
  <script src="src/utils/Navbar.js"></script>
  <script src="src/utils/moment.min.js"></script>
  <script type="module" src="src/pages/Pelicula.js"></script>
  <script src="src/utils/mostrarPrecio.js"></script>
</body>

</html>