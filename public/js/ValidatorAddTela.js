const nameTela = document.getElementById("nameTela");
const btnValidor = document.getElementById("sigOne");
const VAL = new Validator();

nameTela.addEventListener("input", function () {
    if (VAL.isLetter(this.value)) {
        this.classList.remove("error");
        btnValidor.disabled = false;
    } else {
        this.classList.add("error");
        btnValidor.disabled = true;
    }

    if (this.classList.contains("error") && this.value.length == 0) {
        document.getElementById("error_name_tela").textContent =
            "Campo obligatorio";
    } else if (this.classList.contains("error")) {
        document.getElementById("error_name_tela").textContent =
            "Ingr. carácteres válidos";
    } else {
        document.getElementById("error_name_tela").textContent = "";
    }
});

document
    .getElementById("precioRealRollo")
    .addEventListener("input", function () {
        if (parseFloat(this.value) > 0) {
            this.classList.remove("error");
            btnValidor.disabled = false;
        } else {
            this.classList.add("error");
            btnValidor.disabled = true;
        }

        if (this.classList.contains("error") && this.value.length == 0) {
            document.getElementById("error_precioRealRollo").textContent =
                "Campo obligatorio";
        } else if (this.classList.contains("error")) {
            document.getElementById("error_precioRealRollo").textContent =
                "El précio no puede ser negativo";
        } else {
            document.getElementById("error_precioRealRollo").textContent = "";
        }
    });

document.getElementById("metroRollo").addEventListener("input", function () {
    if (parseFloat(this.value) > 0) {
        this.classList.remove("error");
        btnValidor.disabled = false;
    } else {
        this.classList.add("error");
        btnValidor.disabled = true;
    }

    if (this.classList.contains("error") && this.value.length == 0) {
        document.getElementById("error_metroRollo").textContent =
            "Campo obligatorio";
    } else if (this.classList.contains("error")) {
        document.getElementById("error_metroRollo").textContent =
            "Debe ingresar un valor mayor a 0";
    } else {
        document.getElementById("error_metroRollo").textContent = "";
    }
});

document.getElementById("precioMetro").addEventListener("input", function () {
    if (parseFloat(this.value) > 0) {
        this.classList.remove("error");
        btnValidor.disabled = false;
    } else {
        this.classList.add("error");
        btnValidor.disabled = true;
    }

    if (this.classList.contains("error") && this.value.length == 0) {
        document.getElementById("error_precioMetro").textContent =
            "Campo obligatorio";
    } else if (this.classList.contains("error")) {
        document.getElementById("error_precioMetro").textContent =
            "Debe ingresar un valor mayor a 0";
    } else {
        document.getElementById("error_precioMetro").textContent = "";
    }
});

document.getElementById("btnSigforSAVE").addEventListener("click", function () {
    const total = document.getElementById("totalRollos");
    if (parseInt(total.value) > 0) {
        document.getElementById("btnSave").disabled = false;
    } else {
        document.getElementById("btnSave").disabled = true;
    }
});
