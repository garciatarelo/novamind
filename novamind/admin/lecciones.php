<?php session_start();
    if(!isset($_SESSION['user_data'])){
        header("Location: ../login.php");
    }
    $user_data = $_SESSION['user_data'];
    $idcurso = $_GET['id'];

    include "../php/conexion.php";
    $sql = "select lessons.* from lessons inner join lessontypes
            on lessonTypes.idLessonType = lessons.idLessonType inner join courses
            on courses.idCourse = lessons.idCourse where  lessons.idCourse=".$idcurso;
    $res= $conexion->query("$sql") or die ($conexion->error);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecciones</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">

    <!--ICONO-->
    <link rel="icon" href="../img/LOGO NOVAMIND-ROBOT.ico">

    <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
   <!-- SweetAlert2 CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="../css/admin/lecciones.css">

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
            <div class="d-flex justify-content-between align-items-center">
            <!-- Título a la izquierda -->
              <h4>Lecciones</h4>
            <!-- Botones a la derecha -->
              <div class="d-flex gap-2">
                  <a id="agregarleccion" class="btn " href="../lecciones/lecciones-add.php">
                      <i class="bi bi-plus"></i>
                      Agregar
                  </a>
                  <style>
                    #agregarleccion{
                      background-color: black;
                      color: white;
                    }
                    #agregarleccion:hover{
                      background-color: #2b2b2a;
                      color: white;
                    }
                  </style>
                  <a id="volver" class="btn " href="../admin/cursos.php">
                      <i class="bi bi-arrow-left"></i>
                      Volver
                  </a>
              </div>
            </div>
            <!--TITLE SECTION-->
            <!--DATA-->
            <div class="row px-4 mt-4">
                <!-- Tarjeta 1 -->
                <?php 
                      while($fila = mysqli_fetch_array($res)){
                ?>
                <div class="col-3 mb-4">
                    <div class="card" style="height:450px">
                        <img src="../img/admin/<?php echo $fila['image'] ?>" class="card-img-top" alt="..." style="height: 200px;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $fila['name'] ?></h5>
                            <p class="card-text"><?php echo $fila['description'] ?></p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <!-- Botón Ver alineado a la izquierda -->
                                <a id="boton" href="#" class="btn btn-sm mx-1">Ver</a>
                                <!-- Botones Eliminar y Editar alineados a la derecha -->
                                <div>
                                    <button id="eliminar" class="btn btn-sm mx-1 btnEliminar">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                    <button id="editar" class="btn btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#editarLeccion">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  } ?>
            </div>
            <!--END DATA-->

        </section>
    </main>
    <!--END MAIN CONTENT-->

    <!-- Modal -->
<div class="modal fade" id="editarLeccion" tabindex="-1" aria-labelledby="editarLeccionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editarLeccionLabel">Editar Lección</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Formulario -->
          <form action="" class="needs-validation" novalidate id="form">
            <div class="row p-4">
              <div class="col-4">
                <label for="">Nombre</label>
                <input name="txtName" required min="18" type="text" class="form-control" placeholder="Inserta el nombre de la lección">
                <div class="valid-feedback">Correcto</div>
                <div class="invalid-feedback">Nombre incorrecto</div>
              </div>
              <div class="col-4">
                <label for="">Descripción</label>
                <input name="txtDescription" required type="text" class="form-control" placeholder="Inserta la descripción">
                <div class="valid-feedback">Correcto</div>
                <div class="invalid-feedback">Descripción incorrecta</div>
              </div>
              <div class="col-4">
                <label for="">Imagen</label>
                <input name="txtFile" required type="file" class="form-control">
                <div class="valid-feedback">Correcto</div>
                <div class="invalid-feedback">Selecciona una imagen</div>
              </div>
            </div>
            <div class="row p-4">
              <div class="col-12">
                <label for="">Tipo de lección</label>
                <select name="txtLessonType" required class="form-control">
                  <option value="" disabled selected>Selecciona el tipo de lección</option>
                  <option value="1">Multimedia</option>
                  <option value="2">Juego</option>
                  <option value="3">Presentación</option>
                  <option value="4">Texto</option>
                </select>
                <div class="valid-feedback">Correcto</div>
                <div class="invalid-feedback">Por favor seleccione el tipo de lección</div>
              </div>
            </div>
            <div class="row p-4">
              <div class="col-12">
                <label for="">Nombre del curso</label>
                <select name="txtCourse" required class="form-control">
                  <option value="" disabled selected>Selecciona el curso</option>
                  <option value="1">Introducción a la computadora</option>
                  <option value="2">Programación básica</option>
                  <option value="3">Redes de computadoras</option>
                  <option value="4">Introducción a la IA</option>
                  <option value="5">Seguridad en Internet</option>
                </select>
                <div class="valid-feedback">Correcto</div>
                <div class="invalid-feedback">Por favor seleccione el curso</div>
              </div>
            </div>
            <div class="alert alert-danger mt-4 d-none" id="divAlerta" role="alert">
              Favor de llenar todos los campos
            </div>
            <div class="d-flex justify-content-end p-4">
              <button type="submit" class="btn" id="btnGuardar">
                <i class="bi bi-floppy-fill"></i>
                Guardar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

     <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   <!-- SweetAlert2 JS -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>

   <script src="../js/leccion.js"></script>
</body>
</html>