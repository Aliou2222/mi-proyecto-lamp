<?php
// Material: «Solución del ejercicio 9: práctica de errores» (página 65 del PDF)
// Necesario en PHP 8.1+ para comprobar los valores devueltos en lugar de recibir excepciones
mysqli_report(MYSQLI_REPORT_OFF);

$conexion = mysqli_connect("mysql", "biblioteca", "comomola", "biblioteca");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

echo "<h2>Prueba de manejo de errores</h2>";

// Error 1: Tabla inexistente
echo "<h3>Prueba 1: Tabla inexistente</h3>";
$resultado = mysqli_query($conexion, "SELECT * FROM libritos");

if (!$resultado) {
    $codigo = mysqli_errno($conexion);
    $mensaje = mysqli_error($conexion);
    echo "<div style='background:#ffeeee; padding:10px; border-left:4px solid red'>";
    echo "<p><b>Error capturado</b></p>";
    echo "<p>Código: $codigo</p>";
    echo "<p>Mensaje: $mensaje</p>";
    echo "</div>";
}

// Error 2: Sintaxis SQL incorrecta
echo "<h3>Prueba 2: Sintaxis incorrecta</h3>";
$resultado = mysqli_query($conexion, "SELEC titulo FORM libros");

if (!$resultado) {
    $codigo = mysqli_errno($conexion);
    $mensaje = mysqli_error($conexion);
    echo "<div style='background:#ffeeee; padding:10px; border-left:4px solid red'>";
    echo "<p><b>Error de sintaxis capturado</b></p>";
    echo "<p>Código: $codigo</p>";
    echo "<p>Mensaje: $mensaje</p>";
    echo "</div>";
}

// Error 3: Columna inexistente en INSERT
echo "<h3>Prueba 3: Columna inexistente</h3>";
$stmt = mysqli_prepare($conexion,
    "INSERT INTO libros (columna_falsa, titulo) VALUES (?, ?)");

if (!$stmt) {
    echo "<div style='background:#ffeeee; padding:10px; border-left:4px solid red'>";
    echo "<p><b>Error al preparar statement</b></p>";
    echo "<p>Código: " . mysqli_errno($conexion) . "</p>";
    echo "<p>Mensaje: " . mysqli_error($conexion) . "</p>";
    echo "</div>";
} else {
    $columna_falsa = "valor";
    $titulo = "Libro de prueba";
    mysqli_stmt_bind_param($stmt, "ss", $columna_falsa, $titulo);
    if (!mysqli_stmt_execute($stmt)) {
        echo "<div style='background:#ffeeee; padding:10px; border-left:4px solid red'>";
        echo "<p><b>Error al ejecutar el statement</b></p>";
        echo "<p>Código: " . mysqli_errno($conexion) . "</p>";
        echo "<p>Mensaje: " . mysqli_error($conexion) . "</p>";
        echo "</div>";
    }
    mysqli_stmt_close($stmt);
}

// Añadido: Error 4, el tercer error que pide el enunciado y que la solución del
// PDF no incluye: texto en un campo numérico usando el tipo "s" en lugar de "d"
echo "<h3>Prueba 4: Error de tipos en bind_param</h3>";
$stmt = mysqli_prepare($conexion,
    "INSERT INTO libros (titulo, editorial, precio) VALUES (?, ?, ?)");
$titulo = "Libro de prueba";
$editorial = "Prueba";
$precio = "veinte euros";
mysqli_stmt_bind_param($stmt, "sss", $titulo, $editorial, $precio);   // debería ser "ssd"

if (!mysqli_stmt_execute($stmt)) {
    echo "<div style='background:#ffeeee; padding:10px; border-left:4px solid red'>";
    echo "<p><b>Error al ejecutar el statement</b></p>";
    echo "<p>Código: " . mysqli_stmt_errno($stmt) . "</p>";
    echo "<p>Mensaje: " . mysqli_stmt_error($stmt) . "</p>";
    echo "</div>";
}
mysqli_stmt_close($stmt);

echo "<p style='color:green'><b>Fin de las pruebas de manejo de errores.</b></p>";

// Cerrar conexión
mysqli_close($conexion);
?>
