const idPelicula = localStorage.getItem("idPelicula");

const datosPelicula = async (id) => {
  // se define una variable con la url que llevara el id de la pelicula
  let API = `https://api.themoviedb.org/3/movie/${id}?api_key=b8883ee788434835301611a7e3762f0e&language=es-ES&append_to_response=videos`;
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

export default datosPelicula;
