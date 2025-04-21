medidaTubo = document.getElementById("medidaTubo");
costoTubo = document.getElementById("costoTubo");
costoTuboTotal = document.getElementById("costoTuboTotal");

numHerrajes = document.getElementById("numHerrajes");
costoHerraje = document.getElementById("costoHerraje");
costoHerrajeTotal = document.getElementById("costoHerrajeTotal");

costoFinal = document.getElementById("costoFinal");

manoInsta = document.getElementById("manoInsta");

mTotal = 0;

function verificarSeleccionCortina() {
  tela = document.getElementById("tela");

  if (tela.value.length != 0) {
    siguienteSeccion();
  }
}

function verificarSeleccionDimension() {
  if (
    document.getElementById("tablaVentana").getElementsByTagName("tbody")[0]
      .rows.length > 0
  ) {
    siguienteSeccion();
    calcularMetrosMetrosDeTela();
    calcularNumVentanas();
    medidaTuboCalc();
  }
}

function calcularNumVentanas() {
  rows = document.getElementById("tablaVentana").rows;
  cantidad = 0;
  for (var i = 1; i < rows.length; i++) {
    cantidad += parseFloat(rows[i].cells[2].textContent);
  }
  document.getElementById("numVentanas").value = cantidad;
  calcularNumHerrajes(cantidad);
  numHerrajes.dispatchEvent(new Event("input"));
}
document.getElementById("numVentanas").addEventListener("input", function () {
  calcularNumHerrajes(this.value);
  numHerrajes.dispatchEvent(new Event("input"));
});
function calcularNumHerrajes(numVentanas) {
  numHerrajes.value = numVentanas * 2;
}

function medidaTuboCalc() {
  rows = document.getElementById("tablaVentana").rows;
  metros = 0;
  for (var i = 1; i < rows.length; i++) {
    metros +=
      parseFloat(rows[i].cells[2].textContent) *
      parseFloat(rows[i].cells[1].textContent);

    metros += parseFloat(rows[i].cells[2].textContent) * 0.2;
  }

  medidaTubo.value = metros;
}

function calcularMetrosMetrosDeTela() {
  rows = document.getElementById("tablaVentana").rows;

  cantidadTubos = 0;
  for (var i = 1; i < rows.length; i++) {
    ancho = parseFloat(rows[i].cells[1].textContent);
    cantidad = parseFloat(rows[i].cells[2].textContent);
    mTotal += ancho * cantidad;
    cantidadTubos += cantidad;
  }

  document.getElementById("metros_tela").value =
    mTotal * parseFloat(document.getElementById("fruncido").value);

  var event = new Event("input");
  document.getElementById("metros_tela").dispatchEvent(event);

  //document.getElementById("numeroTubos").value = cantidadTubos;
  calcularCostoTotal();
}

function calcularCostoTotal() {
  manoDeObra = document.getElementById("precio_sastre");
  fruncido = document.getElementById("fruncido");
  costoTela = document.getElementById("precio_tela");

  costoManoDeObra =
    parseFloat(manoDeObra.value) *
    parseFloat(mTotal) *
    parseFloat(document.getElementById("fruncido").value);

  costoFinal.value = (
    parseFloat(costoManoDeObra) + parseFloat(costoTela.value)
  ).toFixed(1);
}

document.getElementById("check").addEventListener("input", function () {
  install = document.getElementById("install");
  if (this.checked) {
    install.classList.remove("d-none");
    document.getElementById("numVentanas").required = true;
    medidaTubo.required = true;
    costoTubo.required = true;
    numHerrajes.required = true;
    costoHerraje.required = true;
  } else {
    install.classList.add("d-none");
    costoTubo.value = "";
    document.getElementById("numVentanas").required = false;
    medidaTubo.required = false;
    costoTubo.required = false;
    numHerrajes.required = false;
    costoHerraje.required = false;

    calcularCostoTotal();
  }
});

document.getElementById("checkTwo").addEventListener("input", function () {
  install = document.getElementById("manoDeObraInlacion");
  if (this.checked) {
    install.classList.remove("d-none");
    manoInsta.required = true;
  } else {
    install.classList.add("d-none");
    manoInsta.required = false;

    calcularCostoTotal();
  }
});
document.getElementById("fruncido").addEventListener("input", function () {
  document.getElementById("metros_tela").value =
    mTotal * parseFloat(this.value);
  document.getElementById("metros_tela").dispatchEvent(new Event("input"));
});

medidaTubo.addEventListener("input", function () {
  if (costoTubo.value.length > 0 && parseFloat(costoTubo.value) > 0) {
    costoTuboTotal.value = (
      parseFloat(this.value) * parseFloat(costoTubo.value)
    ).toFixed(1);
    costoTuboTotal.dispatchEvent(new Event("input"));
  }
});

costoTubo.addEventListener("input", function () {
  if (medidaTubo.value.length > 0 && parseFloat(medidaTubo.value) > 0) {
    costoTuboTotal.value = (
      parseFloat(this.value) * parseFloat(medidaTubo.value)
    ).toFixed(1);
    costoTuboTotal.dispatchEvent(new Event("input"));
  }
});

numHerrajes.addEventListener("input", function () {
  if (costoHerraje.value.length > 0 && parseFloat(costoHerraje.value) > 0) {
    costoHerrajeTotal.value = (
      parseFloat(this.value) * parseFloat(costoHerraje.value)
    ).toFixed(1);
    costoHerrajeTotal.dispatchEvent(new Event("input"));
  }
});

costoHerraje.addEventListener("input", function () {
  if (numHerrajes.value.length > 0 && parseFloat(numHerrajes.value) > 0) {
    costoHerrajeTotal.value = (
      parseFloat(this.value) * parseFloat(numHerrajes.value)
    ).toFixed(1);
    costoHerrajeTotal.dispatchEvent(new Event("input"));
  }
});

costoHerrajeTotal.addEventListener("input", function () {
  if (parseFloat(this.value) > 0 && this.value.length > 0) {
    calcularCostoTotal();
    costoFinal.value =
      parseFloat(costoFinal.value) +
      parseFloat(this.value) +
      parseFloat(costoTuboTotal.value);
  }

  if (this.value.length == 0) {
    calcularCostoTotal();
    costoFinal.value =
      parseFloat(costoFinal.value) + parseFloat(costoTuboTotal.value);
  }
});

costoTuboTotal.addEventListener("input", function () {
  if (parseFloat(this.value) > 0 && this.value.length > 0) {
    calcularCostoTotal();
    costoFinal.value =
      parseFloat(costoFinal.value) +
      parseFloat(this.value) +
      parseFloat(costoHerrajeTotal.value);
  }
  if (this.value.length == 0) {
    calcularCostoTotal();
    costoFinal.value =
      parseFloat(costoFinal.value) + parseFloat(costoHerrajeTotal.value);
  }
});

manoInsta.addEventListener("input", function () {
  costoFinal.value =
    parseFloat(costoFinal.value) +
    parseFloat(this.value) *
      parseInt(document.getElementById("numVentanas").value);
});
