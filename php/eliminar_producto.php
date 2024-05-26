<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $stmt = $conn->prepare("CALL eliminar_producto(?)");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Producto eliminado correctamente";
    } else {
        echo "Error al eliminar producto: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
