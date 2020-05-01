<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="forms/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
    <title>Registro</title>
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
            <div class="loginEmail">
                <form action='backend/procesar_registro.php' method='POST'>
                    <div class="formInput">
                        <input type="name" name="nombre" id="name" placeholder="Nombre completo" class="formInput-field" />
                        <p class="formInput-error" id="nameE"></p>
                    </div>
                    <div class="formInput">
                        <input type="email" id="email" name="email" placeholder="Correo electronico" class="formInput-field" />
                        <p class="formInput-error" id="emailE"></p>
                    </div>
                    <div class="formInput">
                        <input type="tel" id="tel" name="num_tel" placeholder="Número Telefonico" class="formInput-field" />
                        <p class="formInput-error" id="telE"></p>
                    </div>
                    <div class="formInput">
                        <input type="password" id="pass1" name="pass" placeholder="Contraseña" class="formInput-field" />
                        <p class="formInput-error" id="pass1E"></p>
                    </div>
                    <div class="formInput">
                        <input type="password" id="pass2" name="passRepeat" placeholder="Confirma tu contraseña" class="formInput-field" />
                        <p class="formInput-error" id="pass2E"></p>
                    </div>
                    <button type="submit" id="registrarse" class="btn btn-green"><span>Registrarse</span></button>
                </form>
            </div>
            <div class="accountFooter">
                <span>¿Ya tienes una cuenta?</span>
                <div class="accountFooter-link">
                    <a href="login.php" class="btn btn-account">Iniciar Sesión</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>