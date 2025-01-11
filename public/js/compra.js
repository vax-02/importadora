const totalTela = document.getElementById("total");
const nombreTela = document.getElementById("nombre");
const cantidad = document.getElementById("cantidad");
const tableCompra = document
    .getElementById("tablaCompra")
    .getElementsByTagName("tbody")[0];

function agregarRolloCompra() {
    if (cantidad.value != "") {
        let nuevaTela = tableCompra.insertRow();
        var cellNombre = nuevaTela.insertCell(0);

        var cellCodMarca = nuevaTela.insertCell(1);
        var cellMarca = nuevaTela.insertCell(2);

        var cellCodColor = nuevaTela.insertCell(3);
        var cellColor = nuevaTela.insertCell(4);

        var cellCodCalidad = nuevaTela.insertCell(5);
        var cellCalidad = nuevaTela.insertCell(6);

        var cellCantidad = nuevaTela.insertCell(7);
        var cellOpcion = nuevaTela.insertCell(8);

        cellNombre.innerHTML = nombreTela.value;

        cellCodMarca.classList.add("ocultar-columna");
        cellCodColor.classList.add("ocultar-columna");
        cellCodCalidad.classList.add("ocultar-columna");
        cellCodMarca.innerHTML = document.getElementById("marca").value;
        cellMarca.innerHTML =
            document.getElementById("marca").options[
                document.getElementById("marca").selectedIndex
            ].text;
        cellCodColor.innerHTML = document.getElementById("color").value;
        cellColor.classList.add("centrar-color");
        cellColor.innerHTML =
            '<div style="width:15px; height:15px; background: ' +
            document.getElementById("color").value +
            ' ;"><div>';

        cellCodCalidad.innerHTML = document.getElementById("calidad").value;
        cellCalidad.innerHTML =
            document.getElementById("calidad").options[
                document.getElementById("calidad").selectedIndex
            ].text;

        cellCantidad.innerHTML = cantidad.value;

        cellOpcion.innerHTML =
            '<button class="btn btn-danger" onclick="removeRow(this)"><i class="fas fa-trash"><i></button>';

        cantidad.value = "";

        /*
        const filasTable = document.getElementById("tablaCompra");

        filaForFila = filasTable.rows;

        for (var i = 1; i < filaForFila.length; i++) {
            if( 
                console.log('nombre',filaForFila[i].cells[0].textContent);



             ){

            }
            console.log('marca',filaForFila[i].cells[2].textContent);
            console.log('color',filaForFila[i].cells[3].textContent);
            console.log('calidad',filaForFila[i].cells[6].textContent);


        }
        */
    }
}

function guardar() {
    const rows = tableCompra.getElementsByTagName("tr");
    const form = document.getElementById("form-telas");
    let i = 0;
    for (; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName("td");

        form.appendChild(crearInput("nombre", i, cells, 0));

        form.appendChild(crearInput("codmarca", i, cells, 1));

        form.appendChild(crearInput("codcolor", i, cells, 3));

        form.appendChild(crearInput("codcalidad", i, cells, 5));

        form.appendChild(crearInput("cantidad", i, cells, 7));
    }
    totalTela.value = i;
}

function crearInput(nombre, i, cells, key) {
    const input = document.createElement("input");
    input.type = "hidden";
    input.name = nombre + i;
    input.value = cells[key].textContent;
    return input;
}

document.getElementById("btnSave").addEventListener("mouseenter", function () {
    const numeroDeFilas = tableCompra.rows.length;
    if (numeroDeFilas > 0) {
        this.type = "submit";
        this.classList.remove("btn_not_available");
    } else {
        this.type = "button";
        this.classList.add("btn_not_available");
    }
});

