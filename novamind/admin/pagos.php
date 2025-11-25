<?php session_start();
    if(!isset($_SESSION['user_data'])){
        header("Location: ../login.php");
    }
    $user_data = $_SESSION['user_data'];
?>

<?php
    include "../php/conexion.php";
    $sql = "select payments.*, users.name as user_name, users.ap, users.am, courses.name from payments 
        inner join users on payments.idUser = users.idUser 
        inner join courses on courses.idCourse = payments.idCourse";
    $res= $conexion->query("$sql") or die ($conexion->error);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css">

    <!--ICONO-->
    <link rel="icon" href="../img/LOGO NOVAMIND-ROBOT.ico">

    <link rel="stylesheet" href="../css/admin/pagos.css">

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
                <h4>Pagos</h4>
                
            </div>
            <!--TITLE SECTION-->
            
            <!--DATA-->

            <!-- Filtros de búsqueda -->
            <br>
            <br> 
            <h4>Buscar pago</h4>
             
            <div class="row mb-4">
                <div class="col-5">
                    <label for="">Id del usuario</label>
                    <input id="inputPagoId" type="text" class="form-control" placeholder="Buscar por usuario">
                </div>
                <div class="col-5">
                    <label for="">Fecha del pago</label>
                    <input id="inputFechaPago" type="date" class="form-control">
                </div>
                <div class="col-2">
                    <button id="btnBuscarPago" style="margin-left: 60px;" class="btn btn-dark mt-4">
                        <i class="bi bi-search"></i>
                        Buscar
                    </button>
                </div>
            </div>
            <hr>
        <!-- Resumen de Pagos -->
         <h4>Resumen de los pagos</h4>
        <div class="row mb-4 text-center">
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Pagos Completados</h5>
                        <p id="card" class="card-text">$1,200.00</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Pagos Pendientes</h5>
                        <p id="card" class="card-text">$400.00</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Pagos Fallidos</h5>
                        <p id="card" class="card-text">$100.00</p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <!-- Tabla de Pagos -->
        <div class="d-flex justify-content-end m-4" >
            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#AgregarPago">
                <i class="bi bi-plus"></i>
                Agregar
            </button>
        </div>
        
            <div class="row p-3" style="text-align: center;">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Monto</th>
                        <th scope="col">Método de pago</th>
                        <th scope="col">Estado de pago</th>
                        <th scope="col">Fecha de pago</th>
                        <th scope="col">Nombre del usuario</th>
                        <th scope="col">Nombre del curso</th>
                        <th></th>
                        
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($fila = mysqli_fetch_array($res)){

                           
                        ?>
                      <tr>
                        <td scope="row" style="text-align: center;">
                            <?php echo $fila['idPayment'] ?> 
                        </td>
                        <td>
                        <?php echo $fila['amount'] ?> 
                        </td>
                        <td>
                        <?php echo $fila['paymentMethod'] ?> 
                        </td>
                        <td>
                        <?php echo $fila['status'] ?> 
                        </td>
                        <td>
                        <?php echo $fila['paymentDate'] ?> 
                        </td>
                        <td>
                        <?php echo $fila['user_name'] . ' ' . $fila['ap']. ' ' . $fila['am']; ?>
                        </td>
                        <td>
                        <?php echo $fila['name'] ?> 
                        </td>
                        <td>
                            <button id="eliminar" class="btn btn-sm mx-1 btnEliminarPago" >
                                <i class="bi bi-trash3-fill"></i>
                            </button>   
                            <button id="editar" class="btn btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#editarPago">
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

    <!-- Modal de Alerta -->
    <div class="modal fade" id="modalAlerta" tabindex="-1" aria-labelledby="modalAlertaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAlertaLabel">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    Por favor, completa todos los campos para buscar el pago.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Buscar Pago -->
    <div class="modal fade modal-lg" id="modalBuscarPago" tabindex="-1" aria-labelledby="modalBuscarPagoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalBuscarPagoLabel">Datos del pago</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <!-- Datos del Pago -->
                    <div class="row mb-2">
                        <div class="col-6">
                            <strong>ID de Pago:</strong>
                            <p id="paymentId">12345</p>
                        </div>
                        <div class="col-6">
                            <strong>Monto:</strong>
                            <p id="paymentAmount">$ 150.00</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <strong>Método de Pago:</strong>
                            <p id="paymentMethod">Tarjeta de Crédito</p>
                        </div>
                        <div class="col-6">
                            <strong>Fecha de Pago:</strong>
                            <p id="paymentDate">2024-11-12</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <strong>Estado del Pago:</strong>
                            <p id="paymentStatus" class="text-success">Completado</p>
                        </div>
                        <div class="col-6">
                            <strong>ID de Usuario:</strong>
                            <p id="userId">67890</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <strong>ID de Curso:</strong>
                            <p id="courseId">CS101</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
        <!-- Modal Agregar Pago -->
    <div class="modal fade modal-lg" id="AgregarPago" tabindex="-1" aria-labelledby="AgregarPagoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="AgregarPagoLabel">Agregar Pago</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" class="needs-validation" novalidate id="form">
                <div class="modal-body">
                    <div class="row mb-2 p-2">
                        <div class="col-6">
                            <label for="">Monto</label>
                            <input name="txtAmount" required type="number" class="form-control" placeholder="Inserta el monto a pagar">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Monto incorrecto</div>
                        </div>
                        <div class="col-6">
                            <label for="">Metodo de pago</label>
                            <select name="txtPaymentMethod" required class="form-control">
                                <option value="" disabled selected>Selecciona el método de pago</option>
                                <option value="1">Transferencia</option>
                                <option value="2">Tarjeta de crédito</option>
                                <option value="3">Tarjeta de débito</option>
                                <option value="3">PayPal</option>
                            </select>
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Por favor seleccione el método de pago</div>
                        </div>
                    </div>
                    <div class="row mb-2 p-2">
                        <div class="col-12">
                            <label for="">Estado de pago</label>
                            <select name="txtStatus" required class="form-control">
                                <option value="" disabled selected>Selecciona el estado</option>
                                <option value="1">Completado</option>
                                <option value="2">En progreso</option>
                                <option value="3">Cancelado</option>
                            </select>
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Por favor seleccione el estado de pago</div>
                        </div>
                    </div>
                    <div class="row mb-2 p-2">
                        <div class="col-12">
                            <label for="">Fecha de pago</label>
                            <input name="txtPaymentDate" required type="date" class="form-control">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Por favor seleccione la fecha de pago</div>
                        </div>
                    </div>
                    <div class="row mb-2 p-2">
                        <div class="col-12">
                            <label for="">Nombre del curso</label>
                            <input name="txtCourse" required type="text" class="form-control" placeholder="Inserta el id del curso">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Nombre del curso incorrecto</div>
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

    <!-- Modal Editar Pago -->
    <div class="modal fade modal-lg" id="editarPago" tabindex="-1" aria-labelledby="AgregarPagoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="AgregarPagoLabel">Agregar Pago</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" class="needs-validation" novalidate id="form">
                <div class="modal-body">
                    <div class="row mb-2 p-2">
                        <div class="col-6">
                            <label for="">Monto</label>
                            <input name="txtAmount" required type="number" class="form-control" placeholder="Inserta el monto a pagar">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Monto incorrecto</div>
                        </div>
                        <div class="col-6">
                            <label for="">Metodo de pago</label>
                            <select name="txtPaymentMethod" required class="form-control">
                                <option value="" disabled selected>Selecciona el método de pago</option>
                                <option value="1">Transferencia</option>
                                <option value="2">Tarjeta de crédito</option>
                                <option value="3">Tarjeta de débito</option>
                                <option value="3">PayPal</option>
                            </select>
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Por favor seleccione el método de pago</div>
                        </div>
                    </div>
                    <div class="row mb-2 p-2">
                        <div class="col-12">
                            <label for="">Estado de pago</label>
                            <select name="txtStatus"  required class="form-control">
                                <option value="" disabled selected>Selecciona el estado</option>
                                <option value="1">Completado</option>
                                <option value="2">En progreso</option>
                                <option value="3">Cancelado</option>
                            </select>
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Por favor seleccione el estado de pago</div>
                        </div>
                    </div>
                    <div class="row mb-2 p-2">
                        <div class="col-12">
                            <label for="">Fecha de pago</label>
                            <input name="txtPaymentDate" required type="date" class="form-control">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Por favor seleccione la fecha de pago</div>
                        </div>
                    </div>
                    <div class="row mb-2 p-2">
                        <div class="col-12">
                            <label for="">Nombre del curso</label>
                            <input name="txtCourse" required type="text" class="form-control" placeholder="Inserta el id del curso">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Id del curso incorrecto</div>
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



    

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>

    <script src="../js/pago.js"></script>
    <script src="../js/pago-eliminar.js"></script>
</body>
</html>