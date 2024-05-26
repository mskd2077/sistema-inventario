// Ejemplo de función JavaScript para validar un formulario de registro
function validarRegistro() {
    var usuario = document.getElementById("usuario").value;
    var contrasena = document.getElementById("contrasena").value;

    if (usuario.trim() === "" || contrasena.trim() === "") {
        alert("Por favor, complete todos los campos.");
        return false;
    }

    return true;
}

// Ejemplo de función JavaScript para confirmar la eliminación de un producto
function confirmarEliminar(id) {
    if (confirm("¿Estás seguro de que quieres eliminar este producto?")) {
        // Lógica para eliminar el producto con el ID proporcionado
        eliminarProducto(id);
    }
}

// Ejemplo de función JavaScript para eliminar un producto
function eliminarProducto(id) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/eliminar_producto.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert(xhr.responseText);
            // Actualizar la lista de productos después de eliminar uno
            cargarProductos(); // Suponiendo que tienes una función cargarProductos para actualizar la lista
        }
    };
    xhr.send("id=" + id);
}