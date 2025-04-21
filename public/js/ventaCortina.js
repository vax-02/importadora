let precioTelaSelect = 0;
function seleccionarCliente(btn) {
  var row = btn.parentNode.parentNode;
  var celdas = row.getElementsByTagName("td");
  const inputCliente = document.getElementById("cliente");

  inputCliente.value = celdas[1].innerText.trim();
  let botones = document
    .getElementById("table3")
    .getElementsByTagName("tbody")[0]
    .getElementsByTagName("tr");

  for (var i = 0; i < botones.length; i++) {
    botones[i]
      .getElementsByTagName("td")[6]
      .getElementsByTagName("button")[0]
      .classList.remove("bg-success");
  }
  btn.classList.toggle("bg-success");
}

function agregarDimension() {
  const alto = document.getElementById("alto");
  const ancho = document.getElementById("ancho");
  const cant = document.getElementById("cantidadV");

  if (alto.value != "" && ancho.value != "" && cant.value != "") {
    let table = document
      .getElementById("tablaVentana")
      .getElementsByTagName("tbody")[0];

    let newRow = table.insertRow();
    let cellAlto = newRow.insertCell(0);
    let cellAncho = newRow.insertCell(1);
    let cellCant = newRow.insertCell(2);
    let cellOption = newRow.insertCell(3);

    cellAlto.innerHTML = alto.value;
    cellAncho.innerHTML = ancho.value;
    cellCant.innerHTML = cant.value;
    cellOption.innerHTML =
      '<button class="btn btn-danger" onclick="removeRow(this)"><i class="fas fa-trash"><i></button>';

    alto.value = ancho.value = cant.value = "";
  }
}

function seleccionarTela(btn) {
  var row = btn.parentNode.parentNode;
  var celdas = row.getElementsByTagName("td");

  document.getElementById("tela").value = celdas[1].innerText.trim();
  precioTelaSelect = parseFloat(celdas[7].innerText.trim());
  document.getElementById("codcolor").value = celdas[3].innerText.trim();
  document.getElementById("pto").value = celdas[7].innerText.trim();


  let botones = document
    .getElementById("table2")
    .getElementsByTagName("tbody")[0]
    .getElementsByTagName("tr");

  for (var i = 0; i < botones.length; i++) {
    botones[i]
      .getElementsByTagName("td")[8]
      .getElementsByTagName("button")[0]
      .classList.remove("bg-success");
  }
  btn.classList.toggle("bg-success");
}

function realizarContrato() {
  const ventanas = document
    .getElementById("tablaVentana")
    .getElementsByTagName("tbody")[0]
    .getElementsByTagName("tr");
  const form = document.getElementById("form-telas");
  let i = 0;
  for (; i < ventanas.length; i++) {
    const cells = ventanas[i].getElementsByTagName("td");
    //const cell = cells[1];
    const input = document.createElement("input");

    input.type = "hidden";
    input.name = "alto" + i;
    input.value = cells[0].textContent;
    form.appendChild(input);

    const input2 = document.createElement("input");
    input2.type = "hidden";
    input2.name = "ancho" + i;
    input2.value = cells[1].textContent;
    form.appendChild(input2);

    const input3 = document.createElement("input");
    input3.type = "hidden";
    input3.name = "cantidad" + i;
    input3.value = cells[2].textContent;
    form.appendChild(input3);
  }

  const inputTotal = document.createElement("input");
  inputTotal.type = "hidden";
  inputTotal.name = "total";
  inputTotal.value = i;
  form.appendChild(inputTotal);
}
document.getElementById("metros_tela").addEventListener("input", function () {
  document.getElementById("precio_tela").value =
    parseInt(this.value) * precioTelaSelect;
});
