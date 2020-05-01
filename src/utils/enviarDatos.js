//document.addEventListener("readystatechange", function () {
//  if (document.readyState == 'complete') {
var numButacas = sessionStorage.getItem("numEntradas");
for (var i = 1; i <= parseInt(numButacas); i++) {

    const datosVenta = new FormData();
    const pelicula = sessionStorage.getItem("peli");
    const fecha = sessionStorage.getItem("fecha");
    const hora = sessionStorage.getItem("hora");
    const butacaSeleccionada = sessionStorage.getItem(("butacaSeleccionada" + i));
    const valor = i;

    datosVenta.append('pelicula', pelicula);
    datosVenta.append('fecha', fecha);
    datosVenta.append('hora', hora);
    datosVenta.append('butaca', butacaSeleccionada);
    datosVenta.append('valor', valor);

    fetch('../backend/regButacasVendidas.php', {
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
//  }
//}, true);