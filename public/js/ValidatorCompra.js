const VAL = new Validator();

document.getElementById("cantidad").addEventListener("input",function(){
    if (parseInt(this.value) > 0){
        this.classList.remove("error");
    }else{
        this.classList.add("error");
    }
    
    if (this.classList.contains("error") && this.value.length == 0) {
        document.getElementById("error_cantidad").textContent =
            "Campo obligatorio";
    } else if (this.classList.contains("error")) {
        document.getElementById("error_cantidad").textContent =
            "Debe ingresar un valor mayor a 0";
    } else {
        document.getElementById("error_cantidad").textContent = "";
    }

})