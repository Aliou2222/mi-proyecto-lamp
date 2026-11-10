<?php
// Material: «Ejemplo: eliminar libro por código» (página 52 del PDF)
$conexion = mysqli_connect("mysql", "biblioteca", "comomola", "biblioteca");

if (!$conexion) {
    die("Error de conexión");
}

// Código del libro a eliminar
$codigo_eliminar = 5;

// Primero, mostrar qué libro se va a eliminar
$stmt_consulta = mysqli_prepare($conexion,
    "SELECT titulo, autor FROM libros WHERE codigo = ?");
mysqli_stmt_bind_param($stmt_consulta, "i", $codigo_eliminar);
mysqli_stmt_execute($stmt_consulta);
mysqli_stmt_bind_result($stmt_consulta, $titulo, $autor);

if (mysqli_stmt_fetch($stmt_consulta)) {
    echo "<h3>Libro a eliminar:</h3>";
    echo "<p><b>Título:</b> $titulo</p>";
    echo "<p><b>Autor:</b> $autor</p>";
    mysqli_stmt_close($stmt_consulta);

    // Ahora eliminar
    $stmt_delete = mysqli_prepare($conexion,
        "DELETE FROM libros WHERE codigo = ?");
    mysqli_stmt_bind_param($stmt_delete, "i", $codigo_eliminar);

    if (mysqli_stmt_execute($stmt_delete)) {
        $filas = mysqli_stmt_affected_rows($stmt_delete);
        if ($filas > 0) {
            echo "<p style='color:green'>El libro fue eliminado correctamente.</p>";
            echo "<p><b>Código eliminado:</b> $codigo_eliminar</p>";
        } else {
            echo "<p style='color:orange'>No se encontró ningún libro con el código indicado.</p>";
        }
    } else {
        echo "<p style='color:red'>Error al eliminar el libro: " . mysqli_stmt_error($stmt_delete) . "</p>";
    }

    mysqli_stmt_close($stmt_delete);
} else {
    echo "<p style='color:red'>No se encontró un libro con el código $codigo_eliminar.</p>";
    mysqli_stmt_close($stmt_consulta);
}

// Cerrar conexión
mysqli_close($conexion);
?>
