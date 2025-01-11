var secciones = document.querySelectorAll(".form-section");

var indiceSeccionActual = 0;
mostrarSeccionActual();

function mostrarSeccionActual() {
    // Ocultar todas las secciones
    secciones.forEach(function (seccion) {
        seccion.classList.remove("active");
    });
    // Mostrar la sección actual
    secciones[indiceSeccionActual].classList.add("active");
}

function siguienteSeccion() {
    if (indiceSeccionActual < secciones.length - 1) {
        indiceSeccionActual++;
        mostrarSeccionActual();
    }
}

function anteriorSeccion() {
    if (indiceSeccionActual > 0) {
        indiceSeccionActual--;
        mostrarSeccionActual();
    }
}

 function removeRow(button) {
    // Obtiene la fila que contiene el botón
    var row = button.parentNode.parentNode;

    // Elimina la fila
    row.parentNode.removeChild(row);
}
