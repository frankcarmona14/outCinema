function comprobarDatosLogin() {

    //declaracion de variables
    var emailE = document.getElementById("emailE");
    var passE = document.getElementById("passE");
    var email = document.getElementById("email");
    var pass = document.getElementById("pass").value;

    var espacios = false;
    var i = 0;
    var correcto = true;
    var emailReg = new RegExp("^[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}$");

    //comprueba espacios en blanco
    while (!espacios && (i < pass.length)) {
        if (pass.charAt(i) == " ") {
            espacios = true;
        }
        i++;
    }

    if (email.value == "") {
        emailE.innerHTML = "Es necesario que introduzca su correo.";
        correcto = false;
    } else if (!emailReg.test(email.value)) {
        emailE.innerHTML = "El correo es inválido.";
        correcto = false;
    } else if (emailReg.test(email.value)) {
        emailE.innerHTML = " ";
    }
    if (pass == "") {
        passE.innerHTML = "Es necesario que introduzca su contraseña.";
        correcto = false;
    } else if (espacios) {
        passE.innerHTML = "La contraseña no puede contener espacios en blanco.";
        correcto = false;
    } else {
        passE.innerHTML = " ";
    }

    return correcto;

}

function enviarDatosLogin(e) {
    if (!comprobarDatosLogin()) {
        e.preventDefault();
    }
}

function comprobarDatosRegistro() {
    //declaracion de variables
    var correcto = true;

    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var number = document.getElementById("tel").value;
    var pass1 = document.getElementById("pass1").value;
    var pass2 = document.getElementById("pass2").value;

    var nameE = document.getElementById("nameE");
    var emailE = document.getElementById("emailE");
    var numberE = document.getElementById("telE");
    var pass1E = document.getElementById("pass1E");
    var pass2E = document.getElementById("pass2E");

    //var nameReg = new RegExp("^[A-Za-z\s]+$");
    var nameReg = new RegExp("^(?=.{3,15}$)[A-ZÁÉÍÓÚ][a-zñáéíóú]+(?: [A-ZÁÉÍÓÚ][a-zñáéíóú]+)?$");
    var emailReg = new RegExp("^[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}$");
    var numberReg = new RegExp("^([ 6 || 7 || 8 || 9]){1}([0-9]){8}$");

    var espacios = false;
    var i = 0;

    //comprueba espacios en blanco
    while (!espacios && (i < pass1.length)) {
        if (pass1.charAt(i) == " ") {
            espacios = true;
        }
        i++;
    }

    if (name == "") {
        nameE.innerHTML = "Introduzca su nombre.";
    } else {
        if (!nameReg.test(name)) {
            nameE.innerHTML = "Introduzca un nombre válido.";
            correcto = false;
        } else if (name != "") {
            nameE.innerHTML = " ";
        }
    }
    if (email == "") {
        emailE.innerHTML = "Introduzca su correo electrónico.";
    } else {
        if (!emailReg.test(email)) {
            emailE.innerHTML = "Introduzca un correo válido.";
            correcto = false;
        } else if (emailReg.test(email)) {
            emailE.innerHTML = " ";
        }
    }
    if (number == "") {
        numberE.innerHTML = "Introduzca su número de teléfono.";
    } else {
        if (!numberReg.test(number)) {
            numberE.innerHTML = "Introduzca un número de teléfono válido.";
            correcto = false;
        } else if (numberReg.test(number)) {
            numberE.innerHTML = " ";
        }
    }
    if (pass1 == "") {
        pass1E.innerHTML = "Establezca una contraseña.";
        correcto = false;
    } else if (pass1.length < 8) {
        pass1E.innerHTML = "La contraseña debe contener por lo menos 8 caracteres.";
        correcto = false;
    } else if (espacios) {
        pass1E.innerHTML = "La contraseña no puede contener espacios en blanco.";
        correcto = false;
    } else {
        pass1E.innerHTML = " ";
    }
    if (pass2 != pass1) {
        pass2E.innerHTML = "Las contraseñas no coinciden.";
        correcto = false;
    } else if (pass2 == pass1) {
        pass2E.innerHTML = " ";
    }
    return correcto;
}

function enviarDatosForm(e) {
    if (!comprobarDatosRegistro()) {
        e.preventDefault();
    }
}

function asignarEventos() {
    if (document.readyState == 'complete') {

        //comprueba si existen los botones, segun eso realiza las operaciones
        if (document.getElementById("iniciar")) {

            document.getElementById("iniciar").addEventListener("click", enviarDatosLogin);
        } else if (document.getElementById("registrarse")) {

            document.getElementById("registrarse").addEventListener("click", enviarDatosForm);
        }

    }
}

document.addEventListener("readystatechange", asignarEventos);