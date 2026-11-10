<?php
// Material: «Página borrar.php: eliminación con confirmación» (página 60 del PDF)
// borrar.php?codigo=N  — eliminación en dos pasos
$conexion = mysqli_connect("mysql", "biblioteca", "comomola", "biblioteca");

// Paso 1: solicitar confirmación
$codigo = (int) ($_GET['codigo'] ?? 0);
$confirmar = $_GET['confirmar'] ?? false;

if (!$codigo) {
    die("Código no especificado. Ejemplo: <a href='?codigo=2'>borrar.php?codigo=2</a>");
}

// Obtener datos del libro
$sql = "SELECT titulo, autor FROM libros WHERE codigo = ?";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $codigo);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$libro = mysqli_fetch_assoc($resultado);

if (!$libro) {
    die("Libro no encontrado");
}

if (!$confirmar) {
    echo "<h3>¿Está seguro de eliminar este libro?</h3>";
    echo "<p><b>Título:</b> " . htmlspecialchars($libro['titulo']) . "</p>";
    echo "<p><b>Autor:</b> " . htmlspecialchars($libro['autor']) . "</p>";
    echo "<a href='borrar.php?codigo=$codigo&confirmar=1'>Sí, eliminar</a> | ";
    echo "<a href='../03_consultas/tabla_html.php'>Cancelar</a>";
    exit;
}

// Paso 2: ejecutar eliminación (si llega aquí, el usuario confirmó)
$sql = "DELETE FROM libros WHERE codigo = ?";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $codigo);

if (mysqli_stmt_execute($stmt)) {
    echo "<h3>Libro eliminado correctamente</h3>";
    echo "<p>El libro ha sido borrado de la base de datos.</p>";
    echo "<a href='../03_consultas/tabla_html.php'>Volver al listado</a>";
} else {
    echo "Error al eliminar: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>
