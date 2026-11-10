<?php
// Material: «Solución del ejercicio 5: actualizar precio» (página 34 del PDF)
$conexion = mysqli_connect("mysql", "biblioteca", "comomola", "biblioteca");

if (!$conexion) {
    die("Error: " . mysqli_connect_error());
}

echo "<h2>Actualización de precio de libro</h2>";

// Paso 1: Consultar precio actual
$consulta_antes = "SELECT titulo, precio FROM libros WHERE codigo = 1";
$resultado_antes = mysqli_query($conexion, $consulta_antes);
$libro_antes = mysqli_fetch_assoc($resultado_antes);

echo "<h3>Antes de la actualización:</h3>";
echo "<p>Libro: " . $libro_antes['titulo'] . "</p>";
echo "<p>Precio anterior: " . $libro_antes['precio'] . " €</p>";

// Paso 2: Ejecutar UPDATE
$consulta_update = "UPDATE libros SET precio = 25.00 WHERE codigo = 1";

if (mysqli_query($conexion, $consulta_update)) {
    echo "<p style='color:green'>Precio actualizado correctamente.</p>";

    // Paso 3: Consultar el nuevo precio
    $consulta_despues = "SELECT titulo, precio FROM libros WHERE codigo = 1";
    $resultado_despues = mysqli_query($conexion, $consulta_despues);
    $libro_despues = mysqli_fetch_assoc($resultado_despues);

    echo "<h3>Después de la actualización:</h3>";
    echo "<p>Libro: " . $libro_despues['titulo'] . "</p>";
    echo "<p>Nuevo precio: " . $libro_despues['precio'] . " €</p>";
} else {
    echo "<p style='color:red'>Error al actualizar el precio: " . mysqli_error($conexion) . "</p>";
}

// Cerrar conexión
mysqli_close($conexion);
?>
