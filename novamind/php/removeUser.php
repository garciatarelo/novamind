<?php
    include "./conexion.php";

    if($_GET['id']){
        $consulta = "delete from users where idUser=".$_GET['id'];
        $conexion->query($consulta) or die($conexion->error);
        echo "Registro eliminado correctamente";
        header("Location: ../admin/users.php?status=3");
    }
?>