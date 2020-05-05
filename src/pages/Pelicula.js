import datosPelicula from "../utils/datosPelicula.js";

async function mostrarElementos() {
  let id_movie = localStorage.getItem("idPelicula");

  const datos = await datosPelicula(id_movie);

  const infoPelicula = document.getElementById("infoPelicula");

  //organizando los generos de la pelicula en una cadena
  const generos = datos.genres
    .map((genero) => {
      return genero.name;
    })
    .join(", ");

  //recogiendo trailer de la pelicula
  const trailer = datos.videos.results;
  let keyTrailer;

  trailer.forEach((tr) => {
    if (tr.type == "Trailer") {
      keyTrailer = tr.key;
    }
  });

  //cambiando la imagen de fondo por una de la pelicula seleccionada
  infoPelicula.style.backgroundImage = `url(https://image.tmdb.org/t/p/w1920_and_h800_multi_faces/${datos.backdrop_path})`;

  const vista = `<div class="bg-color">
    <div class="info-pelicula__container">
      <div class="container__trailer">
        <iframe
          class="youtube-video"
          width="560"
          height="315"
          src="https://www.youtube.com/embed/${keyTrailer}?modestbranding=1"
          frameborder="0"
          allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen
        ></iframe>
      </div>
      <div class="container__info">
        <h2>${datos.title}</h2>
        <span>
          <i class="fas fa-bookmark"></i>Género: ${generos}
        </span>
        <span>
          <i class="far fa-calendar-alt"></i>Estreno: ${datos.release_date.replace(
            /-/g,
            "/"
          )}
        </span>
        <span>
          <i class="far fa-clock"></i>Duración: ${datos.runtime} min
        </span>
        <h3>Sinopsis</h3>
        <p>
        ${datos.overview}
        </p>
      </div>
    </div>
  </div>`;

  infoPelicula.innerHTML = vista;

  document.cookie = `pelicula=${datos.title}`;

  const itemsDia = document.querySelectorAll(".dia_item");
  const itemsHora = document.querySelectorAll(".hora_item");

  function ponerFechas() {
    let horarioDias = document.getElementsByClassName("horario_dia")[0]
      .children;

    moment.locale("es");
    let mes;

    for (let i = 0; i < horarioDias.length; i++) {
      let fecha = moment();
      
    }
  }

  ponerFechas();

  itemsDia.forEach((item) => {
    let seleccion = document.querySelectorAll(".selected")[0];
    let anio = new Date();
    document.cookie = `fecha=${
      seleccion.children[0].textContent +
      " " +
      seleccion.children[1].textContent +
      " " +
      anio.getFullYear()
    }`;

    item.addEventListener("click", (ev) => {
      document.cookie = "dia=''; max-age=0";
      itemsDia.forEach((i) => {
        i.classList.remove("selected");
      });
      item.classList.toggle("selected");
      let seleccion = document.querySelectorAll(".selected")[0];
      let anio = new Date();
      document.cookie = `fecha=${
        seleccion.children[0].textContent +
        " " +
        seleccion.children[1].textContent +
        " " +
        anio.getFullYear()
      }`;
      //console.log(seleccion.children[0].textContent);
      //document.cookie = `fecha=${seleccion.children[0].children[1].textContent}`;
    });
  });

  itemsHora.forEach((item) => {
    item.addEventListener("click", () => {
      itemsHora.forEach((i) => {
        i.classList.remove("selected");
      });
      item.classList.toggle("selected");
      let seleccion = document.querySelectorAll(".selected")[1];
      document.cookie = `hora=${seleccion.children[0].textContent}`;
      document.getElementById("btnContinuar").href =
        sessionStorage.getItem("dentro") == 1
          ? "elegirButacas.php"
          : "login.php";
    });
  });

  const add = document.getElementById("add");
  const drop = document.getElementById("drop");
  let total = document.getElementById("total");
  total.textContent = 1;
  document.cookie = `numEntradas=${total.textContent}`;

  let precioTotal = 8;
  let mostrarPrecio = document.getElementById("precioTotal");
  mostrarPrecio.textContent = precioTotal + ",00€";

  add.addEventListener("click", () => {
    if (total.textContent < 9) {
      total.textContent++;
      document.cookie = `numEntradas=${total.textContent}`;
      precioTotal += 8;
      mostrarPrecio.textContent = precioTotal + ",00€";
    }
  });

  drop.addEventListener("click", () => {
    if (total.textContent > 1) {
      total.textContent--;
      document.cookie = `numEntradas=${total.textContent}`;
      precioTotal -= 8;
      mostrarPrecio.textContent = precioTotal + ",00€";
    }
  });
}

//insertar evento
window.addEventListener("DOMContentLoaded", mostrarElementos);
