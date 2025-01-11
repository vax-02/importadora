//const VAL = new Validator();
const btnAdd = document.getElementById("btnAdd");
document.getElementById("alto").addEventListener("input", function () {
    if ((VAL.isNumber(this.value) && parseFloat(this.value) > 0) ||  this.value.length == 0) {
        this.classList.remove("error");
        btnAdd.disabled = false;
    } else {
        this.classList.add("error");
        btnAdd.disabled = true;
    }
    if (this.classList.contains("error")) {
        document.getElementById("error_alto").textContent =
            "Debe ser un valor mayor a 0";
    } else {
        document.getElementById("error_alto").textContent = "";
    }
});

document.getElementById("ancho").addEventListener("input", function () {
    if ((VAL.isNumber(this.value) && parseFloat(this.value) > 0) ||  this.value.length == 0) {
        this.classList.remove("error");
        btnAdd.disabled = false;
    } else {
        this.classList.add("error");
        btnAdd.disabled = true;
    }
    if (this.classList.contains("error")) {
        document.getElementById("error_ancho").textContent =
            "Debe ser un valor mayor a 0";
    } else {
        document.getElementById("error_ancho").textContent = "";
    }
});

document.getElementById("cantidadV").addEventListener("input", function () {
    if ((VAL.isNumber(this.value) && parseFloat(this.value) > 0) ||  this.value.length == 0) {
        this.classList.remove("error");
        btnAdd.disabled = false;
    } else {
        this.classList.add("error");
        btnAdd.disabled = true;
    }
    if (this.classList.contains("error")) {
        document.getElementById("error_cantidad").textContent =
            "Debe ser un valor mayor a 0";
    } else {
        document.getElementById("error_cantidad").textContent = "";
    }
});

document.getElementById("precio_sastre").addEventListener("input", function () {
    if (VAL.isNumber(this.value) && parseFloat(this.value)>0) {
        this.classList.remove("error");
    } else {
        this.classList.add("error");
    }
    
    if (this.classList.contains("error") && this.value.length == 0) {
        document.getElementById("error_precio_sastre").textContent =
            "Campo obligatorio";
    } else if (this.classList.contains("error")) {
        document.getElementById("error_precio_sastre").textContent =
            "El precio debe ser mayor a 0";
    } else {
        document.getElementById("error_precio_sastre").textContent = "";
    }

});


document.getElementById("metros_tela").addEventListener("input", function () {
    if (VAL.isNumber(this.value) && parseFloat(this.value)>0) {
        this.classList.remove("error");
    } else {
        this.classList.add("error");
    }
    
    if (this.classList.contains("error") && this.value.length == 0) {
        document.getElementById("error_metros_tela").textContent =
            "Campo obligatorio";
    } else if (this.classList.contains("error")) {
        document.getElementById("error_metros_tela").textContent =
            "El valor debe ser mayor a 0";
    } else {
        document.getElementById("error_metros_tela").textContent = "";
    }

});


document.getElementById("precio_tela").addEventListener("input", function () {
    if (VAL.isNumber(this.value) && parseFloat(this.value)>0) {
        this.classList.remove("error");
    } else {
        this.classList.add("error");
    }
    
    if (this.classList.contains("error") && this.value.length == 0) {
        document.getElementById("error_precio_tela").textContent =
            "Campo obligatorio";
    } else if (this.classList.contains("error")) {
        document.getElementById("error_precio_tela").textContent =
            "El costo debe ser mayor a 0";
    } else {
        document.getElementById("error_precio_tela").textContent = "";
    }

});


