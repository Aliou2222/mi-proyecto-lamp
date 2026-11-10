<?php // Material: «Ejemplo: formulario de inserción segura» (página 45 del PDF) ?>
<!-- Formulario HTML -->
<form method="POST" action="">
 <h2>Añadir nuevo libro</h2>
 <p><label>Título: <input type="text" name="titulo" required></label></p>
 <p><label>Autor: <input type="text" name="autor" required></label></p>
 <p><label>Editorial: <input type="text" name="editorial" required></label></p>
 <p><label>Precio: <input type="number" step="0.01" name="precio" required></label></p>
 <button type="submit">Añadir libro</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conexión a la base de datos
    $conexion = mysqli_connect("mysql", "biblioteca", "comomola", "biblioteca");

    if (!$conexion) {
        die("<p style='color:red'>Error de conexión: " . mysqli_connect_error() . "</p>");
    }

    // Obtener datos del formulario
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editorial = $_POST['editorial'];
    $precio = $_POST['precio'];

    // Preparar la sentencia SQL
    $stmt = mysqli_prepare($conexion,
        "INSERT INTO libros (titulo, autor, editorial, precio) VALUES (?, ?, ?, ?)");

    if ($stmt) {
        // Vincular parámetros (s=string, s=string, s=string, d=decimal)
        mysqli_stmt_bind_param($stmt, "sssd", $titulo, $autor, $editorial, $precio);

        // Ejecutar la sentencia
        if (mysqli_stmt_execute($stmt)) {
            $id = mysqli_insert_id($conexion);
            echo "<p style='color:green'>Libro insertado correctamente.</p>";
            echo "<p><strong>ID asignado:</strong> $id</p>";
            // Cambio respecto al material: htmlspecialchars() al mostrar datos del usuario
            echo "<p><strong>Título:</strong> " . htmlspecialchars($titulo) . "<br>
                  <strong>Autor:</strong> " . htmlspecialchars($autor) . "<br>
                  <strong>Editorial:</strong> " . htmlspecialchars($editorial) . "<br>
                  <strong>Precio:</strong> " . htmlspecialchars($precio) . " €</p>";
        } else {
            echo "<p style='color:red'>Error al insertar el libro: " . mysqli_stmt_error($stmt) . "</p>";
        }

        // Cerrar la sentencia
        mysqli_stmt_close($stmt);
    } else {
        echo "<p style='color:red'>Error al preparar la consulta: " . mysqli_error($conexion) . "</p>";
    }

    // Cerrar la conexión
    mysqli_close($conexion);
}
?>
