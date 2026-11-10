<?php // Material: «Solución del ejercicio 7: inserción validada» (página 49 del PDF) ?>
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
    $conexion = mysqli_connect("mysql", "biblioteca", "comomola", "biblioteca");

    if (!$conexion) {
        die("<p style='color:red'>Error de conexión: " . mysqli_connect_error() . "</p>");
    }

    // Sanitizar entradas (PHP 8.4: mb_trim() también quita espacios Unicode)
    $titulo = mb_trim($_POST['titulo']);
    $autor = mb_trim($_POST['autor']);
    $editorial = mb_trim($_POST['editorial']);
    $precio = mb_trim($_POST['precio']);

    // Array para almacenar errores
    $errores = [];

    // Validaciones
    // Cambio respecto al material: mb_strlen() en lugar de strlen().
    // strlen() cuenta bytes y "ñ" o "á" ocupan 2; VARCHAR(40) cuenta caracteres.
    if (empty($titulo)) {
        $errores[] = "El título es obligatorio";
    } elseif (mb_strlen($titulo) > 40) {
        $errores[] = "El título no puede superar 40 caracteres";
    }

    if (empty($autor)) {
        $errores[] = "El autor es obligatorio";
    } elseif (mb_strlen($autor) > 30) {
        $errores[] = "El autor no puede superar 30 caracteres";
    }

    if (empty($editorial)) {
        $errores[] = "La editorial es obligatoria";
    } elseif (mb_strlen($editorial) > 20) {
        $errores[] = "La editorial no puede superar 20 caracteres";
    }

    if (!is_numeric($precio)) {
        $errores[] = "El precio debe ser un número";
    } elseif ($precio < 0) {
        $errores[] = "El precio no puede ser negativo";
    } elseif ($precio > 999.99) {
        $errores[] = "El precio máximo es 999.99 €";
    }

    // Si hay errores, mostrarlos
    if (count($errores) > 0) {
        echo "<div style='color:red'>";
        echo "<h3>Se han encontrado los siguientes errores:</h3>";
        echo "<ul>";
        foreach ($errores as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
        echo "</div>";
    } else {
        // Si no hay errores, ejecutar la inserción segura
        $stmt = mysqli_prepare($conexion,
            "INSERT INTO libros (titulo, autor, editorial, precio) VALUES (?, ?, ?, ?)"
        );

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssd", $titulo, $autor, $editorial, $precio);

            if (mysqli_stmt_execute($stmt)) {
                $id = mysqli_insert_id($conexion);
                echo "<p style='color:green'>Libro insertado correctamente.</p>";
                echo "<p><strong>ID asignado:</strong> $id</p>";
                echo "<p>Título: " . htmlspecialchars($titulo) . "<br>Autor: " . htmlspecialchars($autor)
                   . "<br>Editorial: " . htmlspecialchars($editorial) . "<br>Precio: $precio €</p>";
            } else {
                echo "<p style='color:red'>Error al insertar el libro: " . mysqli_stmt_error($stmt) . "</p>";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "<p style='color:red'>Error al preparar la consulta: " . mysqli_error($conexion) . "</p>";
        }
    }

    // Cerrar conexión
    mysqli_close($conexion);
}
?>
