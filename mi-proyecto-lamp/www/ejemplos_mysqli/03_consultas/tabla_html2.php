<?php
mysqli_report(MYSQLI_REPORT_OFF);
// Material: «Ejemplo: tabla HTML completa con estilos» (página 26 del PDF)
$conexion = mysqli_connect("mysql", "biblioteca", "comomola", "biblioteca");

if (!$conexion) {
    die("Error de conexión");
}

$consulta = "SELECT codigo, titulo, autor, editorial, precio FROM libros ORDER BY precio DESC LIMIT 3";
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
  th { background-color: #68d0e2; color: black; padding: 12px; }
  td { border: 1px solid #68d0e2; padding: 10px; }
  tr:nth-child(even) { background-color: #000000; color: white; }
  tr:hover { background-color: #e0e0e0; }
 </style>
</head>
<body>
 <h2>Los 3 libros más caros</h2>
 <table>
 <thead>
 <tr>
 <th>Título</th>
 <th>Autor</th>
 <th>Precio</th>
 </tr>
 </thead>
 <tbody>
 <?php while ($libro = mysqli_fetch_assoc($resultado)): ?>
 <tr>
 <td><?php echo htmlspecialchars($libro['titulo']); ?></td>
 <td><?php echo htmlspecialchars($libro['autor']); ?></td>
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
