<?php
require "config.php";
cabecera("Gestión de la biblioteca");

$conexion = conectar();
// PHP 8.5: el operador |> pasa el resultado de cada paso al siguiente
$total = mysqli_execute_query($conexion, "SELECT COUNT(*) FROM libros")
    |> mysqli_fetch_row(...)
    |> array_first(...);
mysqli_close($conexion);
?>
<p>Hay <b><?= $total ?></b> libros en el catálogo.</p>
<ul>
  <li><a href="listar.php">Listar todos los libros</a> (desde ahí se pueden actualizar o eliminar)</li>
  <li><a href="buscar.php">Buscar por título, autor o editorial</a></li>
  <li><a href="insertar.php">Añadir un libro nuevo</a></li>
  <li><a href="actualizar.php">Actualizar un libro</a> (elegirlo por su código)</li>
</ul>
<?php pie(); ?>
