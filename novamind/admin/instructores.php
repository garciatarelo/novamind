<?php session_start();
    if(!isset($_SESSION['user_data'])){
        header("Location: ../login.php");
    }
    $user_data = $_SESSION['user_data'];
?>

<?php
    include "../php/conexion.php";
    $sql = "select instructors.*, users.* from instructors inner join users on 
    instructors.idUser = users.idUser";
    $res= $conexion->query("$sql") or die ($conexion->error);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructores</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">

    <!--ICONO-->
    <link rel="icon" href="../img/LOGO NOVAMIND-ROBOT.ico">

    <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
   <!-- SweetAlert2 CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css">

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
                <h4>Instructores</h4>
                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="bi bi-person-fill-add"></i>
                    Agregar
                </button>
            </div>
            <!--TITLE SECTION-->
            <!--DATA-->
            <div class="row p-3" style="text-align: center;">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Ap Paterno</th>
                        <th scope="col">Ap Materno</th>
                        <th scope="col">Correo electrónico</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Especialidad</th>
                        <th scope="col">Estatus</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                            while($fila = mysqli_fetch_array($res)){

                        ?>
                      <tr>
                      <td scope="row" style="text-align: center;">
                      <?php echo $fila['idInstructor'] ?> </td>
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
                        <?php echo $fila['email'] ?>
                        </td>
                        <td>
                        <?php echo $fila['phone'] ?>
                        </td>
                        <td>
                        <?php echo $fila['speciality'] ?>
                        </td>
                        <td>
                        <?php echo $fila['status'] ?>
                        </td>
                        <td>
                            <button id="eliminar" type="button" class="btn btn-sm mx-1 btnEliminarInstructor">
                                <i class="bi bi-trash3-fill"></i>
                            </button>   
                            <button id="editar" class="btn btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#editarInstructor">
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

     <!-- Modal Editar -->
     <div class="modal fade modal-xl" id="editarInstructor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Instructor</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" class="needs-validation" novalidate id="form">
                <div class="modal-body">
                    <div class="row mb-2 p-2">
                        <div class="col-4">
                            <label for="">Nombre</label>
                            <input name="txtName" required type="text" class="form-control" placeholder="Inserta el nombre">
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
                        <div class="col-6">
                            <label for="">Correo Electrónico</label>
                            <input name="txtEmail" required type="email" class="form-control" placeholder="Inserta el correo electrónico">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Correo electrónico incorrecto</div>
                        </div>
                        <div class="col-6">
                            <label for="">Teléfono</label>
                            <input name="txtPhone" required min="18" type="email" class="form-control" placeholder="Inserta el teléfono">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Teléfono incorrecto</div>
                        </div>
                    </div>
                    <div class="row mb-2 p-2">
                        <div class="col-12">
                            <label for="">Especialidad</label>
                            <br>
                            <fieldset name="txtSpeciality" id="especialidad1">
                                <input type="checkbox" name="especialidades[]" value="1"> Tecnología &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="especialidades[]" value="2"> Productividad digital &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="especialidades[]" value="3"> Ciberseguridad &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="especialidades[]" value="4"> Redes &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="especialidades[]" value="5"> Programación &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="especialidades[]" value="6"> Inteligencia artificial &nbsp;&nbsp;&nbsp;
                            </fieldset>
                            <div class="invalid-feedback">Por favor seleccione una o más especialidades</div>
                            <div class="valid-feedback">Correcto</div>
                        </div>
                    </div>
                    <div class="row mb-2 p-2">
                        <div class="col-12">
                            <label for="">Estatus</label>
                            <select name="txtStatus" required class="form-control">
                                <option value="" disabled selected>Selecciona el estatus</option>
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Por favor selecciona el estatus</div>
                        </div>
                    </div>
                    <div class="row mb-2 p-2">
                        <div class="col-12">
                            <label for="">Categoría del curso</label>
                            <br>
                            <fieldset name="txtCategory" id="categoria1">
                                <input type="checkbox" name="categorias[]" value="1"> Tecnología &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="categorias[]" value="2"> Productividad digital &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="categorias[]" value="3"> Ciberseguridad &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="categorias[]" value="4"> Redes &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="categorias[]" value="5"> Programación &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="categorias[]" value="6"> Inteligencia artificial &nbsp;&nbsp;&nbsp;
                            </fieldset>
                            <div class="invalid-feedback">Por favor seleccione una o más categorías</div>
                            <div class="valid-feedback">Correcto</div>
                        </div>
                    </div>
                    <div class="alert alert-danger mt-4 d-none" id="divAlerta" role="alert">
                        Favor de llenar todos los campos
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                </div>
            </form>
        </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade modal-xl" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Instructor</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" class="needs-validation" novalidate id="formInstructor">
                <div class="modal-body">
                    <div class="row mb-2 p-2">
                        <div class="col-4">
                            <label for="">Nombre</label>
                            <input name="txtName" required type="text" class="form-control" placeholder="Inserta el nombre">
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
                        <div class="col-6">
                            <label for="">Correo Electrónico</label>
                            <input name="txtEmail" required type="email" class="form-control" placeholder="Inserta el correo electrónico">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Correo electrónico incorrecto</div>
                        </div>
                        <div class="col-6">
                            <label for="">Teléfono</label>
                            <input name="txtPhone" required min="18" type="email" class="form-control" placeholder="Inserta el teléfono">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Teléfono incorrecto</div>
                        </div>
                    </div>
                    <div class="row mb-2 p-2">
                        <div class="col-12">
                            <label for="">Especialidad</label>
                            <br>
                            <fieldset name="txtSpeciality" id="especialidad2">
                                <input type="checkbox" name="especialidades[]" value="1"> Tecnología &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="especialidades[]" value="2"> Productividad digital &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="especialidades[]" value="3"> Ciberseguridad &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="especialidades[]" value="4"> Redes &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="especialidades[]" value="5"> Programación &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="especialidades[]" value="6"> Inteligencia artificial &nbsp;&nbsp;&nbsp;
                            </fieldset>
                            <div class="invalid-feedback">Por favor seleccione una o más especialidades</div>
                            <div class="valid-feedback">Correcto</div>
                        </div>
                    </div>
                    <div class="row mb-2 p-2">
                        <div class="col-12">
                            <label for="">Estatus</label>
                            <select name="txtStatus" required class="form-control">
                                <option value="" disabled selected>Selecciona el estatus</option>
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Por favor selecciona el estatus</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="">Categoría del curso</label>
                        <br>
                        <fieldset name="txtCategory" id="categoria2">
                            <input type="checkbox" name="categorias[]" value="1"> Tecnología &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="categorias[]" value="2"> Productividad digital &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="categorias[]" value="3"> Ciberseguridad &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="categorias[]" value="4"> Redes &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="categorias[]" value="5"> Programación &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="categorias[]" value="6"> Inteligencia artificial &nbsp;&nbsp;&nbsp;
                        </fieldset>
                        <div class="invalid-feedback d-none">Por favor seleccione una o más categorías</div>
                        <div class="valid-feedback d-none">Correcto</div>
                    </div>
                    <div class="alert alert-danger mt-4 d-none" id="alertaInstructor" role="alert">
                        Favor de llenar todos los campos
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" id="btnGuardarInstructor">Guardar</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   <!-- SweetAlert2 JS -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
    <script src="../js/instructor.js"></script>
</body>
</html>