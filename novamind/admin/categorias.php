<?php session_start();
    if(!isset($_SESSION['user_data'])){
        header("Location: ../login.php");
    }
    $user_data = $_SESSION['user_data'];
?>

<?php
    include "../php/conexion.php";
    $sql = "select * from categories order by idCategory desc";
    $res= $conexion->query("$sql") or die ($conexion->error);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">

    <!--ICONO-->
    <link rel="icon" href="../img/LOGO NOVAMIND-ROBOT.ico">

    <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
   <!-- SweetAlert2 CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="../css/admin/categoria.css">

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
                <h4>Categorías</h4>
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
                        <th scope="col">Categoría</th>
                        <th></th>
                        
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                            while($fila = mysqli_fetch_array($res)){

                        ?>
                      <tr>
                      <td scope="row" style="text-align: center;">
                            <?php echo $fila['idCategory'] ?> </td>
                        <td> 
                        <td>
                            <?php echo $fila['name'] ?>
                        </td>
                        <td>
                            <button id="eliminar" class="btn btn-sm mx-1 btnEliminarCategoria" >
                                <i class="bi bi-trash3-fill"></i>
                            </button>   
                            <button id="editar" class="btn btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#editarCategoria" >
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
    <div class="modal fade modal-xl" id="editarCategoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Categoría</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" class="needs-validation" novalidate id="form">
                <div class="modal-body">
                    <div class="row mb-2 p-2">
                        <div class="col-4">
                            <label for="">Nombre de la categoría</label>
                            <input name="txtName" required type="text" class="form-control" placeholder="Inserta el nombre de la categoría">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Nombre incorrecto</div>
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
            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Categoría</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" class="needs-validation" novalidate id="formCategoria">
                <div class="modal-body">
                    <div class="row mb-2 p-2">
                        <div class="col-4">
                            <label for="">Nombre de la categoría</label>
                            <input name="txtName" required type="text" class="form-control" placeholder="Inserta el nombre de la categoría">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Nombre incorrecto</div>
                        </div>
                    </div>
                    <div class="alert alert-danger mt-4 d-none" id="alertaCategoria" role="alert">
                        Favor de llenar todos los campos
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" id="btnGuardarCategoria" >Guardar</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   <!-- SweetAlert2 JS -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
    <script src="../js/categoria.js"></script>

</body>
</html>