document.addEventListener("readystatechange", function () {
    if (document.readyState == 'complete') {
        editar = document.getElementById('editar');
        agregar = document.getElementById('agregar');

        editar.addEventListener("click", editarDatos, true);
    }
}, true);


function editarDatos(ev) {
    datos = document.getElementsByTagName("input");
    for (var i = 0; i < datos.length; i++) {
        if (datos[i].type == 'text') {
            datos[i].addEventListener("keydown", confirmarCambios, true);
            console.log(datos[i].value);
            datos[i].disabled = false;
            datos[0].focus();
        }
    }
    agregar.disabled = true;
    editar.disabled = true;
}

function confirmarCambios() {
    editar.removeEventListener("click", editarDatos, true);
    editar.name = 'confirmar';
    editar.value = 'Confirmar Cambios'
    editar.disabled = false;
    editar.type = 'submit';
}