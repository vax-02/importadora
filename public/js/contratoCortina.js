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
  }
}

function calcularMetrosMetrosDeTela() {
  rows = document.getElementById("tablaVentana").rows;
  mTotal = 0;
  cantidadTubos = 0;
  for (var i = 1; i < rows.length; i++) {
    ancho = parseFloat(rows[i].cells[1].textContent);
    cantidad = parseFloat(rows[i].cells[2].textContent);
    mTotal += ancho * cantidad;
    cantidadTubos += cantidad;
  }
  document.getElementById("metros_tela").value = mTotal;
  var event = new Event("input");
  document.getElementById("metros_tela").dispatchEvent(event);

  document.getElementById("numeroTubos").value = cantidadTubos;
  calcularCostoTotal();
}

function calcularCostoTotal() {
  manoDeObra = document.getElementById("precio_sastre");
  fruncido = document.getElementById("fruncido");
  costoTela = document.getElementById("precio_tela");
  document.getElementById("costoFinal").value =
    parseFloat(manoDeObra.value) * parseFloat(fruncido.value) +
    parseFloat(costoTela.value);
}

function calcularCostoInstalacion() {
  calcularCostoTotal();
  costoFinal = document.getElementById("costoFinal");
  costoFinal.value =
    parseFloat(costoFinal.value) +
    parseFloat(document.getElementById("costoTubo").value) *
      parseInt(document.getElementById("numeroTubos").value);
}
document.getElementById("check").addEventListener("input", function () {
  install = document.getElementById("install");
  if (this.checked) {
    install.classList.remove("d-none");
  } else {
    install.classList.add("d-none");
    document.getElementById("costoTubo").value = "";
    calcularCostoTotal();
  }
});
