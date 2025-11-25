<?php
include "./conexion.php";

// Capturar datos del formulario
$idCourse = isset($_POST['idCourse']) ? $_POST['idCourse'] : '';
$courseName = isset($_POST['txtName']) ? $_POST['txtName'] : '';
$description = isset($_POST['txtDescription']) ? $_POST['txtDescription'] : '';
$level = isset($_POST['txtLevel']) ? $_POST['txtLevel'] : null;
$status = isset($_POST['txtStatus']) ? $_POST['txtStatus'] : '';
$duration = isset($_POST['txtDuration']) ? $_POST['txtDuration'] : null;
$categoryName = isset($_POST['txtCategory']) ? $_POST['txtCategory'] : null;
$instructorName = isset($_POST['txtInstructor']) ? $_POST['txtInstructor'] : null;
$startDate = isset($_POST['txtStartDate']) ? $_POST['txtStartDate'] : '';
$cost = isset($_POST['txtCost']) ? $_POST['txtCost'] : null;


// Construir consulta
$consulta = "
    UPDATE courses 
    SET 
        name = '$courseName', 
        description = '$description', 
        level = $level, 
        status = '$status', 
        durationHours = $duration, 
        idCategory = (SELECT idCategory FROM categories WHERE idCategory = $categoryName), 
        idInstructor = (SELECT idInstructor FROM instructors WHERE idInstructor = $instructorName), 
        startDate = '$startDate', 
        cost = $cost 
    WHERE idCourse = $idCourse
";
echo $consulta;

// Ejecutar consulta
if ($conexion->query($consulta) === TRUE) {
    header("Location: ../admin/cursos.php?status=2");
} else {
    die("Error: " . $conexion->error);
}
?>
