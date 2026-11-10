<?php
// Material: «Ejemplo: eliminar registros (sin confirmación)» (página 32 del PDF)
$conexion = mysqli_connect("mysql", "biblioteca", "comomola", "biblioteca");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$codigo_a_eliminar = 9; // Ejemplo: eliminar el libro con código 9

$query = "DELETE FROM libros WHERE codigo = $codigo_a_eliminar";

if (mysqli_query($conexion, $query)) {
    if (mysqli_affected_rows($conexion) > 0) {
        echo "<p>Libro con código <b>$codigo_a_eliminar</b> eliminado correctamente.</p>";
    } else {
        echo "<p>No se encontró ningún libro con el código <b>$codigo_a_eliminar</b> para eliminar.</p>";
    }
} else {
    echo "<p>Error al eliminar el libro: " . mysqli_error($conexion) . "</p>";
}

mysqli_close($conexion);
?>
