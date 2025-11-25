document.addEventListener("DOMContentLoaded", function () {
    // Toggle para la contraseña
    const togglePassword = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("password");
    const toggleConfirmPassword = document.getElementById("toggleConfirmPassword");
    const confirmPasswordInput = document.getElementById("confirmPassword");

    // Función para mostrar/ocultar contraseña
    function toggleInputVisibility(input, toggleElement) {
        const type = input.getAttribute("type") === "password" ? "text" : "password";
        input.setAttribute("type", type);
        
        // Cambiar el ícono según el estado de visibilidad
        toggleElement.innerHTML = type === "password" ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
    }

    // Evento para el primer campo de contraseña
    if (togglePassword && passwordInput) {
        togglePassword.addEventListener("click", function () {
            toggleInputVisibility(passwordInput, togglePassword);
        });
    }

    // Evento para el segundo campo de confirmación de contraseña
    if (toggleConfirmPassword && confirmPasswordInput) {
        toggleConfirmPassword.addEventListener("click", function () {
            toggleInputVisibility(confirmPasswordInput, toggleConfirmPassword);
        });
    }
});



/*SCRIPT FECHA DE NACIMIENTO-*/

document.addEventListener("DOMContentLoaded", function () {
    // Rellenar el select de días (1 al 31)
    const daySelect = document.getElementById("day");
    if (daySelect) { // Comprobar si el elemento existe
        for (let day = 1; day <= 31; day++) {
            let option = document.createElement("option");
            option.value = day;
            option.textContent = day;
            daySelect.appendChild(option);
        }
    }

    // Rellenar el select de meses (1 al 12)
    const monthSelect = document.getElementById("month");
    if (monthSelect) { // Comprobar si el elemento existe
        const months = [
            "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        ];
        for (let month = 1; month <= 12; month++) {
            let option = document.createElement("option");
            option.value = month;
            option.textContent = months[month - 1]; // Los meses son indexados desde 0
            monthSelect.appendChild(option);
        }
    }

    // Rellenar el select de años (desde el año actual hasta 1930)
    const yearSelect = document.getElementById("year");
    if (yearSelect) { // Comprobar si el elemento existe
        const currentYear = new Date().getFullYear();
        const startYear = 1930; // Puedes ajustar este valor si necesitas un año mínimo diferente
        for (let year = currentYear; year >= startYear; year--) {
            let option = document.createElement("option");
            option.value = year;
            option.textContent = year;
            yearSelect.appendChild(option);
        }
    }
});





