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

function sumarTelas() {
    let allRollos = 0;
    let table = document
        .getElementById("tableTelas")
        .getElementsByTagName("tbody")[0];

    const rows = table.getElementsByTagName("tr");

    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName("td");
        const cell = cells[2];
        allRollos += parseInt(cell.textContent);
    }

    const inputTotal = document.getElementById("totalRollos");
    inputTotal.value = allRollos;
    siguienteSeccion();
}

const precioRealRollo = document.getElementById("precioRealRollo");
const metrosRollo = document.getElementById("metroRollo");
const precioVentaRollo = document.getElementById("precioVentaRollo");
const precioMetro = document.getElementById("precioMetro");

metrosRollo.addEventListener("input", function () {
    let precioPorMetro =
        parseInt(precioVentaRollo.value) +
        parseInt(precioVentaRollo.value) * 0.1;
    if (this.value > 0) {
        precioMetro.value = Math.ceil(
            parseInt(precioPorMetro) / parseInt(this.value),
            0
        );
    }
});

precioRealRollo.addEventListener("input", () => {
    precioVentaRollo.value = Math.round(
        parseInt(precioRealRollo.value) + parseInt(precioRealRollo.value) * 0.2,
        0
    );
});

precioMetro.addEventListener("input", () => {
    const ganancia = document.getElementById("ganancia");
    const inputTotal = document.getElementById("totalRollos");

    ganancia.value = "0";
    parseFloat(this.value) *
        parseInt(metrosRollo.value) *
        parseInt(inputTotal.value) -
        parseInt(precioRealRollo.value) * parseInt(inputTotal.value);
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

