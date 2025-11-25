<?php
include "./conexion.php";

$name = $_POST['txtName'];
$ap = $_POST['txtAp'];
$am = $_POST['txtAm'];
$username = $_POST['txtUsername'];
$email = $_POST['txtEmail'];
$password = $_POST['txtPassword'];
// $password = password_hash($_POST['txtPassword'], PASSWORD_BCRYPT);

// Concatenar fecha de nacimiento
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];

if (!checkdate($month, $day, $year)) {
    die("Fecha de nacimiento no válida");
}

$birthDate = "$year-$month-$day"; // Formato YYYY-MM-DD

$offer = isset($_POST['txtOffer']) ? 1 : 0; // Asegura un valor booleano adecuado

// Fecha de registro actual
$registrationDate = date("Y-m-d");

// Crear la consulta de inserción directa
$query = "insert into users (name, ap, am, username, email, password, birthDate, recieveOffers, registrationDate) 
          values ('$name', '$ap', '$am', '$username', '$email', '$password', '$birthDate', '$offer', '$registrationDate')";

// Ejecutar la consulta
if ($conexion->query($query) === TRUE) {
    // Redirigir a la página principal con un parámetro de éxito
    header("Location: ../index.php?status=1");
    exit();
} else {
    echo "Error: " . $query . "<br>" . $conexion->error;
}

// Cerrar la conexión
$conexion->close();
?>
