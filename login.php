<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="forms/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
    <title>Iniciar Sesión</title>
    <script src="forms/validarFormularios.js"></script>
</head>

<body>
    <div class="form__login">
        <div class="form-container">
            <div class="loginSocial">
                <div class="loginSocial-facebook">
                    <a href="#" class="btn btn-fcbk">
                        <i class="fab fa-facebook-f fa-lg icons"></i>
                        <span>Inicia sesión con Facebook</span>
                    </a>
                </div>
                <div class="loginSocial-facebook">
                    <a href="#" class="btn btn-ggl">
                        <i class="fab fa-google fa-lg icons"></i>
                        <span>Inicia sesión con Google</span>
                    </a>
                </div>
            </div>
            <div class="loginDivider">
                <span class="loginDivider__text">o</span>
            </div>
            <div class="loginEmail">
                <form action='backend/procesar_login.php' method='POST'>
                    <div class="formInput">
                        <input type="email" name="email" id="email" placeholder="Tu email" required="required" class="formInput-field" />
                        <p class="formInput-error" id="emailE"></p>
                    </div>
                    <div class="formInput">
                        <input type="password" id="pass" required="required" name="pass" placeholder="Tu contraseña" class="formInput-field" />
                        <p class="formInput-error" id="passE"></p>
                    </div>
                    <input id="iniciar" class="btn btn-green" value="Iniciar sesión" type="submit"></input>
                    <div class="lostPass">
                        <a href="recuperacion.php">¿Olvidaste tu contraseña?</a>
                    </div>
                </form>
            </div>
            <div class="accountFooter">
                <span>¿Aún no tienes una cuenta?</span>
                <div class="accountFooter-link">
                    <a href="registro.php"><button class="btn btn-account">Regístrate</button></a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>