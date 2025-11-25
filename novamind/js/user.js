


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
/*
  document.getElementById("btnGuardarAgregar").onclick=(event)=>{
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
*/

var botones = document.getElementsByClassName("btnEliminar")

//ELIMINAR
for(var i = 0; i < botones.length;i++){
  botones[i].onclick=(evt)=>{
    var btn = evt.target
    var id = btn.getAttribute('data-id')
    //alert("ID:"+id)
    /*ELIMINAR*/
document.querySelectorAll('.btnEliminar').forEach(button => {
  button.addEventListener('click', function () {
      Swal.fire({
          title: '¿Deseas eliminar este usuario?',
          text: "¡No podrás revertir esta acción!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Eliminar',
          cancelButtonText: 'Cancelar'
      }).then((result) => {
          if (result.isConfirmed) {
            location.href="../php/removeUser.php?id="+id
              //Swal.fire('¡Eliminado!', 'El usuario ha sido eliminado.', 'success');
              // Aquí puedes agregar la lógica para eliminar el elemento
          }
      });
  });
});
  }
}


var botonesEditar = document.getElementsByClassName("btnEditar");

for(var i = 0; i < botonesEditar.length; i++){
  botonesEditar[i].onclick = (evt) => {
    var btn = evt.target.closest(".btnEditar");

    const email = btn.getAttribute('data-email');
    document.getElementById("txtEmailEdit").value = email;

    const name = btn.getAttribute('data-name');
    document.getElementById("txtNameEdit").value = name;

    const ap = btn.getAttribute('data-ap');
    document.getElementById("txtApEdit").value = ap;

    const am = btn.getAttribute('data-am');
    document.getElementById("txtAmEdit").value = am;

    const username = btn.getAttribute('data-username');
    document.getElementById("txtUsernameEdit").value = username;

    const birthdate = btn.getAttribute('data-birthDate');
    document.getElementById("txtBirthdateEdit").value = birthdate;

    const offer = btn.getAttribute('data-offer');
    document.getElementById("txtOfferEdit").value = offer;

    const id = btn.getAttribute('data-id');
    document.getElementById("txtIdEdit").value = id;
  };
}

