<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['usuario'])) {
    header("Location: html/leer_productos.html"); // Redirigir al usuario a la página principal del sistema
    exit();
} else {
    header("Location: html/login.html"); // Redirigir al usuario a la página de inicio de sesión
    exit();
}
?>
