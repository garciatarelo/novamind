<?php session_start();
    if(!isset($_SESSION['user_data'])){
        header("Location: ../login.php");
    }
    $user_data = $_SESSION['user_data'];
?>

<?php
    include "../php/conexion.php";
    $sql = "select courses.*, categories.name as categoryName, concat(users.name, ' ', users.ap, ' ', users.am) 
            as instrcutorName from courses inner join instructors on courses.idInstructor = instructors.idInstructor
            inner join users on instructors.idUser = users.idUser inner join categories on 
            courses.idCategory = categories.idCategory";
    $res= $conexion->query("$sql") or die ($conexion->error);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar curso</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">

    <!--ICONO-->
    <link rel="icon" href="../img/LOGO NOVAMIND-ROBOT.ico">

    <link rel="stylesheet" href="../css/admin/curso-add.css">
    

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
                <h4>Agregar Curso</h4>
                <a id="volver" class="btn" href="../admin/cursos.php">
                    <i class="bi bi-arrow-left"></i>
                    Volver
                </a>
            </div>
            <!--TITLE SECTION-->
            <!--DATA-->
            <form action="../php/addCourse.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate id="formAgregarCurso">
                <div class="row p-4">
                    <div class="col-4">
                        <label for="">Nombre</label>
                        <input name="txtName" required min="18" type="text" class="form-control" placeholder="Inserta el nombre del curso">
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
                        <input accept="image/*" name="txtFile" required type="file" class="form-control" >
                        <div class="valid-feedback">Correcto</div>
                        <div class="invalid-feedback">Por favor seleccione una imagen</div>
                       </div>
                </div>
                <div class="row p-4">
                    <div class="col-6">
                        <label for="">Nivel</label>
                        <select name="txtLevel" required class="form-control">
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
                        <select name="txtStatus" required class="form-control" >
                            <option value="" disabled selected>Selecciona el estado</option>
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                        <div class="valid-feedback">Correcto</div>
                        <div class="invalid-feedback">Por favor seleccione el estado</div>
                     </div>
                </div>
                <div class="row p-4">
                    <div class="col-6">
                        <label for="">Duración(horas)</label>
                        <input name="txtDuration" required type="number" class="form-control" placeholder="Inserta la duración del curso">
                        <div class="valid-feedback">Correcto</div>
                        <div class="invalid-feedback">Duración incorrecta</div>
                    </div>
                    <div class="col-6">
                        <label for="">Categoría</label>
                        <select name="txtCategory" required class="form-control">
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
                        <div class="invalid-feedback">Por favor seleccione la categoría</div>
                    </div>
                </div>
                <div class="row p-4">
                    <div class="col-12">
                        <label for=""> Nombre del instructor</label>
                        <select name="txtInstructor" required class="form-control">
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
                        <div class="invalid-feedback">Por favor selecciona un instructor</div>
                    </div>
                </div>
                <div class="row p-4">
                    <div class="col-6">
                     <label for="">Fecha de inicio</label>
                        <input name="txtStartDate" required type="date" class="form-control">
                        <div class="valid-feedback">Correcto</div>
                        <div class="invalid-feedback">Fecha incorrecta</div>
                    </div>
                    <div class="col-6">
                        <label for="">Costo</label>
                           <input name="txtCost" required type="number" class="form-control" placeholder="Inserta el costo del curso">
                           <div class="valid-feedback">Correcto</div>
                           <div class="invalid-feedback">Costo incorrecto</div>
                    </div>
                    <div class="alert alert-danger mt-4 d-none" id="divAlerta" role="alert">
                        Favor de llenar todos los campos
                    </div>
                    <div class="d-flex justify-content-end p-4">
                        <button type="submit" class="btn" id="guardarCurso">
                            <style>
                            #guardarCurso{
                            color: white;
                            background-color: black;
                            }
                            #guardarCurso:hover{
                                background-color: rgb(75, 75, 75);
                                color: white;
                            }
                            </style>
                            <i class="bi bi-floppy-fill"></i>
                            Guardar
                        </button>
                    </div>
            </form>
            <!--END DATA-->
        </section>
    </main>
    <!--END MAIN CONTENT-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
    <script src="../js/add-curso.js"></script>
   
</body>
</html>