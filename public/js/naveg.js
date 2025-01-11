const icon_app = document.getElementById('icon-app');
const barra_lateral = document.querySelector('.barra-lateral');
const all_spans = document.querySelectorAll('span');
const switch_theme = document.querySelector('.switch');
const circulo = document.querySelector('.circulo');
const content = document.querySelector('.content');

icon_app.addEventListener("click",function(){
    barra_lateral.classList.toggle('mini-barra-lateral');
    all_spans.forEach((span)=>{
        span.classList.toggle('oculto');
    })
    content.classList.toggle('min-content');
})

window.addEventListener('DOMContentLoaded', (event) => {
    let savedTheme = localStorage.getItem('theme'); // Obtener el tema guardado

    if(savedTheme === 'dark'){
        document.body.classList.add('dark-mode'); // Aplica el tema oscuro si está guardado
        circulo.classList.add('prendido'); // Asegúrate de encender el círculo si es parte del tema oscuro
    } else {
        document.body.classList.remove('dark-mode'); // Aplica el tema claro por defecto
        circulo.classList.remove('prendido'); // Apaga el círculo si es parte del tema claro
    }
});

// Método para alternar el tema y guardar en localStorage
switch_theme.addEventListener('click', function() {
    let body = document.body;
    body.classList.toggle('dark-mode');
    circulo.classList.toggle('prendido');
    // Guardar en localStorage según el tema actual
    if (body.classList.contains('dark-mode')) {
        localStorage.setItem('theme', 'dark'); // Guardar 'dark' en localStorage
    } else {
        localStorage.setItem('theme', 'light'); // Guardar 'light' en localStorage
    }
});
