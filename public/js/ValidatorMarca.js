const VAL = new Validator();
const btnSave = document.getElementById("btnSave");
document.getElementById("descri").addEventListener("input", function () {
    if (VAL.isLetter(this.value)) {
        this.classList.remove("error");
        btnSave.disabled = false;
    } else {
        this.classList.add("error");
        btnSave.disabled = true;
    }
    
    if (this.classList.contains("error") && this.value.length == 0) {
        document.getElementById("error_descri").textContent =
            "Campo obligatorio";
    } else if (this.classList.contains("error")) {
        document.getElementById("error_descri").textContent =
            "Carácteres no validos";
    } else {
        document.getElementById("error_descri").textContent = "";
    }

});
