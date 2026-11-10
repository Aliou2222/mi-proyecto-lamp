<?php
// Material: «Solución del ejercicio 3: filtrar por editorial» (página 23 del PDF)
$conexion = mysqli_connect("mysql", "biblioteca", "comomola", "biblioteca");

if (!$conexion) {
    die("Error: " . mysqli_connect_error());
}

// Consulta con filtro WHERE
$consulta = "SELECT titulo, precio FROM libros WHERE editorial = 'Paidos'";
$resultado = mysqli_query($conexion, $consulta);

if (!$resultado) {
    die("Error en consulta: " . mysqli_error($conexion));
}

echo "<h2>Libros de la editorial Paidos</h2>";
echo "<p>Se encontraron " . mysqli_num_rows($resultado) . " libros</p>";

// Mostrar resultados
while ($libro = mysqli_fetch_assoc($resultado)) {
    echo "<p>";
    echo "<b>" . $libro['titulo'] . "</b> - ";
    echo $libro['precio'] . " €";
    echo "</p>";
}

// Liberar recursos
mysqli_free_result($resultado);
mysqli_close($conexion);
?>
