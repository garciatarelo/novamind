<?php
    include "./conexion.php";

    // Verificar la existencia de datos en $_POST
    $id = isset($_POST['idUser']) ? $_POST['idUser'] : '';
    $name = isset($_POST['txtName']) ? $_POST['txtName'] : '';
    $ap = isset($_POST['txtAp']) ? $_POST['txtAp'] : '';
    $am = isset($_POST['txtAm']) ? $_POST['txtAm'] : '';
    $username = isset($_POST['txtUsername']) ? $_POST['txtUsername'] : '';
    $email = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : '';
    $birthdate = isset($_POST['txtBirthdate']) ? $_POST['txtBirthdate'] : '';
    $offer = isset($_POST['txtOffer']) && $_POST['txtOffer'] === 'sí' ? 1 : 0; // Si está marcado, asigna 1, sino 0
    
    // Construir la consulta SQL
    $consulta = "update users set 
        name='$name',
        ap='$ap',
        am='$am',
        username='$username',
        email='$email',
        birthDate='$birthdate',
        recieveOffers=$offer
    where idUser=$id";
    
    echo $consulta;
    
    $conexion->query($consulta) or die($conexion->error);
    header("Location: ../admin/users.php?status=2");
?>