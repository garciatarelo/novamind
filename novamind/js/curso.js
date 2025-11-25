    var botones = document.getElementsByClassName("btnEliminarCurso");

    
    //ELIMINAR
    for(var i = 0; i < botones.length;i++){
        botones[i].onclick=(evt)=>{
        var btn = evt.target
        var id = btn.getAttribute('data-id')
        //alert("ID:"+id)
        /*ELIMINAR*/
    document.querySelectorAll('.btnEliminarCurso').forEach(button => {
        button.addEventListener('click', function () {
            Swal.fire({
                title: '¿Deseas eliminar este curso?',
                text: "¡No podrás revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                location.href="../php/eliminarCurso.php?id="+id
                    //Swal.fire('¡Eliminado!', 'El usuario ha sido eliminado.', 'success');
                    // Aquí puedes agregar la lógica para eliminar el elemento
                }
            });
        });
    });
        }
    }
  

   var botonesEditar = document.getElementsByClassName("btnEditar")
    //EDITAR
    for(var i = 0; i < botonesEditar.length; i++){
      botonesEditar[i].onclick=(evt)=>{
        //var btn = evt.target
        var btn = evt.target.closest(".btnEditar");

        var name = btn.getAttribute('data-name')
        document.getElementById("txtNameEdit").value= name
    
        var description = btn.getAttribute('data-description')
        document.getElementById("txtDescriptionEdit").value= description
    
        var level = btn.getAttribute('data-level')
        document.getElementById("txtLevelEdit").value= level
    
        var status = btn.getAttribute('data-status')
        document.getElementById("txtStatusEdit").value= status
    
        var duration = btn.getAttribute('data-duration')
        document.getElementById("txtDurationEdit").value= duration
    
        var category = btn.getAttribute('data-category')
        document.getElementById("txtCategoryEdit").value= category
    
        var instructor = btn.getAttribute('data-instructor')
        document.getElementById("txtInstructorEdit").value= instructor
    
        var startdate = btn.getAttribute('data-startDate')
        document.getElementById("txtStartDateEdit").value= startdate

        var cost = btn.getAttribute('data-cost')
        document.getElementById("txtCostEdit").value= cost

        var id = btn.getAttribute('data-id')
        document.getElementById("txtIdEdit").value= id
      }
    }

    
  