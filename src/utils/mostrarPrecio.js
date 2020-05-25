window.addEventListener("DOMContentLoaded", mostrarTipoEntrada, true);

async function mostrarTipoEntrada() {
    tipos_de_entrada = JSON.parse(await leerTipoEntrada());
    select = document.getElementById("tipoEntrada");

    for (var i in tipos_de_entrada) {
        option = document.createElement("option");
        option.textContent = tipos_de_entrada[i];
        select.add(option);
    }

    select.addEventListener("change", mostrarPrecio, true);
    mostrarPrecio();
}

totalEntradas = 1;

async function mostrarPrecio() {

    add = document.getElementById("add");
    drop = document.getElementById("drop");
    total = document.getElementById("total");
    precioTotal = document.getElementById("precioTotal");
    const precioMostrado = document.getElementById("precioMostrado");

    total.textContent = totalEntradas;
    document.cookie = `numEntradas=${total.textContent}`;

    const tipoEntrada = document.getElementById("tipoEntrada");
    let entradaSelec = tipoEntrada.options[tipoEntrada.selectedIndex].textContent;
    precioAsignado = await leerPrecioAsignado(entradaSelec);

    sessionStorage.setItem('tipoEntrada', entradaSelec);
    sessionStorage.setItem('precioAsignado', precioAsignado);

    precioMostrado.textContent = precioAsignado + "€ c/u";
    precioTotal.textContent = (precioAsignado * totalEntradas).toFixed(2) + "€";

    //console.log("Entrada seleccionada: " + entradaSelec);
    //console.log("Precio asignado en la BD: " + precioAsignado);

}

add.addEventListener("click", function () {
    if (totalEntradas < 9) {
        totalEntradas++;
        total.textContent = totalEntradas;
        document.cookie = `numEntradas=${totalEntradas}`;
        precioTotal.textContent = (precioAsignado * totalEntradas).toFixed(2) + "€";
    }
}, true);

drop.addEventListener("click", function () {
    if (totalEntradas > 1) {
        totalEntradas--;
        total.textContent = totalEntradas;
        document.cookie = `numEntradas=${totalEntradas}`;
        precioTotal.textContent = (precioAsignado * totalEntradas).toFixed(2) + "€";
    }
}, true);

function leerPrecioAsignado(entradaSelec) {
    var comprobarPrecio = new FormData();
    comprobarPrecio.append('tipoEntrada', entradaSelec);

    var precioAsignadoBD = fetch('backend/verPrecio.php', {
            method: 'POST',
            body: comprobarPrecio
        })
        .then(function (response) {
            // console.log("Pasa PRIMER then.");
            if (response.ok) {
                return response.text();
            } else {
                throw "FETCH ERROR!";
            }
        })
        .then(function (texto) {
            return texto;
        })
        .catch(function (err) {
            // console.log("Pasa CATCH.");
            console.log(err);
        });

    return precioAsignadoBD;
}

function leerTipoEntrada() {
    var comprobarTipoEntrada = new FormData();
    comprobarTipoEntrada.append('comprobar', 'tipoEntrada');

    var tiposEntradaBD = fetch('backend/verPrecio.php', {
            method: 'POST',
            body: comprobarTipoEntrada
        })
        .then(function (response) {
            // console.log("Pasa PRIMER then.");
            if (response.ok) {
                return response.text();
            } else {
                throw "FETCH ERROR!";
            }
        })
        .then(function (texto) {
            return texto;
        })
        .catch(function (err) {
            // console.log("Pasa CATCH.");
            console.log(err);
        });

    return tiposEntradaBD;
}