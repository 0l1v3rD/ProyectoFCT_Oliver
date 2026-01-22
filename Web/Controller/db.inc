<?php
    $host = "localhost";  // Servidor
    $nombreBD = "C-Weight";  // Base de datos
    $usuario = "root";  // Usuario
    $password = ""; // Contraseña

    $conn = new mysqli($host, $usuario, $password, $nombreBD);
    if($conn->connect_error){
        die("Conexión fallida - ERROR de conexión: " . $conn -> connect_error);
    }
?>