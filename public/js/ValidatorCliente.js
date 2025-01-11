console.log('traj')
const VAL = new Validator();

const btnSave = document.getElementById("btnSave");
btnSave.disabled = true;

document.getElementById("nameCli").addEventListener("input", function () {
    if (VAL.isLetter(this.value)) {
        this.classList.remove("error");
        btnSave.disabled = false;
    } else {
        this.classList.add("error");
        btnSave.disabled = true;
    }

    if (this.classList.contains("error") && this.value.length == 0) {
        document.getElementById("error_razon").textContent =
            "Campo obligatorio";
    } else if (this.classList.contains("error")) {
        document.getElementById("error_razon").textContent =
            "Caracteres no admitídos";
    } else {
        document.getElementById("error_razon").textContent = "";
    }
});

document.getElementById("cinitCli").addEventListener("input", function () {
    formData = new FormData();
    formData.append("ci", this.value);

    fetch("/ImportadoraFernandez/Cliente/verificarCI", {
        method: "POST",
        body: formData,
    })
        .then((response) => response.json())
        .then((result) => {
            if (VAL.isDniNit(this.value)) {
                this.classList.remove("error");
                btnSave.disabled = false;
            } else {
                this.classList.add("error");
                btnSave.disabled = true;
            }
            

            if (this.classList.contains("error") && this.value.length == 0) {
                document.getElementById("error_cinit").textContent =
                    "Campo obligatorio";
            } else if (this.classList.contains("error")) {
                document.getElementById("error_cinit").textContent =
                    "Debe contener almenos 7 dígitos";
            } else if(!result){
                document.getElementById("error_cinit").textContent = "El cliente no puede ser registrado";
                this.classList.add("error");
                btnSave.disabled = true;
            } else {
                document.getElementById("error_cinit").textContent = "";
            }
        })
        .catch((error) => console.error("ERROR:...", error));

});
document.getElementById("celCli").addEventListener("input", function () {
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


