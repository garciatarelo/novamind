<?php
    include "./conexion.php";

    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    

    <?php

    $name = $_POST['txtName'];
    $ap = $_POST['txtAp'];
    $am = $_POST['txtAm'];
    $username = $_POST['txtUsername'];
    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword'];
    $birthDate = $_POST['txtBirthdate'];
    $offer = isset($_POST['txtOffer']) ? 1 : 0;  // Asegura un valor booleano adecuado
    
    // Fecha de registro actual
    $registrationDate = date("Y-m-d");

    // Preparar la llamada al procedimiento almacenado
    $consulta = $conexion->prepare("CALL AddUser(?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Enlazar los parámetros
    $consulta->bind_param("sssssssss", $name, $ap, $am, $username, $email, $password, $birthDate, $offer, $registrationDate);

    // Ejecutar la consulta
    if ($consulta->execute()) {
        // Redirigir a la página de usuarios con un parámetro de éxito
        header("Location: ../admin/users.php?status=1");
        exit(); // Asegura que el script termine después de la redirección
    } 

    // Cerrar la consulta y la conexión
    $consulta->close();
    $conexion->close();
?>


<script src="../js/addUser-signup.js"></script>