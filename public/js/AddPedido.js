let numeroFila = -1;
const VAL = new Validator();
function quitarProducto(btn) {
    btn.parentNode.parentNode.remove();
    console.log("ver");
}

function completarDetalleTela(btn) {
    filaTela = btn.parentNode.parentNode;
    numeroFila = filaTela.rowIndex;
    console.log(numeroFila);

    document.getElementById("nomTela").value =
        filaTela.cells[0].textContent.trim();
    document.getElementById("marcTela").value =
        filaTela.cells[2].textContent.trim();
    document.getElementById("caliTela").value =
        filaTela.cells[5].textContent.trim();
    document.getElementById("cantidadRollo").value =
        filaTela.cells[7].textContent.trim();

    document.getElementById("metros").value =
        filaTela.cells[8].textContent.trim();

    document.getElementById("precioTelaRollo").value =
        filaTela.cells[9].textContent.trim();

    document.getElementById("precioTelaRolloVenta").value =
        filaTela.cells[10].textContent.trim();

    document.getElementById("precioTelaMetro").value =
        filaTela.cells[11].textContent.trim();
}

document.getElementById("cantidadRollo").addEventListener("input", function () {
    err = document.getElementById("err_cantidadRollo");
    if (parseInt(this.value) < 1 || !VAL.isNumber(this.value)) {
        this.classList.add("error");
        err.textContent = "Valor inválido";
    } else {
        err.textContent = "";
        this.classList.remove("error");
    }
    checkInputs();
});

document.getElementById("metros").addEventListener("input", function () {
    err = document.getElementById("err_metros");
    if (parseInt(this.value) < 1 || !VAL.isNumber(this.value)) {
        this.classList.add("error");
        err.textContent = "Valor inválido";
    } else {
        err.textContent = "";
        this.classList.remove("error");
    }
    checkInputs();
});

document
    .getElementById("precioTelaRollo")
    .addEventListener("input", function () {
        err = document.getElementById("err_precioTelaRollo");
        if (parseInt(this.value) < 1 || !VAL.isNumber(this.value)) {
            this.classList.add("error");
            err.textContent = "Valor inválido";
        } else {
            err.textContent = "";
            this.classList.remove("error");
        }
        checkInputs();
    });

document
    .getElementById("precioTelaMetro")
    .addEventListener("input", function () {
        err = document.getElementById("err_precioTelaMetro");
        if (parseInt(this.value) < 1 || !VAL.isNumber(this.value)) {
            this.classList.add("error");
            err.textContent = "Valor inválido";
        } else {
            err.textContent = "";
            this.classList.remove("error");
        }
        checkInputs();
    });

document
    .getElementById("precioTelaRolloVenta")
    .addEventListener("input", function () {
        err = document.getElementById("err_precioTelaRolloVenta");
        if (parseInt(this.value) < 1 || !VAL.isNumber(this.value)) {
            this.classList.add("error");
            err.textContent = "Valor inválido";
        } else {
            err.textContent = "";
            this.classList.remove("error");
        }
        checkInputs();
    });

function checkInputs() {
    const inputs = [
        "cantidadRollo",
        "metros",
        "precioTelaRollo",
        "precioTelaMetro",
        "precioTelaRolloVenta",
    ];
    let isCorrect = true;
    for (let input of inputs) {
        let x = parseFloat(document.getElementById(input).value);
        if (x < 1 || isNaN(x)) {
            document.getElementById("modTabla").disabled = true;
            isCorrect = false;
            break;
        }
    }
    if (isCorrect) {
        document.getElementById("modTabla").disabled = false;
    }
}

function modTable() {
    const tabla = document
        .getElementById("tablaPedido")
        .getElementsByTagName("tbody")[0];

    console.log(tabla.rows[numeroFila - 2].cells[0]);

    tabla.rows[numeroFila - 2].cells[5].textContent =
        document.getElementById("caliTela").value;

    tabla.rows[numeroFila - 2].cells[6].textContent = calidad(
        document.getElementById("caliTela").value
    );

    tabla.rows[numeroFila - 2].cells[7].textContent =
        document.getElementById("cantidadRollo").value;

    tabla.rows[numeroFila - 2].cells[8].textContent =
        document.getElementById("metros").value;

    tabla.rows[numeroFila - 2].cells[9].textContent =
        document.getElementById("precioTelaRollo").value;

    tabla.rows[numeroFila - 2].cells[10].textContent = document.getElementById(
        "precioTelaRolloVenta"
    ).value;

    tabla.rows[numeroFila - 2].cells[11].textContent =
        document.getElementById("precioTelaMetro").value;
}

function calidad(num) {
    switch (parseInt(num)) {
        case 1:
            return "1RA";
        case 2:
            return "2DA";
        case 3:
            return "3RA";
        case 4:
            return "4TA";
    }
}

function validarTabla() {
    const tabla = document
        .getElementById("tablaPedido")
        .getElementsByTagName("tbody")[0];

    if (tabla.rows.length == 0) {
        document
            .getElementById("msg-data-incomplete")
            .classList.remove("d-none");
        return 0;
    }
    for (i = 0; i < tabla.rows.length; i++) {
        for (j = 7; j <= 11; j++) {
            if (parseFloat(tabla.rows[i].cells[j].textContent.trim()) <= 0) {
                document
                    .getElementById("msg-data-incomplete")
                    .classList.remove("d-none");
                return 0;
            } else {
                document
                    .getElementById("msg-data-incomplete")
                    .classList.add("d-none");
            }
        }
    }

    const form = document.getElementById("form-pedido");
    const Columns = Array(
        "nombre",
        "codmarca",
        "marca",
        "codcolor",
        "color",
        "codcalidad",
        "calidad",
        "cantidad",
        "metroRollo",
        "precioRollo",
        "precioVRollo",
        "precioMetro"
    );
    for (i = 0; i < tabla.rows.length; i++) {
        for (j = 0; j < tabla.rows[i].cells.length; j++) {
            const input = document.createElement("input");
            input.type = "hidden";
            input.name = i + "-" + Columns[j];
            input.value = tabla.rows[i].cells[j].textContent.trim();
            form.appendChild(input);
        }
    }

    const input = document.createElement("input");
    input.type = "hidden";
    input.name = "tam";
    input.value = tabla.rows.length;
    form.appendChild(input);

    form.submit();
}
