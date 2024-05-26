<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nombre"], $_POST["descripcion"], $_POST["precio"], $_POST["cantidad"], $_POST["categoria_id"], $_POST["marca_id"])) {
        // Sanitize inputs
        $id = mysqli_real_escape_string($conn, $_POST["id"]); // Assuming id is coming from the form
        $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
        $descripcion = mysqli_real_escape_string($conn, $_POST["descripcion"]);
        $precio = (float)$_POST["precio"];
        $cantidad = (int)$_POST["cantidad"];
        $categoria_id = (int)$_POST["categoria_id"];
        $marca_id = (int)$_POST["marca_id"];

        $stmt = $conn->prepare("CALL actualizar_producto(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdiiii", $id, $nombre, $descripcion, $precio, $cantidad, $categoria_id, $marca_id);

        if ($stmt->execute()) {
            echo "Producto actualizado correctamente";
        } else {
            echo "Error al actualizar producto: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Los datos del producto no están completos.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Producto</title>
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
</head>
<body>
    <h2>Actualizar Producto</h2>
    <?php
    include '../php/conexion.php';

    if (isset($_GET["nombre"])) {
        $nombre = mysqli_real_escape_string($conn, $_GET["nombre"]); // Sanitize input

        $sql = "SELECT * FROM productos WHERE nombre='$nombre'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($row["nombre"]); ?>" required><br><br>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion"><?php echo htmlspecialchars($row["descripcion"]); ?></textarea><br><br>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" value="<?php echo $row["precio"]; ?>" required><br><br>
        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" value="<?php echo $row["cantidad"]; ?>" required><br><br>
        <label for="categoria">Categoría:</label>
        <select id="categoria" name="categoria_id" required>
            <option value="">Seleccione una categoría</option>
            <?php
            $result = $conn->query("SELECT id, nombre FROM categorias");
            while ($categoria = $result->fetch_assoc()) {
                $selected = ($categoria["id"] == $row["categoria_id"]) ? "selected" : "";
                echo "<option value='{$categoria["id"]}' $selected>{$categoria["nombre"]}</option>";
            }
            ?>
        </select><br><br>
        <label for="marca">Marca:</label>
        <select id="marca" name="marca_id" required>
            <option value="">Seleccione una marca</option>
            <?php
            $result = $conn->query("SELECT id, nombre FROM marcas");
            while ($marca = $result->fetch_assoc()) {
                $selected = ($marca["id"] == $row["marca_id"]) ? "selected" : "";
                echo "<option value='{$marca["id"]}' $selected>{$marca["nombre"]}</option>";
            }
            ?>
        </select><br><br>
        <input type="submit" value="Actualizar Producto">
    </form>
    <?php
        } else {
            echo "No se encontró el producto.";
        }
    } else {
        echo "ID del producto no proporcionado.";
    }

    $conn->close();
    ?>
</body>
</html>
