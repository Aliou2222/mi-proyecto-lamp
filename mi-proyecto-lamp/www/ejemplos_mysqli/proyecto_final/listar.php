<?php
require "config.php";
cabecera("Listado de libros");

$conexion = conectar();
// El enunciado pide usar solo consultas preparadas: también aquí, aunque no haya datos del usuario
$resultado = mysqli_execute_query($conexion,
    "SELECT codigo, titulo, autor, editorial, precio FROM libros ORDER BY codigo");

if (isset($_GET['ok'])) echo "<p class='ok'>" . e($_GET['ok']) . "</p>";
?>
<table>
  <tr><th>Código</th><th>Título</th><th>Autor</th><th>Editorial</th><th>Precio</th><th>Acciones</th></tr>
<?php while ($libro = mysqli_fetch_assoc($resultado)): ?>
  <tr>
    <td><?= $libro['codigo'] ?></td>
    <td><?= e($libro['titulo']) ?></td>
    <td><?= e($libro['autor']) ?></td>
    <td><?= e($libro['editorial']) ?></td>
    <td><?= number_format($libro['precio'], 2, ',', '.') ?> €</td>
    <td>
      <a href="actualizar.php?codigo=<?= $libro['codigo'] ?>">Actualizar</a> |
      <a href="eliminar.php?codigo=<?= $libro['codigo'] ?>">Eliminar</a>
    </td>
  </tr>
<?php endwhile; ?>
</table>
<?php
mysqli_free_result($resultado);
mysqli_close($conexion);
pie();
?>
