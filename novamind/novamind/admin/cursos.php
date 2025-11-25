<?php session_start();
    if(!isset($_SESSION['user_data'])){
        header("Location: ../login.php");
    }
    $user_data = $_SESSION['user_data'];
?>

<?php
    include "../php/conexion.php";
    $sql = "select courses.*, instructors.idInstructor , categories.idCategory from courses inner join instructors 
    on courses.idInstructor = instructors.idInstructor inner join categories 
    on courses.idCategory = categories.idCategory;";
    $res= $conexion->query("$sql") or die ($conexion->error);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">

    <!--ICONO-->
    <link rel="icon" href="../img/LOGO NOVAMIND-ROBOT.ico">

    <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
   <!-- SweetAlert2 CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="../css/admin/cursos.css">

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
                <h4>Cursos</h4>
                <a class="btn btn-dark" href="../cursos/cursos-add.php">
                    <i class="bi bi-plus"></i>
                    Agregar
                </a>
            </div>
            <!--TITLE SECTION-->
            <!--DATA-->
            <div class="row px-4 mt-4 d-flex flex-wrap">
              <!-- Tarjeta 1 -->
<?php 
while($fila = mysqli_fetch_array($res)){
?>
<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
    <div class="card h-100">
        <img src="../img/cursos/<?php echo $fila['img'] ?>" class="card-img-top" style="object-fit: cover; height: 200px;">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?php echo $fila['name'] ?></h5>
            <p class="card-text flex-grow-1"><?php echo $fila['description'] ?></p>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <a href="./lecciones.php?id=<?php echo $fila['idCourse'] ?>" class="btn btn-sm mx-1" id="boton">Ver</a>
                <div class="d-flex ms-auto">
                <button data-id="<?php echo $fila['idCourse']?>" id="eliminar" class="btn btn-sm mx-1 btnEliminarCurso">
        <i class="bi bi-trash3-fill"></i>
    </button>
    
    <button id="editar" class="btnEditar btn btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#editarCurso"
            data-id="<?php echo $fila['idCourse']; ?>"
            data-name="<?php echo $fila['name']; ?>"
            data-description="<?php echo $fila['description']; ?>"
            data-level="<?php echo $fila['level']; ?>"
            data-status="<?php echo $fila['status']; ?>"
            data-duration="<?php echo $fila['durationHours']; ?>"
            data-category="<?php echo $fila['idCategory']; ?>" 
            data-instructor="<?php echo $fila['idInstructor']; ?>"
            data-startDate="<?php echo $fila['startDate']; ?>"
            data-cost="<?php echo $fila['cost']; ?>">
        <i class="bi bi-pencil-fill"></i>
    </button>

                </div>
            </div>
        </div>
    </div>
</div>
<?php  } ?>


            <!--END DATA-->

        </section>
    </main>
    <!--END MAIN CONTENT-->

    <!-- Modal Editar -->
