<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
    <link rel="stylesheet" href="src/styles/payStyle.css" />
    <title>Tarjeta de crédito</title>
</head>

<body>
    <div class="contenedor">
        <section class="tarjeta" id="tarjeta">
            <div class="delantera" id="delantera">
                <div class="logo-marca" id="logo-marca">
                    <!-- <img src="" alt="" /> -->
                </div>
                <img src="src/img/pay_img/chip-tarjeta.png" class="chip" alt="" />
                <div class="datos">
                    <div class="grupo" id="numero">
                        <p class="label">Número Tarjeta</p>
                        <p class="numero">•••• •••• •••• ••••</p>
                    </div>
                    <div class="flexbox">
                        <div class="grupo" id="nombre">
                            <p class="label">Nombre Tarjeta</p>
                            <p class="nombre"></p>
                        </div>
                        <div class="grupo" id="expiracion">
                            <p class="label">Valido Hasta</p>
                            <p class="expiracion">
                                <span class="mes">•• </span>/<span class="anio"> ••</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="trasera" id="trasera">
                <div class="barra-mag"></div>
                <div class="datos">
                    <div class="grupo" id="firma">
                        <p class="label">Firma</p>
                        <div class="firma">
                            <p></p>
                        </div>
                    </div>
                    <div class="grupo" id="ccv">
                        <p class="label">CCV</p>
                        <p class="ccv"></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Formulario -->
        <form action="backend/infoEntradas.php" id="formulario-tarjeta" class="formulario-tarjeta">
            <div class="grupo">
                <label for="inputNumero">Número Tarjeta</label>
                <input type="text" id="inputNumero" maxlength="19" />
            </div>
            <div class="grupo">
                <label for="inputNombre">Nombre</label>
                <input type="text" id="inputNombre" maxlength="19" autocomplete="off" />
            </div>
            <div class="flexbox">
                <div class="grupo expira">
                    <label for="selectMes">Expiracion</label>
                    <div class="flexbox">
                        <div class="grupo-select">
                            <select name="mes" id="selectMes">
                                <option disabled selected>Mes</option>
                            </select>
                            <i class="fas fa-angle-down"></i>
                        </div>
                        <div class="grupo-select">
                            <select name="year" id="selectYear">
                                <option disabled selected>Año</option>
                            </select>
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </div>
                </div>

                <div class="grupo ccv">
                    <label for="inputCCV">CCV</label>
                    <input type="text" id="inputCCV" maxlength="3" />
                </div>
            </div>
            <button type="submit" id='pagar' class="btn-enviar">Realizar Pago</button>
        </form>
    </div>
    <script src="src/pages/CreditCard.js"></script>
    <script src='src/utils/enviarDatos.js'></script>
</body>

</html>