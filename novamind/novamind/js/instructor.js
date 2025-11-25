/*ELIMINAR*/
document.querySelectorAll('.btnEliminarInstructor').forEach(button => {
    button.addEventListener('click', function () {
        Swal.fire({
            title: '¿Deseas eliminar este instructor?',
            text: "¡No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('¡Eliminado!', 'El instructor ha sido eliminado.', 'success');
                // Aquí puedes agregar la lógica para eliminar el elemento
            }
        });
    });
  });

      /*EDITAR*/
      document.getElementById("btnGuardar").onclick=(event)=>{
        event.preventDefault()//evita recargar la pagina
        document.getElementById("form").classList.add('was-validated')
        document.querySelector("#divAlerta").classList.remove("d-none")
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: " Algo salió mal, Favor de llenar todos los campos",
            //footer: '<a href="#">Por favor llena todos los campos</a>'
          });
    }

    document.getElementById("btnGuardarInstructor").onclick=(event)=>{
        event.preventDefault()//evita recargar la pagina
        document.getElementById("formInstructor").classList.add('was-validated')
        document.querySelector("#alertaInstructor").classList.remove("d-none")
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: " Algo salió mal, Favor de llenar todos los campos",
            //footer: '<a href="#">Por favor llena todos los campos</a>'
          });
    }


 