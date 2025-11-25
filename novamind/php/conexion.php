<?php
    $server = "localhost";
    $port = "3306";
    $user = "root";
    $password = "";
    $db = "novamind";

    $conexion = new mysqli($server, $user, $password, $db);
    if($conexion -> connect_error){
        die("No se pudo conectar a MySQL PRENDE EL MYSQL");
    }

?>