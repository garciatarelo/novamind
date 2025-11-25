<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="NovaMind te abre las puertas al mundo digital. Aprende sobre tecnología y computadoras de una manera fácil y divertida para todas las edades.">
    <title>Registro</title>
    <link rel="stylesheet" href="./css/signup.css">
 

    <link rel="stylesheet" href="./css/mediaquery-signup.css">

    <link rel="icon" href="./img/LOGO NOVAMIND-ROBOT.ico">

    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"></noscript>

    <body>
    <div class="signup-container">
        <div class="welcome-section">
            <h1><span>NOVI</span> TE DA LA BIENVENIDA</h1>
            <img  src="./img/register.webp" alt="">
        </div>
        <div class="form-section">
            <a href="./index.php"><img src="./img/mejorada/Logo-Nombre_1.webp" alt="logo"></a>
            <h2>Crea una <span>Cuenta</span></h2>
            <form id="form" method="post" action="./php/addUser-signup.php" class="needs-validation">
                <div class="input-group">
                    <input  name="txtName"  type="text" placeholder="Nombre" required>
                    <input name="txtUsername" type="text" placeholder="Nombre de usuario" required>
                </div>
                <div class="input-group">
                    <input name="txtAp" type="text" placeholder="Apellido paterno" required>
                    <input name="txtAm" type="text" placeholder="Apellido materno" required>
                </div>
                <input name="txtEmail" type="email" placeholder="Correo electrónico" required>
                
                <div class="password-group">
                    <input name="txtPassword" type="password" id="password" placeholder="Contraseña" required>
                    <span id="togglePassword" class="eye-icon"><i class="bi bi-eye"></i></span>
                </div>
                <div class="password-group">
                    <input name="txtConfirmPass" type="password" id="confirmPassword" placeholder="Confirmar contraseña" required>
                    <span id="toggleConfirmPassword" class="eye-icon"><i class="bi bi-eye"></i></span>
                </div>

                <label for="birthday">Fecha de nacimiento</label>
                <div class="birthday">
                    <!--<label for="day" id="day"></label>-->
                    <select  name="day" id="day"></select>
                    <!--<label for="month" id="month"></label>-->
                    <select name="month"  id="month"></select>
                    <!--<label for="year" id="year"></label>-->
                    <select name="year" id="year"></select>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="offers"  name="txtOffer">
                    <label for="offers">Quiero recibir ofertas especiales y consejos de aprendizaje</label>
                </div>

                <button type="submit" class="signup-btn">Registrarse</button>

                <div id="justify">
                    <p>Al registrarte en NovaMind, aceptas nuestros <a href="#">Términos</a> y <a href="#">Políticas de Privacidad</a>.</p>
                </div>

                <div id="center">
                    <p>¿Ya tienes una cuenta? <a href="./login.php">Iniciar Sesión</a></p>
                </div>
            </form>
        </div>
    </div>


       <!-- SweetAlert2 JS -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
    <script src="./js/scripts.js" defer></script>

    <script>
        const form = document.getElementById('form');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');

        // Validar que las contraseñas coincidan
        form.addEventListener('submit', (e) => {
            if (password.value !== confirmPassword.value) {
                e.preventDefault(); // Evita que el formulario se envíe
                
                // Muestra el error con SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Las contraseñas no coinciden. Por favor, verifica e inténtalo de nuevo.',
                    confirmButtonText: 'Aceptar'
                });
            } 
        });
    </script>
    
    <?php
    if(isset($_GET['status'])){
        $message="";
        if($_GET['status']==1){
            //Insertado correcta
            $message="Registro insertado correctamente";
        }
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: "<?php echo $message ?>",
                    confirmButtonText: 'Aceptar'
                }).then(function() {
                    window.location.href = '../index.php'; // Opcional: Redirigir después de cerrar el modal
                });
            });
        </script>
        <?php
    }
?>


   
</body>
</html>