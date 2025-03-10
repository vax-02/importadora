//const VAL = new Validator();
const btnAdd = document.getElementById("btnAdd");

function errosDimeciones(obj, msg_err_id, msg_err) {
  if (
    (VAL.isNumber(obj.value) && parseFloat(obj.value) > 0) ||
    obj.value.length == 0
  ) {
    obj.classList.remove("error");
    btnAdd.disabled = false;
  } else {
    obj.classList.add("error");
    btnAdd.disabled = true;
  }
  if (obj.classList.contains("error")) {
    document.getElementById(msg_err_id).textContent = msg_err;
  } else {
    document.getElementById(msg_err_id).textContent = "";
  }
}

document.getElementById("alto").addEventListener("input", function () {
  errosDimeciones(this, "error_alto", "Debe ser un valor mayor a 0");
});

document.getElementById("ancho").addEventListener("input", function () {
  errosDimeciones(this, "error_ancho", "Debe ser un valor mayor a 0");
});

document.getElementById("cantidadV").addEventListener("input", function () {
  errosDimeciones(this, "error_cantidad", "Debe ser un valor mayor a 0");
});
document.getElementById("costoTubo").addEventListener("input", function () {
  errosDimeciones(this, "error_costoTubo", "Debe ser un valor mayor a 0");
  if (this.value.length == 0) {
    calcularCostoTotal();
  } else {
    calcularCostoInstalacion();
  }
});

function errorsPrecio(obj, msg_err_id, msg_err) {
  if (VAL.isNumber(obj.value) && parseFloat(obj.value) > 0) {
    obj.classList.remove("error");
  } else {
    obj.classList.add("error");
  }

  if (obj.classList.contains("error") && obj.value.length == 0) {
    document.getElementById(msg_err_id).textContent = "Campo obligatorio";
  } else if (obj.classList.contains("error")) {
    document.getElementById(msg_err_id).textContent = msg_err;
  } else {
    document.getElementById(msg_err_id).textContent = "";
  }
}

document.getElementById("precio_sastre").addEventListener("input", function () {
  errorsPrecio(this, "error_precio_sastre", "El precio debe ser mayor a 0");
  calcularCostoTotal();
});

document.getElementById("fruncido").addEventListener("input", function () {
  errorsPrecio(this, "error_fruncido", "Debe tener fruncido");
  calcularCostoTotal();
});

document.getElementById("metros_tela").addEventListener("input", function () {
  errorsPrecio(this, "error_metros_tela", "Debe ser un valor mayor a 0");
  calcularCostoTotal();
});

document.getElementById("precio_tela").addEventListener("input", function () {
  errorsPrecio(this, "error_precio_tela", "Debe ser mayor a 0");
});
