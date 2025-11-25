<?php session_start();
    if(!isset($_SESSION['user_data'])){
        header("Location: ../login.php");
    }
    $user_data = $_SESSION['user_data'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar lección</title>
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
                <h4>Agregar Lección</h4>
                <a id="volver" class="btn" href="../admin/cursos.php">
                    <i class="bi bi-arrow-left"></i>
                    Volver
                </a>
            </div>
            <!--TITLE SECTION-->
            <!--DATA-->
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
                        <input name="txtFile" required type="file" class="form-control" >
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
                        <select name="txtNCourse" required class="form-control">
                            <option value="" disabled selected>Selecciona el curso</option>
                            <option value="1">Introduccion a la computadora</option>
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
                    <button type="submit" class="btn " id="btnGuardar">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/add-leccion.js"></script>
</body>
</html>