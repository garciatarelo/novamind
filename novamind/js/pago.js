document.getElementById("btnGuardar").onclick=(event)=>{
    event.preventDefault()//evita recargar la pagina
    document.getElementById("form").classList.add('was-validated')
    document.querySelector("#AgregarPago").classList.remove("d-none")
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: " Algo salió mal, Favor de llenar todos los campos",
        //footer: '<a href="#">Por favor llena todos los campos</a>'
      });
}


const btnBuscarPago = document.getElementById('btnBuscarPago');
const inputPagoId = document.getElementById('inputPagoId');
const inputFechaPago = document.getElementById('inputFechaPago');
const modalBuscarPago = new bootstrap.Modal(document.getElementById('modalBuscarPago'));
const modalAlerta = new bootstrap.Modal(document.getElementById('modalAlerta'));

// Evento al hacer clic en el botón Buscar
btnBuscarPago.addEventListener('click', function () {
    const pagoId = inputPagoId.value.trim(); // Eliminar espacios en blanco
    const fechaPago = inputFechaPago.value.trim(); // Obtener valor del campo de fecha

    if (pagoId === "" || fechaPago === "") {
        // Mostrar el modal de alerta si faltan datos
        modalAlerta.show();
    } else {
        // Mostrar el modal de datos si todos los campos están completos
        modalBuscarPago.show();
    }
});

