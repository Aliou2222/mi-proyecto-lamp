<?php
// Material: «Ejemplo: eliminación con confirmación» (página 32-33 del PDF)
$conexion = mysqli_connect("mysql", "biblioteca", "comomola", "biblioteca");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$codigo_a_eliminar = (int) ($_GET['codigo'] ?? 0);
$confirmar_borrado = ($_GET['confirmar_borrado'] ?? '') === 'true';

if ($codigo_a_eliminar > 0) {
    if ($confirmar_borrado) {
        $query = "DELETE FROM libros WHERE codigo = $codigo_a_eliminar";
        if (mysqli_query($conexion, $query)) {
            if (mysqli_affected_rows($conexion) > 0) {
                echo "<p style='color: green;'>Libro con código <b>$codigo_a_eliminar</b> eliminado <b>definitivamente</b>.</p>";
            } else {
                echo "<p style='color: orange;'>No se encontró el libro con código <b>$codigo_a_eliminar</b>.</p>";
            }
        } else {
            echo "<p style='color: red;'>Error al eliminar el libro: " . mysqli_error($conexion) . "</p>";
        }
    } else {
        // Mostrar datos del libro y pedir confirmación
        $query_select = "SELECT titulo, autor FROM libros WHERE codigo = $codigo_a_eliminar";
        $resultado = mysqli_query($conexion, $query_select);
        if ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<p>¿Estás seguro de eliminar el libro:<br>";
            echo "Título: <b>" . htmlspecialchars($fila['titulo']) . "</b>, ";
            echo "Autor: <b>" . htmlspecialchars($fila['autor']) . "</b> (Código: <b>$codigo_a_eliminar</b>)?</p>";
            echo "<p><a href='?codigo=$codigo_a_eliminar&confirmar_borrado=true' style='color: red;'>Sí, eliminar</a> | <a href='?'>No, cancelar</a></p>";
        } else {
            echo "<p>No se encontró el libro con código <b>$codigo_a_eliminar</b>.</p>";
        }
    }
} else {
    echo "<p>Por favor, especifica un código de libro válido para eliminar. <br>";
    echo "Ejemplo: <a href='?codigo=1'>eliminar_confirmacion.php?codigo=1</a></p>";
}

mysqli_close($conexion);
?>
