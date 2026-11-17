<?php
require "config.php";

$conexion = conectar();
$codigo = (int) ($_GET['codigo'] ?? $_POST['codigo'] ?? 0);

// Paso 2: el borrado solo se hace por POST (un enlace GET no debe modificar datos)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    mysqli_execute_query($conexion, "DELETE FROM libros WHERE codigo = ?", [$codigo]);
    $filas = mysqli_affected_rows($conexion);
    mysqli_close($conexion);
    $mensaje = $filas > 0 ? "Libro $codigo eliminado" : "El libro $codigo ya no existía";
    header("Location: listar.php?ok=" . urlencode($mensaje));
    exit();
}

// Paso 1: mostrar los datos y pedir confirmación
$libro = mysqli_execute_query($conexion,
        "SELECT titulo, autor, editorial FROM libros WHERE codigo = ?", [$codigo])
    |> mysqli_fetch_assoc(...);
mysqli_close($conexion);

cabecera("Eliminar libro");
if (!$libro) {
    echo "<p class='error'>No existe ningún libro con el código $codigo.</p>";
} else {
?>
  <p>¿Seguro que quieres eliminar este libro?</p>
  <p><b><?= e($libro['titulo']) ?></b> · <?= e($libro['autor']) ?> · <?= e($libro['editorial']) ?></p>
  <form method="post">
    <input type="hidden" name="codigo" value="<?= $codigo ?>">
    <button type="submit" class="peligro">Sí, eliminar</button>
    <a href="listar.php">Cancelar</a>
  </form>
<?php
}
pie();
?>
