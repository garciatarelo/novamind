<?php session_start();
    if(!isset($_SESSION['user_data'])){
        header("Location: ../login.php");
    }
    $user_data = $_SESSION['user_data'];


    include "../php/conexion.php";
    $sql = "select * from users order by idUser desc";
    $res= $conexion->query("$sql") or die ($conexion->error);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <!--Iconos Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
   <!-- SweetAlert2 CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css">

    <!--ICONO-->
    <link rel="icon" href="../img/LOGO NOVAMIND-ROBOT.ico">

    <link rel="stylesheet" href="../css/admin/usuario.css">

</head>
<body class="d-flex">
    <!--SIDEBAR-->
    <?php include "../layouts/aside.php"; ?>
    <!--END SIDEBAR-->
    <!--MAIN CONTENT-->
    <main class="flex-grow-1 " >
    <?php include "../layouts/header.php"; ?>
        <section class="container mt-4 p-4">
            
            <!--TITLE SECTION-->
            <div class="d-flex justify-content-between">
                <h4>Usuarios</h4>
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#agregarUsuario">
                    <i class="bi bi-person-fill-add"></i>
                    Agregar
                </button>
            </div>
            <!--TITLE SECTION-->
            <!--DATA-->
            <br>
            <div class="row p-3" style="text-align: center;">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Ap Paterno</th>
                        <th scope="col">Ap Materno</th>
                        <th scope="col">Nombre de usuario</th>
                        <th scope="col">Correo electrónico</th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Fecha de nacimiento</th>
                        <th scope="col">Recibir oferta</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($fila = mysqli_fetch_array($res)){

                           
                        ?>
                      <tr>
                        <td scope="row" style="text-align: center;">
                            <?php echo $fila['idUser'] ?> 
                        </td>
                        <td> 
                            <?php echo $fila['name'] ?>
                        </td>
                        <td>
                        <?php echo $fila['ap'] ?>
                        </td>
                        <td>
                        <?php echo $fila['am'] ?>
                        </td>
                        <td>
                        <?php echo $fila['username'] ?>
                        </td>
                        <td>
                        <?php echo $fila['email'] ?>
                        </td>
                        <td>1234</td>
                        <td>
                        <?php echo $fila['birthDate'] ?>
                        </td>
                        <td>
                        <?php echo $fila['recieveOffers'] ?>
                        </td>
                        <td>
                            <button data-id="<?php echo $fila['idUser']?>" id="eliminar" class="btn btn-sm mx-1 btnEliminar">
                                <i data-id="<?php echo $fila['idUser']?>"  class="bi bi-trash3-fill"></i>
                              </button>

                            <button id="editar" class="btn btn-sm mx-1 btnEditar" data-bs-toggle="modal" data-bs-target="#editarUsuario"
                            data-email="<?php echo $fila['email']?>"
                            data-id="<?php echo $fila['idUser']?>"
                            data-name="<?php echo $fila['name']?>"
                            data-ap="<?php echo $fila['ap']?>"
                            data-am="<?php echo $fila['am']?>"
                            data-username="<?php echo $fila['username']?>"
                            data-birthDate="<?php echo $fila['birthDate']?>"
                            data-offer="<?php echo $fila['recieveOffers']?>"  >
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                        </td>
                      </tr>
                      <?php  } ?>
                    </tbody>
                  </table> 
            </div>
            <!--END DATA-->

        </section>
    </main>
    <!--END MAIN CONTENT-->

     <!-- Modal Agregar Usuario -->
     <div class="modal fade" id="agregarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Usuario</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../php/addUser.php" method="post" class="needs-validation" novalidate id="formAgregarUsuario" >
                <div class="modal-body">
                    <div class="row mb-2 p-2">
                        <div class="col-4">
                            <label for="">Nombre</label>
                            <input name="txtName"  required type="text" class="form-control" placeholder="Inserta el nombre">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Nombre incorrecto</div>
                        </div>
                        <div class="col-4">
                            <label for="">Apellido Paterno</label>
                            <input name="txtAp"  required type="text" class="form-control" placeholder="Inserta el apellido paterno">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Apellido paterno incorrecto</div>
                        </div>
                        <div class="col-4">
                            <label for="">Apellido Materno</label>
                            <input name="txtAm"  required type="text" class="form-control" placeholder="Inserta el apellido materno">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Apellido materno incorrecto</div>
                        </div>
                    </div>
                    <div class="row mb-2 p-2">
                        <div class="col-12">
                            <label for="">Nombre de usuario</label>
                            <input name="txtUsername" required type="text" class="form-control" placeholder="Inserta el nombre">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Nombre de usuario incorrecto</div>
                        </div>
                    </div>
                    <div class="row mb-2 p-2">
                        <div class="col-6">
                            <label for="">Correo Electrónico</label>
                            <input name="txtEmail" required min="18" type="email" class="form-control" placeholder="Inserta el correo electrónico">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Correo electrónico incorrecto</div>
                        </div>
                        <div class="col-6">
                            <label for="">Contraseña</label>
                            <input name="txtPassword" required type="password" class="form-control" placeholder="Inserta la contraseña">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Contraseña incorrecta</div>
                        </div>
                    </div>
                    <div class="row mb-2 p-2">
                        <div class="col-12">
                            <label for="">Fecha de Nacimiento</label>
                            <input name="txtBirthdate" required type="date" class="form-control">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Fecha de nacimiento incorrecta</div>
                        </div>
                    </div>
                    <div class="row mb-2 p-2">
                        <div class="col-12">
                            <label for="">
                                <input name="txtOffer" type="checkbox" value="sí">
                                Recibir ofertas especiales y consejos de aprendizaje
                            </label>
                        </div>
                    </div>
                    <div class="alert alert-danger mt-4 d-none" id="alerta" role="alert">
                        Favor de llenar todos los campos
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" id="btnGuardarAgregar">Guardar</button>
                </div>
            </form>
        </div>
        </div>
    </div>


   <!-- Modal Editar Usuario -->
   <div class="modal fade" id="editarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Usuario</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="../php/updateUser.php" class="needs-validation" novalidate id="form">
                <div class="modal-body">
                <input type="hidden" name="idUser" id="txtIdEdit">
                    <div class="row mb-2 p-2">
                        <div class="col-4">
                            <label for="">Nombre</label>
                            <input id="txtNameEdit" name="txtName" required type="text" class="form-control" placeholder="Inserta el nombre">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Nombre incorrecto</div>
                        </div>
                        <div class="col-4">
                            <label for="">Apellido Paterno</label>
                            <input id="txtApEdit" name="txtAp"  required type="text" class="form-control" placeholder="Inserta el apellido paterno">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Apellido paterno incorrecto</div>
                        </div>
                        <div class="col-4">
                            <label for="">Apellido Materno</label>
                            <input id="txtAmEdit" name="txtAm"  required type="text" class="form-control" placeholder="Inserta el apellido materno">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Apellido materno incorrecto</div>
                        </div>
                        
                    </div>
                    <div class="row mb-2 p-2">
                        <div class="col-12">
                            <label for="">Nombre de usuario</label>
                            <input id="txtUsernameEdit" name="txtUsername" required type="text" class="form-control" placeholder="Inserta el nombre">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Nombre de usuario incorrecto</div>
                        </div>
                    </div>
                    <div class="row mb-2 p-2">
                        <div class="col-4">
                            <label for="">Correo Electrónico</label>
                            <input id="txtEmailEdit" name="txtEmail" required min="18" type="email" class="form-control" placeholder="Inserta el correo electrónico">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Correo electrónico incorrecto</div>
                        </div>
                    <div class="row mb-2 p-2">
                        <div class="col-12">
                            <label for="">Fecha de nacimiento</label>
                            <input id="txtBirthdateEdit" name="txtBirthdate" required type="date" class="form-control">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Fecha de nacimiento incorrecta</div>
                        </div>
                    </div>
                    <div class="row mb-2 p-2">
                        <div class="col-12">
                            <label for="">
                                <input id="txtOfferEdit" name="txtOffer" type="checkbox" value="sí">
                                Recibir ofertas especiales y consejos de aprendizaje
                            </label>
                        </div>
                    </div>
                    <div class="alert alert-danger mt-4 d-none" id="divAlerta" role="alert">
                        Favor de llenar todos los campos
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary " id="btnGuardar1" >Guardar</button>
                </div>
            </form>
        </div>
        </div>
    </div>


   
   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   <!-- SweetAlert2 JS -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
   
   <script src="../js/user.js"></script>

<?php
    if(isset($_GET['status'])){
        $message="";
        if($_GET['status']==1){
            //Insertado correcta
            $message="Registro insertado correctamente";
        }else if($_GET['status']==2){
            //Actualizado correcta
            $message = "Registro actualizado correctamente";
        }else if($_GET['status']==3){
            //Eliminado correcta
            $message = "Registro eliminado correctamente";
        }
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: "<?php echo $message ?>",
                    confirmButtonText: 'Aceptar'
                }).then(function() {
                    window.location.href = '../admin/users.php'; 
                });
            });
        </script>
        <?php
    }
?>
</body>
</html>