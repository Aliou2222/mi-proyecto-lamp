<?php
mysqli_report(MYSQLI_REPORT_OFF);
// Material: «Ejemplo: tabla HTML completa con estilos» (página 26 del PDF)
$conexion = mysqli_connect("mysql", "biblioteca", "comomola", "biblioteca");

if (!$conexion) {
    die("Error de conexión");
}

$consulta = "SELECT codigo, titulo, autor, editorial, precio FROM libros";
$resultado = mysqli_query($conexion, $consulta);
?>

<!DOCTYPE html>
<html lang="es">
<head>
 <meta charset="UTF-8">
 <title>Catálogo</title>
 <style>
  body { font-family: sans-serif; margin: 30px; }
  table { border-collapse: collapse; width: 100%; }
  th { background-color: #1B1B27; color: white; padding: 12px; }
  td { border: 1px solid #ddd; padding: 10px; }
  tr:nth-child(even) { background-color: #f2f2f2; }
  tr:hover { background-color: #e0e0e0; }
 </style>
</head>
<body>
 <h2>Catálogo de la Biblioteca</h2>
 <table>
 <thead>
 <tr>
 <th>Código</th>
 <th>Título</th>
 <th>Autor</th>
 <th>Editorial</th>
 <th>Precio</th>
 </tr>
 </thead>
 <tbody>
 <?php while ($libro = mysqli_fetch_assoc($resultado)): ?>
 <tr>
 <td><?php echo $libro['codigo']; ?></td>
 <td><?php echo htmlspecialchars($libro['titulo']); ?></td>
 <td><?php echo htmlspecialchars($libro['autor']); ?></td>
 <td><?php echo htmlspecialchars($libro['editorial']); ?></td>
 <td><?php echo number_format($libro['precio'], 2); ?> €</td>
 </tr>
 <?php endwhile; ?>
 </tbody>
 </table>
</body>
</html>

<?php
mysqli_free_result($resultado);
mysqli_close($conexion);
?>
