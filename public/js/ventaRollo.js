let stockMetros, stockRollos, metrosCompleto;

const id_tela = document.getElementById("id_tela");
const color_tela = document.getElementById("color_tela");

const precioRollo = document.getElementById("precioRollo");
const rollosCompra = document.getElementById("rollosCompra");

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
    document.getElementById("btn-select-client").disabled = true;
  } else {
    inputCliente.value = celdas[0].innerText.trim();
    document.getElementById("btn-select-client").disabled = false;
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
      const numrollos = document.getElementById("numrollos");
      console.log(data);
      if (data.status === "success") {
        color_tela.value = data.data["CODCOLOR"];
        id_tela.value = data.data["CODTELA"];
        nomTela.value = data.data["NOMBRE"];
        marcTela.value = data.data["MARCA"];
        caliTela.value = data.data["CALIDAD"];
        precioRollo.value = data.data["PRECIOROLLO"];

        stockMetros = data.data["METROS"];
        metrosCompleto = data.data["MROLLOCOMPLETO"];

        stockRollos = data.data["ROLLOS"];

        numrollos.value = stockRollos;

        if (parseInt(stockRollos) < 5) {
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

rollosCompra.addEventListener("input", validateTwoInputs);

function validateTwoInputs() {
  btnInsertTela.disabled =
    parseInt(numrollos.value) >= parseInt(rollosCompra.value) &&
    parseInt(rollosCompra.value) > 0
      ? false
      : true;
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
        //console.log(data);
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
      document.getElementById("precioRollo").value,
      document.getElementById("rollosCompra").value,
      parseFloat(document.getElementById("precioRollo").value) *
        parseFloat(document.getElementById("rollosCompra").value),
      "<button type='button' onclick='eliminarFilaDesc(this)' class='btn btn-danger p-2'><i class='fas fa-trash'></i><button>",
    ])
    .draw(false);

  rollosCompra.value = "";
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
  document.getElementById("costo_c").value = sumtotal;
  document.getElementById("total").value = sumtotal;

  if (sumtotal != 0) {
    siguienteSeccion();
  }
}

function verificarTelas() {
  if (parseInt(document.getElementById("priceTotal").innerText) != 0) {
    siguienteSeccion();
  }
}


document.getElementById("descuento").addEventListener("input", function () {
  desc = document.getElementById("val-descuento");
  document.getElementById("desc_input").value = this.value;
  desc.innerText = this.value;

  document.getElementById("total").value = redondeo(
    parseFloat(
      document.getElementById("costo_c").value -
        parseFloat(document.getElementById("costo_c").value) *
          (parseInt(desc.innerText) / 100)
    )
  );
});

function redondeo(val) {
  if (parseFloat((parseFloat(val.toFixed(1)) % 1).toFixed(1)) == 0.1) {
    return parseInt(val.toFixed(1));
  }
  return parseFloat(val.toFixed(1));
}