<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="src/styles/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Sriracha&display=swap" rel="stylesheet">
  <title>OutCinema</title>
  <script>
    sessionStorage.clear();
  </script>
</head>

<body>
  <?php
  session_start();
  if (!isset($_SESSION['dentro'])) {
    if (isset($_COOKIE['Email']) && isset($_COOKIE['Password'])) { //Si existen esos datos en cookies, es porque el usuario ya ha aceptado gurdarlos,
      //Por lo tanto, hacemos la validación Log-in automáticamente, sin que el usuario
      require_once 'backend/Cookies.php'; //introduzca los datos. Recogemos los datos desde cookies, no desde formulario.
      $cookies = new Cookies();
      $email  = $cookies->desencriptar($_COOKIE['Email'], 'k123'); //Las cookies se almacenan encriptadas, por lo cual, es necesario desencriptarlas
      $password = $cookies->desencriptar($_COOKIE['Password'], 'k123'); //Para poder hacer una validación comparando con los datos de la BD.
      
      require_once 'backend/ConnectionDB.php';

      $query = $pdo->prepare("SELECT * FROM usuario;");
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_OBJ);
      if ($query->rowCount() > 0) {
        foreach ($results as $result) {
          if ($result->email == $email && password_verify($password, $result->password)) {

            if ($result->admin == 1) {
              $_SESSION['admin'] = true;
              setcookie("admin", true, time() + (86400 * 30), "/");
            } else {
              $_SESSION['admin'] = false;
            }

            $encript_email = $cookies->encriptar($email, 'k123'); //k123 es la key de encriptación.
            $encript_pass = $cookies->encriptar($password, 'k123'); //Se actualiza la encriptación de las cookies, para más seguridad.
            setcookie("Email", $encript_email, time() + (86400 * 30), "/");    //Se actualiza la fecha de expiración de las cookies, 
            setcookie("Password", $encript_pass, time() + (86400 * 30), "/");  //se le da otro mes de vida desde este momento.

            $_SESSION['user_id'] = $cookies->encriptar($result->id_usuario, 'k123');
            $_SESSION['user_name'] = $cookies->encriptar($result->nombre, 'k123');
            $_SESSION['user_email'] = $cookies->encriptar($result->email, 'k123');

            $_SESSION['dentro'] = true;
            header("Location: index.php");
          }
        }
      }
    }
  } else {
    if (!isset($_COOKIE['Email']) || !isset($_COOKIE['Password'])) {
  ?>
      <script>
        var aceptarCookies = confirm('¿Desea guardar sus datos de acceso en cookies? Para borrarlos, sólo deberá cerrar sesión.');
        if (aceptarCookies) {
          window.location.href = "backend/Cookies.php?guardarCookies"; //Redireccionamos a Cookies, para que se encargue del procesamiento.
        }
      </script>
  <?php
    }
  }
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
          <li><a href="panelAdministrativo.php">Panel Administrativo</a></li>
        <?php
        }
        ?>
        <li><a href="index.php" class="active">Cartelera</a></li>
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
  <section class="slider">
    <div>
      <ul>
      <li>
          <div class="slide der">
          <h1>Descubre nuestra cartelera y proximos Estrenos</h1>
            <p>Compra tus entradas </p>
          </div>
        </li>
        <li>
          <div class="slide">
            <h1>!No te pierdas nada! </h1>
            <p>Visita nuestras redes sociales para mantenerte informado.</p>
          </div>
        </li>
        <li>
        <div class="slide der">
            <h1>Pronto estaremos de vuelta </h1>
            <p>#Juntos por el cine</p>
          </div>
        </li>
        
      </ul>

    </div>
  </section>
  <section class="wellcome">
    <div class="group-image">
        <h1>Bienvenido a OutCinema, disfruta de nuestro contenido.</h1>
    </div>
    <div class="group-image image">
        <img src="src/img/imgCine.jpg" alt="wellcome">
    </div>
  </section>
  <section class="ribbon">
    <h1>Cartelera</h1>
    <img src="src/img/ribbon.png" alt="ribbon">

  </section>
  <section class="main">
    <div class="movies__container" id="moviesContainer"></div>
  </section>
  <footer class="footer">
    <div class="footer__redes">
      <i class="fab fa-facebook fa-2x"></i>
      <i class="fab fa-twitter fa-2x"></i>
      <i class="fab fa-instagram fa-2x"></i>
      <i class="fab fa-youtube fa-2x"></i>
    </div>
    <div class="footer__derechos">
      <span>Copyright© 2020 - todos los derechos reservados OutCinema ® SAS.</span>
    </div>
  </footer>
  <script type="module" src="src/pages/Cartelera.js"></script>
  <script src="src/utils/Navbar.js"></script>
</body>

</html>