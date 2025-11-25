/*ELIMINAR*/
document.querySelectorAll('.btnEliminarPago').forEach(button => {
    button.addEventListener('click', function () {
        Swal.fire({
            title: '¿Deseas eliminar este pago?',
            text: "¡No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('¡Eliminado!', 'El pago ha sido eliminado.', 'success');
                // Aquí puedes agregar la lógica para eliminar el elemento
            }
        });
    });
  });