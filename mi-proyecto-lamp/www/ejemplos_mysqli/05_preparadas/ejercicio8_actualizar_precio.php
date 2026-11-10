<?php // Material: «Solución del ejercicio 8: actualización segura de precio» (página 55 del PDF) ?>
<form method="POST">
 <h2>Actualizar precio de libro</h2>
 <p><label>Código del libro: <input type="number" name="codigo" required></label></p>
 <p><label>Nuevo precio: <input type="number" step="0.01" name="precio" required></label></p>
 <button type="submit">Actualizar</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conexion = mysqli_connect("mysql", "biblioteca", "comomola", "biblioteca");

    if (!$conexion) {
        die("<p style='color:red'>Error de conexión con la base de datos</p>");
    }

    $codigo = (int) $_POST['codigo'];
    $nuevo_precio = (float) $_POST['precio'];

    // Validar precio
    if ($nuevo_precio <= 0) {
        die("<p style='color:red'>El precio debe ser mayor que 0</p>");
    }

    // Consultar precio actual
    $stmt = mysqli_prepare($conexion, "SELECT titulo, precio FROM libros WHERE codigo = ?");
    mysqli_stmt_bind_param($stmt, "i", $codigo);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $titulo, $precio_actual);

    if (mysqli_stmt_fetch($stmt)) {
        echo "<h3>Libro encontrado:</h3>";
        echo "<p><b>Título:</b> $titulo</p>";
        echo "<p><b>Precio actual:</b> $precio_actual €</p>";
        mysqli_stmt_close($stmt);

        // Actualizar precio
        $stmt_update = mysqli_prepare($conexion, "UPDATE libros SET precio = ? WHERE codigo = ?");
        mysqli_stmt_bind_param($stmt_update, "di", $nuevo_precio, $codigo);

        if (mysqli_stmt_execute($stmt_update)) {
            $filas = mysqli_stmt_affected_rows($stmt_update);
            if ($filas > 0) {
                echo "<p style='color:green'>El precio se actualizó correctamente.</p>";
                echo "<p><b>Nuevo precio:</b> $nuevo_precio €</p>";
            } else {
                echo "<p style='color:orange'>No se realizaron cambios (el nuevo precio es igual al actual).</p>";
            }
        } else {
            echo "<p style='color:red'>Error al actualizar: " . mysqli_stmt_error($stmt_update) . "</p>";
        }

        mysqli_stmt_close($stmt_update);
    } else {
        echo "<p style='color:red'>No se encontró un libro con el código $codigo.</p>";
        mysqli_stmt_close($stmt);
    }

    mysqli_close($conexion);
}
?>
