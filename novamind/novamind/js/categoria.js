/*ELIMINAR*/
document.querySelectorAll('.btnEliminarCategoria').forEach(button => {
    button.addEventListener('click', function () {
        Swal.fire({
            title: '¿Deseas eliminar esta categoría?',
            text: "¡No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('¡Eliminado!', 'La categoría ha sido eliminada.', 'success');
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

    document.getElementById("btnGuardarCategoria").onclick=(event)=>{
        event.preventDefault()//evita recargar la pagina
        document.getElementById("formCategoria").classList.add('was-validated')
        document.querySelector("#alertaCategoria").classList.remove("d-none")
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: " Algo salió mal, Favor de llenar todos los campos",
            //footer: '<a href="#">Por favor llena todos los campos</a>'
          });
    }

    // Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
  
        form.classList.add('was-validated')
      }, false)
    })
  })()