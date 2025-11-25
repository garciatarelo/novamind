<?php
    include "./conexion.php";
    $nombre = $_POST['txtName'];
    $descripcion = $_POST['txtDescription'];
    $imagen = $_FILES['txtFile']['name'];
    $nivel = $_POST['txtLevel']; /*es con select*/
    $estado = $_POST['txtStatus']; /*es con select*/
    $duracion = $_POST['txtDuration'];
    $categoria = $_POST['txtCategory'];
    $instructor = $_POST['txtInstructor'];
    $fechainicio = $_POST['txtStartDate'];
    $costo = $_POST['txtCost'];
   
    $temp = explode(".", $imagen); 
    $ext = end($temp);
    $destino="../img/cursos/";
    $file_name = date('Y_m_d_h_i_s')."_".rand(10000,99999).".".$ext;
    if(move_uploaded_file($_FILES['txtFile']['tmp_name'],$destino.$file_name)){
        echo "Archivo subido correctamente";
         // Ahora puedes usar directamente el idInstructor en la consulta de inserción
    $consulta = "insert into courses (name, description, level, status, durationHours,
    cost, startDate, img, idInstructor, idCategory) 
    values ('$nombre', '$descripcion', '$nivel', '$estado', '$duracion', '$costo',
     '$fechainicio', '$file_name', '$instructor', '$categoria')";

     //die($consulta);
     // Ejecutamos la consulta
     if ($conexion->query($consulta) === TRUE) {
        echo "Registro insertado correctamente";
        header("Location: ../admin/cursos.php?status=1");
    } else {
        echo "Error al insertar registro:";
        header("Location: ../admin/cursos.php?status=0");
    }
    }else{
        echo "Algo falló";
    }
    //echo $imagen;

   
    

?>