import obtenerDatos from "../utils/obtenerDatos.js";

async function mostrarElementos() {
  //seleccionando el contenedor donde iran los items
  const moviesContainer = document.getElementById("moviesContainer");

  //guardando en una variable el json de la petición
  const datos = await obtenerDatos("cartelera");

  //Filtro para quitar peliculas que no tienen poster
  const movies = datos.results.filter((mov) => mov.poster_path !== null);

  //Creando array con cadena html y datos de las peliculas
  const vista = movies
    .map((movie) => {
      //pasando a entero la puntuación de la pelicula y dividiendola en 2
      //ya que solo seran 5 estrellas
      let votes = Math.round(movie.vote_average) / 2;
      var cadena = "";

      //agregando incono de estrella rellena
      for (let i = 1; i < votes; i++) {
        cadena += "<i class='fas fa-star fa-xs'></i>";
      }

      //si la pelicula tiene una puntuación de 3.5 se agregara estrella con medio relleno
      votes == 3.5 ?
        (cadena += "<i class='fas fa-star-half-alt fa-xs'></i>") :
        (cadena += "<i class='fas fa-star fa-xs'></i>");

      //retornando item con dato de cada pelicula
      return `<article class="movie__item">
         <a href='infPelicula.php' class="link-img" id="${movie.id}"><img src="https://image.tmdb.org/t/p/w500/${movie.poster_path}" id="${movie.id}" />
        <div class="item__info">
          <div class="desc">
            ${movie.title}</a>
            <div class="more">
            <div class="stars">
              ${cadena}
            </div>
            </div>
          </div>
        </div>
      </article>`;
    })
    .join("");

  //insertar las peliculas al html
  moviesContainer.innerHTML = vista;

  const stars = document.querySelectorAll(".stars");
  //agregando estrellas faltantes a las peliculas
  for (let i = 0; i < stars.length; i++) {
    for (let k = stars[i].children.length; k < 5; k++) {
      let star = document.createElement("i");
      star.className = "far fa-star fa-xs";
      stars[i].appendChild(star);
    }
  }

  function guardarIdPelicula(ev) {
    var idPelicula = ev.target.id;
    localStorage.setItem("idPelicula", idPelicula);
  }

  var items = document.querySelectorAll(".link-img");

  for (let i = 0; i < items.length; i++) {
    items[i].addEventListener("click", guardarIdPelicula, false);
  }
}

//insertar evento
window.addEventListener("DOMContentLoaded", mostrarElementos);