<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $cantidad = $_POST["cantidad"];
    $categoria = $_POST["categoria"];
    $marca = $_POST["marca"];

    // Insertar la nueva categoría en la tabla de categorías
    $stmt_categoria = $conn->prepare("INSERT INTO categorias (nombre) VALUES (?)");
    $stmt_categoria->bind_param("s", $categoria);
    $stmt_categoria->execute();
    $categoria_id = $stmt_categoria->insert_id; // Obtener el ID de la nueva categoría

    // Insertar la nueva marca en la tabla de marcas
    $stmt_marca = $conn->prepare("INSERT INTO marcas (nombre) VALUES (?)");
    $stmt_marca->bind_param("s", $marca);
    $stmt_marca->execute();
    $marca_id = $stmt_marca->insert_id; // Obtener el ID de la nueva marca

    // Insertar el nuevo producto en la tabla de productos
    $stmt_producto = $conn->prepare("INSERT INTO productos (nombre, descripcion, precio, cantidad, categoria_id, marca_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt_producto->bind_param("ssdiii", $nombre, $descripcion, $precio, $cantidad, $categoria_id, $marca_id);

    if ($stmt_producto->execute()) {
        echo "Producto agregado correctamente";
        header("Location: ../html/leer_productos.html");
        exit(); // Importante: asegúrate de salir del script después de redirigir
    } else {
        echo "Error al agregar producto: " . $conn->error;
    }

    $stmt_categoria->close();
    $stmt_marca->close();
    $stmt_producto->close();
}

$conn->close();
?>
