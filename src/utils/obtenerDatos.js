//direccion de la api que devuelve json con las peliculas que estan en cartelera
let API = "https://api.themoviedb.org/3/movie/";

//funcion para traer devuelta los datos del api
const obtenerDatos = async type => {
  type == "cartelera"
    ? (API +=
        "now_playing?api_key=b8883ee788434835301611a7e3762f0e&language=es-ES&page=1")
    : (API +=
        "upcoming?api_key=b8883ee788434835301611a7e3762f0e&language=es-ES&page=1");
  try {
    const respuesta = await fetch(API);
    //conviertiendo a json la respuesta
    const objRespuesta = await respuesta.json();
    return objRespuesta;
  } catch (error) {
    //si falla la petición se muestra el error en consola
    console.log("Error en el Fetch", error);
  }
};

export default obtenerDatos;