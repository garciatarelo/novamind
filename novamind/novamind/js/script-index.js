document.addEventListener("DOMContentLoaded", function() {
    const nav = document.getElementById('nav');
    const abrir = document.getElementById('open-menu');
    const cerrar = document.getElementById('close-menu');

    if (abrir) {
        abrir.addEventListener('click', () => {
            nav.classList.add("visible");
        });
    } else {
        console.log("El elemento con id 'open-menu' no se encontró.");
    }

    if (cerrar) {
        cerrar.addEventListener('click', () => {
            nav.classList.remove("visible");
        });
    } else {
        console.log("El elemento con id 'close-menu' no se encontró.");
    }
});
