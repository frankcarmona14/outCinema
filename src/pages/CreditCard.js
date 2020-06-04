const tarjeta = document.querySelector("#tarjeta"),
  formulario = document.querySelector("#formulario-tarjeta"),
  numeroTarjeta = document.querySelector("#tarjeta .numero"),
  nombreTarjeta = document.querySelector("#tarjeta .nombre"),
  logoMarca = document.querySelector("#logo-marca"),
  delantera = document.querySelector("#delantera"),
  trasera = document.querySelector("#trasera"),
  firma = document.querySelector("#tarjeta .firma p"),
  mesExpiracion = document.querySelector("#tarjeta .mes"),
  yearExpiracion = document.querySelector("#tarjeta .anio"),
  ccv = document.querySelector("#tarjeta .ccv");

// * Rotacion de la tarjeta
tarjeta.addEventListener("click", () => {
  tarjeta.classList.toggle("active");
});

// Voltaemos la tarjeta para mostrar el frente

const mostrarFrente = () => {
  if (tarjeta.classList.contains("active")) {
    tarjeta.classList.remove("active");
  }
};

// Select del mes

for (let i = 1; i <= 12; i++) {
  let option = document.createElement("option");
  if (i <= 9) {
    option.value = `0${i}`;
    option.innerText = `0${i}`;
    formulario.selectMes.appendChild(option);
  } else {
    option.value = i;
    option.innerText = i;
    formulario.selectMes.appendChild(option);
  }
}

// Select del año
const yearActual = new Date().getFullYear();

for (let i = yearActual; i <= yearActual + 8; i++) {
  let option = document.createElement("option");
  option.value = i;
  option.innerText = i;
  formulario.selectYear.appendChild(option);
}

// Input numero de tarjeta
formulario.inputNumero.addEventListener("keyup", (e) => {
  let valorInput = e.target.value;

  formulario.inputNumero.value = valorInput
    .replace(/\s/g, "")
    .replace(/\D/g, "")
    .replace(/([0-9]{4})/g, "$1 ")
    .trim();

  numeroTarjeta.textContent = valorInput;

  if (valorInput == "" || valorInput == " ") {
    numeroTarjeta.textContent = "•••• •••• •••• ••••";

    logoMarca.innerHTML = "";
    delantera.style.backgroundImage = "";
    delantera.style.color = "";
    trasera.style.backgroundImage = "";
    trasera.style.color = "";
  }

  if (valorInput[0] == 4) {
    logoMarca.innerHTML = "";
    const imagen = document.createElement("img");
    imagen.src = "src/img/pay_img/visa.png";
    logoMarca.appendChild(imagen);
    delantera.style.backgroundImage = "url('src/img/pay_img/background-visa.png')";
    delantera.style.color = "#fff";
    trasera.style.backgroundImage = "url('src/img/pay_img/background-visa.png')";
    trasera.style.color = "#fff";
  } else if (valorInput[0] == 5) {
    logoMarca.innerHTML = "";
    const imagen = document.createElement("img");
    imagen.src = "src/img/pay_img/mastercard.png";
    logoMarca.appendChild(imagen);
    delantera.style.backgroundImage = "url('src/img/pay_img/background-master.png')";
    delantera.style.color = "#fff";
    trasera.style.backgroundImage = "url('src/img/pay_img/background-master.png')";
    trasera.style.color = "#fff";
  }
  // volteamos la tarjeta
  mostrarFrente();
});

// Input numero de tarjeta
formulario.inputNombre.addEventListener("keyup", (e) => {
  let valorInput = e.target.value;

  formulario.inputNombre.value = valorInput.replace(/[0-9]/g, "");
  nombreTarjeta.textContent = valorInput;
  firma.textContent = valorInput;

  if (valorInput == "" || valorInput == " ") {
    nombreTarjeta.textContent = "";
  }
  mostrarFrente();
});

// Select mes
formulario.selectMes.addEventListener("change", (e) => {
  mesExpiracion.textContent = e.target.value + " ";
  mostrarFrente();
});

// Select año
formulario.selectYear.addEventListener("change", (e) => {
  yearExpiracion.textContent = " " + e.target.value.slice(2);
  mostrarFrente();
});

// ccv
formulario.inputCCV.addEventListener("keyup", (e) => {
  if (!tarjeta.classList.contains("active")) {
    tarjeta.classList.toggle("active");
  }

  formulario.inputCCV.value = formulario.inputCCV.value
    .replace(/\s/g, "")
    .replace(/\D/g, "");

    ccv.textContent = formulario.inputCCV.value;
});
