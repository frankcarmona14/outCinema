  document.addEventListener("readystatechange", function () {
      if (document.readyState == 'complete') {
          document.getElementById("pelicula").textContent = "Película: " + sessionStorage.getItem('peli');
          document.getElementById("fecha").textContent = "Fecha: " + sessionStorage.getItem('fecha');
          document.getElementById("hora").textContent = "Hora: " + sessionStorage.getItem('hora');
          document.getElementById("numEntradas").textContent = "Núm. Entradas: " + sessionStorage.getItem('numEntradas');

          document.getElementById("pagar").disabled = true;

          var filas = document.getElementsByTagName("tr");
          var butacas = document.getElementsByName("butaca");

          numEntradas = sessionStorage.getItem('numEntradas');
          butacasElegidas = 0;

          for (var c = 0; c < butacas.length; c++) {
              butacas[c].addEventListener("click", seleccionarButaca, false);
          }
      }
  }, true);

  function seleccionarButaca(ev) {
      switch (ev.target.value) {
          case "disponible":
              if (butacasElegidas < numEntradas) {
                  butacasElegidas++;
                  ev.target.value = 'seleccionada';
                  ev.target.src = 'src/img/butacaSeleccionada.png';
              } else {
                  alert("Ya ha seleccionado todas sus butacas.\nSi desea cambiar alguna de sus butacas, desmárquela y seleccione otra disponible.");
              }
              break;
          case "seleccionada":
              butacasElegidas--;
              ev.target.src = 'src/img/butacaDisponible.png';
              ev.target.value = 'disponible';
              break;
      }
      comprobarButacas();
  }

  function comprobarButacas() {
      if (butacasElegidas == numEntradas) {
          document.getElementById("pagar").disabled = false;
          guardarButacasSeleccionadas();
      } else {
          document.getElementById("pagar").disabled = true;
      }
  }

  function guardarButacasSeleccionadas() {
      butacas = document.getElementsByTagName("input");
      var butacasSeleccionadas = [];
      var numButacas = sessionStorage.getItem('numEntradas');
      var contButacas = 0;
      for (var i = 0; i < butacas.length; i++) {
          if (butacas[i].value == 'seleccionada') {
              contButacas++;
              if (contButacas <= numButacas) {
                  // butacasSeleccionadas.push(butacas[i].parentNode.parentNode.id + '_' + butacas[i].id);
                  sessionStorage.setItem("butacaSeleccionada" + contButacas, butacas[i].parentNode.parentNode.id + '_' + butacas[i].id);
              }

          }
      }
      //sessionStorage.setItem("butacasSeleccionadas", butacasSeleccionadas);
  }