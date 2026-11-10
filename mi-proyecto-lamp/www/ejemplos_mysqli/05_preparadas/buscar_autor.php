<?php
// Material: «Ejemplo: buscar libros por autor (seguro)» (página 40 del PDF)
$conexion = mysqli_connect("mysql", "biblioteca", "comomola", "biblioteca");

if (!$conexion) {
    die("Error de conexión");
}

// Simular dato recibido de un formulario
$autor_buscado = "Borges";

// Paso 1: Preparar la consulta con marcador ?
$consulta = "SELECT codigo, titulo, autor, editorial, precio
             FROM libros
             WHERE autor = ?";

$stmt = mysqli_prepare($conexion, $consulta);

if (!$stmt) {
    die("Error al preparar: " . mysqli_error($conexion));
}

// Paso 2: Vincular parámetro (s = string)
mysqli_stmt_bind_param($stmt, "s", $autor_buscado);

// Paso 3: Ejecutar
mysqli_stmt_execute($stmt);

// Paso 4: Vincular variables de resultado
mysqli_stmt_bind_result($stmt, $codigo, $titulo, $autor, $editorial, $precio);

// Paso 5: Obtener y mostrar resultados
echo "<h2>Libros del autor: $autor_buscado</h2>";

while (mysqli_stmt_fetch($stmt)) {
    echo "<hr>";
    echo "<b>Código:</b> $codigo<br>";
    echo "<b>Título:</b> $titulo<br>";
    echo "<b>Editorial:</b> $editorial<br>";
    echo "<b>Precio:</b> $precio €<br>";
}

// Paso 6: Cerrar statement y conexión
mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>
