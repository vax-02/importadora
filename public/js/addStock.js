const precioMetro = document.getElementById("precioMetro");
const btn_save_stock = document.getElementById("btn-save-stock");
function addMoreRollos(btn) {
  const data = btn.parentNode.parentNode
    .getElementsByTagName("td")[2]
    .textContent.trim();

  const color = btn.parentNode.parentNode
    .getElementsByTagName("td")[1]
    .textContent.trim();
  document.getElementById("rollosCurrent").value = data;
  document.getElementById("codColor").value = color;

  document.getElementById("rolloMore").value = "";
}

document.getElementById("rolloMore").addEventListener("input", function () {
  const VAL = new Validator();
  if (
    this.value.length > 0 &&
    parseInt(this.value) > 0 &&
    VAL.isNumber(this.value)
  ) {
    document.getElementById("btnSubmidAddRollo").disabled = false;
    this.classList.remove("error");
  } else {
    document.getElementById("btnSubmidAddRollo").disabled = true;
    this.classList.add("error");
  }
});

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
      '<button type="button" data-bs-toggle="modal" id="btnAddMoreRollos" data-bs-target="#addMoreRollos" class="btn btn-warning text-white" onclick="addMoreRollos(this)"> <i class="fas fa-pen"></i> </button> <button class="btn btn-danger" onclick="removeRow(this)"><i class="fas fa-trash"><i></button>';
    cant.value = "";
  }
}

function removeRow(button) {
  // Obtiene la fila que contiene el botón
  var row = button.parentNode.parentNode;

  // Elimina la fila
  row.parentNode.removeChild(row);
}

document
  .getElementById("btnSubmidAddRollo")
  .addEventListener("click", function () {
    var cells;
    var nuevoValor =
      parseInt(document.getElementById("rollosCurrent").value) +
      parseInt(document.getElementById("rolloMore").value);
    var color = document.getElementById("codColor").value;
    console.log(nuevoValor);

    const rows = document
      .getElementById("tableTelas")
      .getElementsByTagName("tbody")[0]
      .getElementsByTagName("tr");
    for (i = 0; i < rows.length; i++) {
      cells = rows[i].getElementsByTagName("td");

      if (cells[1].textContent.trim() == color) break;
    }
    cells[2].textContent = nuevoValor;
    cells[2].classList.add("bg-light");
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

document
  .getElementById("precioMetroVenta")
  .addEventListener("input", function () {
    if (parseInt(this.value.trim()) > parseInt(precioMetro.value)) {
      btn_save_stock.disabled = false;
    } else {
      btn_save_stock.disabled = true;
    }
  });

document
  .getElementById("incrementRollo")
  .addEventListener("input", function () {
    document.getElementById("incrementRolloValue").textContent = this.value;

    // Obtener el valor de precioRolloReal como un número, ya que es un input
    console.log(document.getElementById("precioRolloReal").value);

    // Realizar el cálculo correcto para precioRollo
    document.getElementById("precioRollo").value = (
      parseFloat(document.getElementById("precioRolloReal").value) +
      (parseFloat(document.getElementById("precioRolloReal").value) *
        parseInt(this.value)) /
        100
    ).toFixed(1);
  });

  document
  .getElementById("incrementMetro")
  .addEventListener("input", function () {
    document.getElementById("incrementMetroValue").textContent = this.value;

    console.log(document.getElementById("precioMetro").value);

    document.getElementById("precioMetroVenta").value = (
      parseFloat(document.getElementById("precioMetro").value) +
      (parseFloat(document.getElementById("precioMetro").value) *
        parseInt(this.value)) /
        100
    ).toFixed(1);
  });


document
  .getElementById("precioRolloReal")
  .addEventListener("input", function () {
    // Realizar el cálculo correcto para precioRollo
    document.getElementById("precioRollo").value = (
      parseFloat(document.getElementById("precioRolloReal").value) +
      (parseFloat(document.getElementById("precioRolloReal").value) *
        parseInt(document.getElementById("incrementRollo").value)) /
        100
    ).toFixed(1);
    precioMetro.dispatchEvent(new Event("input"));
  });

precioMetro.addEventListener("input", function () {
  this.value = (
    parseFloat(document.getElementById("precioRolloReal").value) /
    parseInt(document.getElementById("tmetros").value)
  ).toFixed(1);
});
