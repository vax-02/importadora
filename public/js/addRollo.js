function nuevaTela() {
  let cant = document.getElementById("cantidad");
  let color = document.getElementById("color");
  let table = document
    .getElementById("tableTelas")
    .getElementsByTagName("tbody")[0];

  if (cant.value != "" && parseInt(cant.value) > 0) {
    let newRollo = table.insertRow();

    var cellColor = newRollo.insertCell(0);
    var cellColorReal = newRollo.insertCell(1);
    var cellCantidad = newRollo.insertCell(2);
    var cellOption = newRollo.insertCell(3);
    cellColor.classList.add("centrar-color");
    cellCantidad.innerHTML = cant.value;
    cellColor.innerHTML =
      '<div style="width:15px; height:15px; background: ' +
      color.value +
      ' ;"><div>';
    cellColorReal.classList.add("ocultar-columna");
    cellColorReal.innerHTML = color.value;
    cellOption.innerHTML =
      '<button class="btn btn-danger" onclick="removeRow(this)"><i class="fas fa-trash"><i></button>';
    cant.value = "";
  }
}

function removeRow(button) {
  // Obtiene la fila que contiene el botón
  var row = button.parentNode.parentNode;

  // Elimina la fila
  row.parentNode.removeChild(row);
}

const precioRealRollo = document.getElementById("precioRealRollo");
const metrosRollo = document.getElementById("metroRollo");
const precioVentaRollo = document.getElementById("precioVentaRollo");
const precioMetro = document.getElementById("precioMetro");

metrosRollo.addEventListener("input", function () {
  let precioPorMetro =
    parseInt(precioVentaRollo.value) + parseInt(precioVentaRollo.value) * 0.1;
  if (this.value > 0) {
    precioMetro.value = Math.ceil(
      parseInt(precioPorMetro) / parseInt(this.value),
      0
    );
  }
  precioRealRollo.dispatchEvent(new Event("input"));
});

precioRealRollo.addEventListener("input", function () {
  precioVentaRollo.value = Math.round(
    parseInt(precioRealRollo.value) +
      (parseInt(precioRealRollo.value) *
        parseInt(document.getElementById("incremento-rollo").value)) /
        100,
    0
  );
  //price real m.
  document.getElementById("precioMetroReal").value = (
    parseFloat(this.value) / parseInt(metrosRollo.value)
  ).toFixed(1);

  document.getElementById("precioMetro").value = (
    parseFloat(document.getElementById("precioMetroReal").value) +
    (parseFloat(document.getElementById("precioMetroReal").value) *
      document.getElementById("incremento-metro").value) /
      100
  ).toFixed(1);
});

precioVentaRollo.addEventListener("input", function () {
  document.getElementById("val-incremento-rollo").textContent = "---";
  document.getElementById("incremento-rollo").value = 0;
  btnSig = document.getElementById("sigOne");
  if (parseFloat(this.value) < parseFloat(precioRealRollo.value)) {
    this.classList.add("error");
    btnSig.disabled = true;
  } else {
    this.classList.remove("error");
    btnSig.disabled = false;
  }
});

precioMetro.addEventListener("input", function () {
  document.getElementById("val-incremento-metro").textContent = "---";
  document.getElementById("incremento-metro").value = 0;

  btnSig = document.getElementById("sigOne");
  if (
    parseFloat(this.value) <
    parseFloat(document.getElementById("precioMetroReal").value)
  ) {
    this.classList.add("error");
    btnSig.disabled = true;
  } else {
    this.classList.remove("error");
    btnSig.disabled = false;
  }
});

function addForm() {
  let table = document
    .getElementById("tableTelas")
    .getElementsByTagName("tbody")[0];
  const form = document.getElementById("formTela");
  const rows = table.getElementsByTagName("tr");
  let i = 0;
  for (; i < rows.length; i++) {
    const cells = rows[i].getElementsByTagName("td");
    //const cell = cells[1];
    const input = document.createElement("input");
    input.type = "hidden";
    input.name = "color" + i;
    input.value = cells[1].textContent;
    form.appendChild(input);
    const input2 = document.createElement("input");
    input2.type = "hidden";
    input2.name = "cant" + i;
    input2.value = cells[2].textContent;
    form.appendChild(input2);
  }
  const input = document.createElement("input");
  input.type = "hidden";
  input.name = "tcolores";
  input.value = i;
  form.appendChild(input);
}
