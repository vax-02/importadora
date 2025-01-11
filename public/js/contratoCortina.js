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
    }
}

function verificarSeleccionCliente() {
    cliente = document.getElementById("cliente");
    if (cliente.value.length != 0) {
        siguienteSeccion();
    }
}
