<?php 
session_start();
include "./conexion.php";

// Cachar datos
$email = $_POST['txtEmail'];
$password = $_POST['txtPassword'];

// Consulta SQL para verificar usuario
$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$res = $conexion->query($sql) or die($conexion->error);

if(mysqli_num_rows($res) > 0){
    echo "Login correcto <br>";
    $fila = mysqli_fetch_row($res); // trae la primera fila
    $name = $fila[1];
    $ap = $fila[2];
    $am = $fila[3];
    $id = $fila[0];
    $email = $fila[5];
    $image = $fila[8];
    echo "Hola $name, tu id es $id";
    
    // Guardar datos de usuario en sesión
    $_SESSION['user_data'] = [
        'id' => $id, 
        'name' => $name,
        'ap' => $ap,
        'am' => $am,
        'email' => $email,
        'img' => $image,
    ];

    // Verificar si es el administrador
    if ($email === 'admin123@gmail.com' && $password === '1234') {
        header('Location: ../admin/admin.php'); // Redirigir al panel de administración
    } else {
        header('Location: ../index.php'); // Redirigir a la página principal
    }

} else {
    echo "Datos no válidos";
    header("Location: ../login.php?error=1"); // Redirigir a la página de login con error
}
?>
