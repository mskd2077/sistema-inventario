<?php
session_start();

// Verificar si el usuario ya está autenticado, redirigir si es así
if(isset($_SESSION["usuario"])) {
    header("Location: ../html/leer_productos.html");
    exit();
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    // Verificar las credenciales (aquí deberías tener una lógica de autenticación más segura)
    if ($usuario === "admin" && $contrasena === "password") {
        // Autenticación exitosa, iniciar sesión y redirigir al usuario
        $_SESSION["usuario"] = $usuario;
        header("Location: ../html/leer_productos.html");
        exit();
    } else {
        // Credenciales incorrectas, mostrar un mensaje de error
        $mensaje_error = "Usuario o contraseña incorrectos";
    }
}
?>
