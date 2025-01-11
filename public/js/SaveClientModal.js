cinitCli = document.getElementById("cinitCli");
nameCli = document.getElementById("nameCli");
celCli = document.getElementById("celCli");
tipo = document.getElementById("tipo");

function saveClient() {
    formData = new FormData();
    formData.append("ci", cinitCli.value);
    formData.append("name", nameCli.value);
    formData.append("cel", celCli.value);
    formData.append("tipo", tipo.value);

    fetch("/ImportadoraFernandez/Cliente/saveClientModal", {
        method: "POST",
        body: formData,
    })
        .then((response) => response.json())
        .then((result) => {
            var table = new DataTable("#table2");
            var nuevaFila = [
                result.ID,
                result.RAZON,
                result.CINIT,
                result.TIPO,
                '<button type="button" class="btn btn-secondary" onclick="selectClienteTela(this)"> <i class="fa-solid fa-check"></i> </button> ',
            ];

            var rowNode = table.row.add(nuevaFila).draw().node();

            // Añadir la clase especial a la primera celda (columna ID)
            rowNode.cells[0].classList.add("ocultar-columna");
        })
        .catch((error) => {
            //when no created
            console.log("HAY UN ERROR", error);
        });
}
