function comprobarDatosLogin() {

    //declaracion de variables
    var emailE = document.getElementById("emailE");
    var passE = document.getElementById("passE");
    var email = document.getElementById("email");
    var pass = document.getElementById("pass").value;

    var espacios = false;
    var i = 0;
    var correcto = true;

    //comprueba espacios en blanco
    while (!espacios && (i < pass.length)) {
        if (pass.charAt(i) == " ") {
            espacios = true;
        }
        i++;
    }

    correcto = expRegEmail(email, emailE, correcto);
    if (pass == "") {
        passE.innerHTML = "Es necesario que introduzca su contraseña.";
        correcto = false;
    } else if (pass.length < 8) {
        passE.innerHTML = "La contraseña contiene menos de 8 caracteres.";
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
    var email = document.getElementById("email");
    var number = document.getElementById("tel").value;
    var pass1 = document.getElementById("pass1").value;
    var pass2 = document.getElementById("pass2").value;

    var nameE = document.getElementById("nameE");
    var emailE = document.getElementById("emailE");
    var numberE = document.getElementById("telE");
    var pass1E = document.getElementById("pass1E");
    var pass2E = document.getElementById("pass2E");

    //expresion válida para nombres de distintos idiomas
    var nameReg = new RegExp("^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$");

    var numberReg = new RegExp("^([ 6 || 7 || 8 || 9]){1}([0-9]){8}$");

    var i = 0;
    var vacios=0;
    for(i=0;i<name.length;i++){
        if(name.charAt(i)==" "){
            vacios++;
        }
    }

    if (name == "" || name==" ") {
        nameE.innerHTML = "Introduzca su nombre.";
    } else {
        if (!nameReg.test(name)) {
            nameE.innerHTML = "Introduzca un nombre válido.";
            correcto = false;
        } else if (name != "") {
            if(vacios==name.length || name.length<2){
                nameE.innerHTML = "Rellene el campo por favor.";
            }else{
                nameE.innerHTML = " ";
            }     
        }
    }

    correcto = expRegEmail(email, emailE, correcto);
    correcto = expRegPass(pass1, pass2, pass1E, pass2E, correcto);

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

    return correcto;
}

function enviarDatosForm(e) {

    if (!comprobarDatosRegistro()) {
        e.preventDefault();
    }
}

function validarPass(e) {
    var pass1 = document.getElementById("pass1").value;
    var pass2 = document.getElementById("pass2").value;
    var pass1E = document.getElementById("pass1E");
    var pass2E = document.getElementById("pass2E");
    var correcto = true;;

    correcto = expRegPass(pass1, pass2, pass1E, pass2E, correcto);

    console.log(correcto);
    if (!correcto) {
        e.preventDefault();
    }
}

function expRegPass(pass1, pass2, error1, error2, correcto) {
    var correcto = correcto;

    if (pass1 == "") {
        error1.innerHTML = "Es necesario que introduzca su contraseña.";
        correcto = false;
    } else if (pass1.length < 8) {
        error1.innerHTML = "La contraseña debe contener 8 caracteres mínimo.";
        correcto = false;
    } else {
        error1.innerHTML = " ";
    }
    if (pass1 != pass2) {
        error2.innerHTML = "Las contraseñas no coiciden.";
        correcto = false;
    } else {
        error2.innerHTML = " ";
    }

    return correcto;
}

function expRegEmail(email, error, correcto) {
    var correcto = correcto;

    var emailReg = new RegExp("^[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}$");

    if (email.value == "") {
        error.innerHTML = "Es necesario que introduzca su correo.";
        correcto = false;
    } else if (!emailReg.test(email.value)) {
        error.innerHTML = "El no correo es inválido.";
        correcto = false;
    } else if (emailReg.test(email.value)) {
        error.innerHTML = " ";
    }
    return correcto;
}



function confirmarCodigo(e) {

    var codigo = document.getElementById("codigo").value;
    var codigoE = document.getElementById("codigoE");
    var correcto = true;
    if (codigo == "") {
        codigoE.innerHTML = "Código vacío"
        correcto = false;
    } else if (codigo.length < 10) {
        codigoE.innerHTML = "Código error"
        correcto = false;
    } else {
        codigoE.innerHTML = " "
    }

    if (!correcto) {
        e.preventDefault();
    }
}

function validarCorreo() {
    var correcto = true;
    var email = document.getElementById("email");
    var emailE = document.getElementById("emailE");

    correcto = expRegEmail(email, emailE, correcto);

    return correcto;
}

function enviarDatosRecuperacion(e) {

    if (!validarCorreo()) {
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
        } else if (document.getElementById("enviar")) {
            document.getElementById("enviar").addEventListener("click", enviarDatosRecuperacion);

        } else if (document.getElementById("cambiarPass")) {
            document.getElementById("cambiarPass").addEventListener("click", validarPass);
        } else if (document.getElementById("cambiarCodigo")) {
            document.getElementById("cambiarCodigo").addEventListener("click", confirmarCodigo);
        } else if (document.getElementById("validar")) {
            document.getElementById("validar").addEventListener("click", confirmarCodigo);
        }

    }
}

document.addEventListener("readystatechange", asignarEventos);