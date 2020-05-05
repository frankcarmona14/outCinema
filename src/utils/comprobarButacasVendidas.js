    document.addEventListener("readystatechange", function () {
        comprobarRegistros();
    }, true);

    function comprobarRegistros() {
        try {
            realizarConsulta();
        } finally {
            bloquearButacasVendidas();
        }
    }

    function realizarConsulta() {
        const comprobarVentas = new FormData();
        const pelicula = sessionStorage.getItem("peli");
        const fecha = sessionStorage.getItem("fecha");
        const hora = sessionStorage.getItem("hora");

        comprobarVentas.append('pelicula', pelicula);
        comprobarVentas.append('fecha', fecha);
        comprobarVentas.append('hora', hora);

        fetch('backend/comprobarButacasVendidas.php', {
                method: 'POST',
                body: comprobarVentas
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
                localStorage.setItem("vendidas", texto);
                //return texto;
            })
            .catch(function (err) {
                // console.log("Pasa CATCH.");
                console.log(err);
            });
    }

    function bloquearButacasVendidas() {
        const filas = document.getElementsByTagName("tr");
        const butacas = document.getElementsByName("butaca");
        var f_vendida;
        var b_vendida;
        vendidas = JSON.parse(localStorage.getItem("vendidas"));
        
        for (var i in vendidas) {

            f_vendida = vendidas[i].butacaVendida.substr(0, 3);
            b_vendida = vendidas[i].butacaVendida.substr(4, 3);

            for (var f = 0; f < filas.length; f++) {
                if (filas[f].id == f_vendida) {
                    for (var b = 0; b < butacas.length; b++) {
                        if (butacas[b].id == b_vendida && butacas[b].parentNode.parentNode.id == f_vendida) {
                            butacas[b].src = 'src/img/butacaOcupada.png';
                            butacas[b].disabled = true;
                        }
                    }
                }
            }
        }
    }