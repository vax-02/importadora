let stockMetros, stockRollos, metrosCompleto;

const id_tela = document.getElementById("id_tela");
const color_tela = document.getElementById("color_tela");

const precioTela = document.getElementById("precioTela");
const metrosTela = document.getElementById("metrTela");

const btnInsertTela = document.getElementById("btnInsertTela");
btnInsertTela.disabled = true;
let inputCliente = document.getElementById("cliente");

function selectClienteTela(btn) {
  var row = btn.parentNode.parentNode;
  var celdas = row.getElementsByTagName("td");

  let botones = document
    .getElementById("table2")
    .getElementsByTagName("tbody")[0]
    .getElementsByTagName("tr");

  for (var i = 0; i < botones.length; i++) {
    botones[i]
      .getElementsByTagName("td")[4]
      .getElementsByTagName("button")[0]
      .classList.remove("bg-success");
  }

  if (inputCliente.value == celdas[0].innerText.trim()) {
    inputCliente.value = "";
    btn.classList.remove("bg-success");
  } else {
    inputCliente.value = celdas[0].innerText.trim();
    btn.classList.toggle("bg-success");
  }
}

function insertTela(btn) {
  var row = btn.parentNode.parentNode;
  var idTela = row.getElementsByTagName("td")[0].innerText.trim();
  var codColor = row.getElementsByTagName("td")[1].innerText.trim();

  document.getElementById("btnShowTela").click();

  fetch("/ImportadoraFernandez/Venta/getTela", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded", // URL-encoded form data
    },
    body: new URLSearchParams({ id: idTela, color: codColor }),
  })
    .then((response) => response.json()) // Parse JSON response
    .then((data) => {
      // Populate modal content with the data
      const nomTela = document.getElementById("nomTela");
      const marcTela = document.getElementById("marcTela");
      const caliTela = document.getElementById("caliTela");
      const metrajeTela = document.getElementById("metrajeTela");
      const precioTelaRef = document.getElementById("precioTelaRef");

      if (data.status === "success") {
        color_tela.value = data.data["CODCOLOR"];
        id_tela.value = data.data["CODTELA"];
        nomTela.value = data.data["NOMBRE"];
        marcTela.value = data.data["MARCA"];
        caliTela.value = data.data["CALIDAD"];
        precioTela.value = data.data["PRECIO"];
        precioTelaRef.value = data.data["PRECIO"];

        stockMetros = data.data["METROS"];
        metrosCompleto = data.data["MROLLOCOMPLETO"];

        stockRollos = data.data["ROLLOS"];

        metrajeTela.value =
          parseFloat(metrosCompleto) * parseInt(stockRollos) +
          (parseFloat(metrosCompleto) == parseFloat(stockMetros)
            ? 0
            : parseFloat(stockMetros));
            
        console.log(metrajeTela.value);
        //metrajeTela.value = 9;
        if (parseInt(metrajeTela.value) < 10) {
          document.getElementById("msg-alert").classList.remove("d-none");
        } else {
          document.getElementById("msg-alert").classList.add("d-none");
        }
      } else {
        console.log("ERROR");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

metrosTela.addEventListener("input", validateTwoInputs);
precioTela.addEventListener("input", validateTwoInputs);
function validateTwoInputs() {
  total =
    parseFloat(metrosCompleto) * parseInt(stockRollos) +
    (parseFloat(metrosCompleto) == parseFloat(stockMetros)
      ? 0
      : parseFloat(stockMetros));

  const isValid =
    parseFloat(metrosTela.value) > 0 &&
    parseFloat(precioTela.value) >=
      parseFloat(document.getElementById("precioTelaRef").value) &&
    parseFloat(metrosTela.value) <= total;
  btnInsertTela.disabled = !isValid;
}

function infoSucursal(btn) {
  var row = btn.parentNode.parentNode;
  var codSucursal = row.getElementsByTagName("td")[2].innerText.trim();

  fetch("/ImportadoraFernandez/Sucursal/getSucursal", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded", // URL-encoded form data
    },
    body: new URLSearchParams({ id: codSucursal }),
  })
    .then((response) => response.json()) // Parse JSON response
    .then((data) => {
      if (data.status === "success") {
        console.log(data);
        document.getElementById("nombreSu").value = data.data["NOMBRE"];
        document.getElementById("direcSu").value = data.data["DIRECCION"];
        document.getElementById("telefSu").value = data.data["TELEFONO"];
      } else {
        console.log("ERROR");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
btnInsertTela.addEventListener("click", function () {
  var table = $("#table4").DataTable();

  table.row
    .add([
      id_tela.value,
      document.getElementById("nomTela").value,
      color_tela.value,
      "<div style='width: 15px; height:15px; display:inline-block; background:" +
        color_tela.value +
        ";'></div>",
      document.getElementById("precioTela").value,
      document.getElementById("metrTela").value,
      parseFloat(document.getElementById("precioTela").value) *
        parseFloat(document.getElementById("metrTela").value),
      "<button type='button' onclick='eliminarFilaDesc(this)' class='btn btn-danger p-2'><i class='fas fa-trash'></i><button>",
    ])
    .draw(false);

  metrosTela.value = "";
});

function eliminarFila(btn) {
  const row = btn.parentNode.parentNode;
  var table = $("#table4").DataTable();
  table.row($(row)).remove().draw();
}

function eliminarFilaDesc(btn) {
  const rowPrice = btn.parentNode.parentNode;
  const price =
    parseFloat(rowPrice.cells[4].innerText) *
    parseFloat(rowPrice.cells[5].innerText);

  document.getElementById("priceTotal").innerText =
    parseFloat(document.getElementById("priceTotal").innerText) -
    parseFloat(price);

  const row = btn.parentNode.parentNode;
  var table = $("#table4").DataTable();
  table.row($(row)).remove().draw();
}

function guardarTelas() {
  const table = document
    .getElementById("table4")
    .getElementsByTagName("tbody")[0];
  //console.log(inputCliente.value);

  if (
    table.getElementsByTagName("tr")[0].innerText != "Sin resultados" &&
    inputCliente.value != ""
  ) {
    document.getElementById("realizarVenta").type = "submit";
    const rows = table.getElementsByTagName("tr");
    const form = document.getElementById("form-venta-telas");
    let i = 0;
    totalTelaVenta = document.getElementById("total");
    for (; i < rows.length; i++) {
      const cells = rows[i].getElementsByTagName("td");

      form.appendChild(crearInput("codtela", i, cells, 0));

      form.appendChild(crearInput("nombre", i, cells, 1));

      form.appendChild(crearInput("codcolor", i, cells, 2));

      form.appendChild(crearInput("precio", i, cells, 4));

      form.appendChild(crearInput("cantidad", i, cells, 5));
    }
    totalTelaVenta.value = i;
  }
}

function crearInput(nombre, i, cells, key) {
  const input = document.createElement("input");
  input.type = "hidden";
  input.name = nombre + i;
  input.value = cells[key].textContent;
  return input;
}

function subtotal() {
  const total = document.getElementById("priceTotal");
  const table = document
    .getElementById("table4")
    .getElementsByTagName("tbody")[0];

  filas = table.rows.length;
  sumtotal = 0;
  if (table.getElementsByTagName("tr")[0].innerText != "Sin resultados") {
    for (let i = 0; i < table.rows.length; i++) {
      const fila = table.rows[i];
      sumtotal +=
        parseFloat(fila.cells[4].innerText) *
        parseFloat(fila.cells[5].innerText);
    }
  }
  total.innerText = sumtotal;
  if (sumtotal != 0) {
    siguienteSeccion();
  }
}

function verificarTelas() {
  if (parseInt(document.getElementById("priceTotal").innerText) != 0) {
    siguienteSeccion();
  }
}

function addFormModalClient() {
  console.log("hola");
}
