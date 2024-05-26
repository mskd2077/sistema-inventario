<?php
include 'conexion.php';

$result = $conn->query("CALL listar_productos()");

echo "<table>";
echo "<tr><th>Id</th><th>Nombre</th><th>Descripción</th><th>Precio</th><th>Cantidad</th><th>Categoría</th><th>Marca</th><th>Acciones</th></tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["descripcion"] . "</td>";
        echo "<td>" . "S/." . $row["precio"] . "</td>";
        echo "<td>" . $row["cantidad"] . "</td>";
        echo "<td>" . $row["categoria"] . "</td>";
        echo "<td>" . $row["marca"] . "</td>";
        echo "<td class='acciones'>";
        echo "<button onclick=\"location.href='../php/actualizar_producto.php';\"><i class='fas fa-edit'></i> Actualizar Producto</button>";
        echo "<button onclick=\"confirmarEliminar(1);\"><i class='fas fa-trash-alt'></i> Eliminar Producto</button>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>No hay productos disponibles</td></tr>";
}

echo "</table>";

$conn->close();
?>