<div class="modal fade" id="editarCurso" tabindex="-1" aria-labelledby="editarCursoLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editarCursoLabel">Editar Curso</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Formulario -->
          <form action="../php/updateCourse.php" method="POST" class="needs-validation" novalidate id="form">
          <input type="hidden" name="idCourse" id="txtIdEdit">
            <div class="row p-4">
              <div class="col-6">
                <label for="">Nombre</label>
                <input id="txtNameEdit" name="txtName" required min="18" type="text" class="form-control" placeholder="Inserta el nombre del curso">
                <div class="valid-feedback">Correcto</div>
                <div class="invalid-feedback">Nombre incorrecto</div>
              </div>
              <div class="col-6">
                <label for="">Descripción</label>
                <input id="txtDescriptionEdit" name="txtDescription" required type="text" class="form-control" placeholder="Inserta la descripción">
                <div class="valid-feedback">Correcto</div>
                <div class="invalid-feedback">Descripción incorrecta</div>
              </div>
            </div>
            <div class="row p-4">
              <div class="col-6">
                <label for="">Nivel</label>
                <select id="txtLevelEdit" name="txtLevel" required class="form-control">
                  <option value="" disabled selected>Selecciona el nivel</option>
                  <option value="1">Basico</option>
                  <option value="2">Intermedio</option>
                  <option value="3">Avanzado</option>
                </select>
                <div class="valid-feedback">Correcto</div>
                <div class="invalid-feedback">Por favor seleccione el nivel</div>
              </div>
              <div class="col-6">
                <label for="">Estado</label>
                <select id="txtStatusEdit" name="txtStatus" required class="form-control">
                            <option value="" disabled selected>Selecciona el estado</option>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                </select>
                <div class="valid-feedback">Correcto</div>
                <div class="invalid-feedback">Por favor seleccione el estado</div>
              </div>
            </div>
            <div class="row p-4">
              <div class="col-6">
                <label for="">Duración(horas)</label>
                <input id="txtDurationEdit" name="txtDuration" required type="number" class="form-control" placeholder="Inserta la duración del curso">
                <div class="valid-feedback">Correcto</div>
                <div class="invalid-feedback">Duración incorrecta</div>
              </div>
              <div class="col-6">
                <label for="">Categoría</label>
                <select id="txtCategoryEdit" name="txtCategory" require class="form-control">
                <option value="" disabled selected>Selecciona la categoría</option>
                <?php
                                // Consulta para obtener las categorías
                                $query = "select idCategory, name from categories"; 
                                $result = $conexion->query($query);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                    // Aquí estamos asignando el idCategoria al value y el nombre a lo visible
                                        echo '<option value="' . $row['idCategory'] . '">' . $row['name'] . '</option>';
                                    }
                                }
                            ?>
                </select>
                <div class="valid-feedback">Correcto</div>
                <div class="invalid-feedback">Categoría incorrecta</div>
              </div>
            </div>
            <div class="row p-4">
              <div class="col-12">
                <label for="">Nombre del instructor</label>
                <select id="txtInstructorEdit" name="txtInstructor" required class="form-control" >
                <option value="" disabled selected>Selecciona el instructor</option>
                            <?php
                            // Consulta para obtener los instructores
                            $sql_instructors = "select instructors.idInstructor, concat(users.name, ' ', users.ap, ' ', 
                            users.am) as fullName from instructors inner join users on instructors.idUser = users.idUser";

                            $res_instructors = $conexion->query($sql_instructors);

                            // Llenar el select con los resultados
                             while ($row = $res_instructors->fetch_assoc()) {
                                // El value es el idInstructor, y el texto visible es el nombre completo del instructor
                                echo "<option value='{$row['idInstructor']}'>{$row['fullName']}</option>";
                            }
                            ?>
                </select>
                <div class="valid-feedback">Correcto</div>
                <div class="invalid-feedback">Nombre incorrecto</div>
              </div>
            </div>
            <div class="row p-4">
              <div class="col-6">
                <label for="">Fecha de inicio</label>
                <input id="txtStartDateEdit" name="txtStartDate" required type="date" class="form-control">
                <div class="valid-feedback">Correcto</div>
                <div class="invalid-feedback">Fecha incorrecta</div>
              </div>
              <div class="col-6">
                <label for="">Costo</label>
                <input id="txtCostEdit" name="txtCost" required type="number" class="form-control" placeholder="Inserta el costo del curso">
                <div class="valid-feedback">Correcto</div>
                <div class="invalid-feedback">Costo incorrecto</div>
              </div>
              <div class="alert alert-danger mt-4 d-none" id="divAlerta" role="alert">
                Favor de llenar todos los campos
              </div>
              <div class="d-flex justify-content-end p-4">
                <button type="submit" class="btn" id="btnGuardarCurso">
                  <i class="bi bi-floppy-fill"></i>
                  Guardar
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <script src="../js/curso.js"></script>

    <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   <!-- SweetAlert2 JS -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
   

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
                    window.location.href = '../admin/cursos.php'; // Opcional: Redirigir después de cerrar el modal
                });
            });
        </script>
        <?php
    }
?>

</body>
</html>