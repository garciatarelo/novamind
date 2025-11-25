<?php
    include "./conexion.php";

    if($_GET['id']){
        $consulta = "delete from courses where idCourse=".$_GET['id'];
        $conexion->query($consulta) or die($conexion->error);
        echo "Registro eliminado correctamente";
        header("Location: ../admin/cursos.php?status=3");
    }
    //header("Location: ../admin/users.php");
?>