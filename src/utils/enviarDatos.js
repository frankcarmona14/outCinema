document.addEventListener("readystatechange", function () {
    if (document.readyState == 'complete') {
        document.getElementById("pagar").addEventListener("click", enviarDatosVenta, true);
    }
}, true);

function enviarDatosVenta() {
    var numButacas = sessionStorage.getItem("numEntradas");
    const idTransaccion = generarIdTransaccion();
    for (var i = 1; i <= parseInt(numButacas); i++) {

        const datosVenta = new FormData();
        const pelicula = sessionStorage.getItem("peli");
        const fecha = sessionStorage.getItem("fecha");
        const hora = sessionStorage.getItem("hora");
        const butacaSeleccionada = sessionStorage.getItem(("butacaSeleccionada" + i));

        datosVenta.append('pelicula', pelicula);
        datosVenta.append('fecha', fecha);
        datosVenta.append('hora', hora);
        datosVenta.append('butaca', butacaSeleccionada);
        datosVenta.append('id_transaccion', idTransaccion);

        fetch('backend/regButacasVendidas.php', {
                method: 'POST',
                body: datosVenta
            })
            .then(function (response) {
                //console.log("Pasa PRIMER then.");
                if (response.ok) {
                    return response.text();
                } else {
                    throw "FETCH ERROR!";
                }
            })
            .then(function (texto) {
                //console.log("Pasa SEGUNDO then.");
                console.log(texto);
            })
            .catch(function (err) {
                console.log("Pasa CATCH.");
                console.log(err);
            });
    }
}

function generarIdTransaccion() {
    longitud = 10;
    caracteres = "0123456789abcdefghijklmnopqrstuvwxyz";

    var cadena = "";
    var max = caracteres.length - 1;
    for (var i = 0; i < longitud; i++) {
        cadena += caracteres[Math.floor(Math.random() * (max + 1))];
    }
    return cadena;
}