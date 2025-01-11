const VAL = new Validator();
const btnSave = document.getElementById("save");

function checkInputLetter(value, objInput) {
    if (VAL.isLetter(value)) {
        objInput.classList.remove("error");
        btnSave.disabled = false;
    } else {
        objInput.classList.add("error");
        btnSave.disabled = true;
    }
}

document.getElementById("namePer").addEventListener("input", function () {
    checkInputLetter(this.value, this);
    if (this.classList.contains("error") && this.value.length == 0) {
        document.getElementById("error_name").textContent = "Campo obligatorio";
    } else if (this.classList.contains("error")) {
        document.getElementById("error_name").textContent = "Nombre no válido";
    } else {
        document.getElementById("error_name").textContent = "";
    }
});

document.getElementById("lastNamePer").addEventListener("input", function () {
    checkInputLetter(this.value, this);
    if (this.classList.contains("error") && this.value.length == 0) {
        document.getElementById("error_paterno").textContent =
            "Campo obligatorio";
    } else if (this.classList.contains("error")) {
        document.getElementById("error_paterno").textContent =
            "Apellido no válido";
    } else {
        document.getElementById("error_paterno").textContent = "";
    }
});

document.getElementById("lasttName2Per").addEventListener("input", function () {
    checkInputLetter(this.value, this);
    if (this.classList.contains("error") && this.value.length == 0) {
        document.getElementById("error_materno").textContent =
            "Campo obligatorio";
    } else if (this.classList.contains("error")) {
        document.getElementById("error_materno").textContent =
            "Apellido no válido";
    } else {
        document.getElementById("error_materno").textContent = "";
    }
});

document.getElementById("numbertPer").addEventListener("input", function () {
    if (VAL.isCellPhone(this.value)) {
        this.classList.remove("error");
        btnSave.disabled = false;
    } else {
        this.classList.add("error");
        btnSave.disabled = true;
    }

    if (this.classList.contains("error") && this.value.length == 0) {
        document.getElementById("error_celular").textContent =
            "Campo obligatorio";
    } else if (this.classList.contains("error")) {
        document.getElementById("error_celular").textContent =
            "Debe tener 8 dígitos";
    } else {
        document.getElementById("error_celular").textContent = "";
    }
});

document.getElementById("pass").addEventListener("input", function () {
    if (VAL.isMinLen(this.value)) {
        this.classList.remove("error");
        btnSave.disabled = false;
    } else {
        this.classList.add("error");
        btnSave.disabled = true;
    }

    if (this.classList.contains("error") && this.value.length == 0) {
        document.getElementById("error_pass").textContent =
            "Campo obligatorio";
    } else if (this.classList.contains("error")) {
        document.getElementById("error_pass").textContent =
            "Ingr. mas de 7 caracteres";
    } else {
        document.getElementById("error_pass").textContent = "";
    }
});
