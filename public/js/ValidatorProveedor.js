const VAL = new Validator();
const btnSave = document.getElementById("btnSave");

document.getElementById("nombre").addEventListener("input", function () {
    if (VAL.isLetter(this.value)) {
        this.classList.remove("error");
        btnSave.disabled = false;
    } else {
        this.classList.add("error");
        btnSave.disabled = true;
    }
    if (this.classList.contains("error") && this.value.length == 0) {
        document.getElementById("error_nombre").textContent =
            "Campo obligatorio";
    } else if (this.classList.contains("error")) {
        document.getElementById("error_nombre").textContent =
            "Nombre no válido";
    } else {
        document.getElementById("error_nombre").textContent = "";
    }
});


document.getElementById("cel").addEventListener("input", function () {
    if (VAL.isCellPhone(this.value)) {
        this.classList.remove("error");
        btnSave.disabled = false;
    } else {
        this.classList.add("error");
        btnSave.disabled = true;
    }
    if (this.classList.contains("error") && this.value.length == 0) {
        document.getElementById("error_cel").textContent =
            "Campo obligatorio";
    } else if (this.classList.contains("error")) {
        document.getElementById("error_cel").textContent =
            "Debe tener 8 dígitos";
    } else {
        document.getElementById("error_cel").textContent = "";
    }
});

