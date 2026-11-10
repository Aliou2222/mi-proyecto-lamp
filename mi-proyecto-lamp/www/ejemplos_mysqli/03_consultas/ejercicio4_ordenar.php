<?php
// Material: «Solución del ejercicio 4: ordenamiento descendente» (página 28 del PDF)
$conexion = mysqli_connect("mysql", "biblioteca", "comomola", "biblioteca");

if (!$conexion) {
    die("Error de conexión");
}

// Consulta con ORDER BY precio DESC
$consulta = "SELECT codigo, titulo, autor, editorial, precio
             FROM libros
             ORDER BY precio DESC";

$resultado = mysqli_query($conexion, $consulta);

echo "<h2>Libros ordenados por precio (mayor a menor)</h2>";
echo "<table border='1' cellpadding='10'>";
echo "<tr>
        <th>Código</th>
        <th>Título</th>
        <th>Autor</th>
        <th>Editorial</th>
        <th>Precio</th>
      </tr>";

while ($libro = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    echo "<td>" . $libro['codigo'] . "</td>";
    echo "<td>" . $libro['titulo'] . "</td>";
    echo "<td>" . $libro['autor'] . "</td>";
    echo "<td>" . $libro['editorial'] . "</td>";
    echo "<td>" . number_format($libro['precio'], 2) . " €</td>";
    echo "</tr>";
}

echo "</table>";

mysqli_free_result($resultado);
mysqli_close($conexion);
?>
