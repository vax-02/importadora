function viewPass() {
    const input = document.getElementById("pass");
    const btnPass = document.getElementById("btnPass"); // Usar `const` para la variable

    if (input.type === "password") {
        input.type = "text"; // Cambiar el tipo a texto
        btnPass.innerHTML = "<i class='fas fa-eye-slash'></i>"; // Usar el ícono adecuado
    } else {
        input.type = "password"; // Cambiar el tipo de nuevo a contraseña
        btnPass.innerHTML = "<i class='fas fa-eye'></i>"; // Usar el ícono adecuado
    }
}
