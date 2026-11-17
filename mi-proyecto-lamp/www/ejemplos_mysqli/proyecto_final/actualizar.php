<?php
require "config.php";

$conexion = conectar();
$codigo = (int) ($_GET['codigo'] ?? 0);
$errores = [];

// Paso 1: si no llega ningún código, elegir el libro en una lista
if ($codigo === 0) {
    $libros = mysqli_execute_query($conexion, "SELECT codigo, titulo, autor FROM libros ORDER BY codigo");
    mysqli_close($conexion);
    cabecera("Actualizar libro");
    echo "<form method='get'><label>Elige el libro: <select name='codigo'>";
    while ($l = mysqli_fetch_assoc($libros)) {
        echo "<option value='{$l['codigo']}'>{$l['codigo']} · " . e($l['titulo']) . " (" . e($l['autor']) . ")</option>";
    }
    echo "</select></label><button type='submit'>Modificar</button></form>";
    pie();
    exit();
}

// Paso 2: modificar los datos del libro elegido

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // PHP 8.5 (|>) y 8.4 (mb_trim): leer el campo y quitar espacios
    $titulo    = ($_POST['titulo'] ?? '')    |> mb_trim(...);
    $autor     = ($_POST['autor'] ?? '')     |> mb_trim(...);
    $editorial = ($_POST['editorial'] ?? '') |> mb_trim(...);
    $precio    = ($_POST['precio'] ?? '')    |> mb_trim(...);
    $errores = validar_libro($titulo, $autor, $editorial, $precio);

    if (empty($errores)) {
        // Orden: primero los valores del SET y al final el del WHERE
        mysqli_execute_query($conexion,
            "UPDATE libros SET titulo = ?, autor = ?, editorial = ?, precio = ? WHERE codigo = ?",
            [$titulo, $autor, $editorial, $precio, $codigo]);
        mysqli_close($conexion);
        header("Location: listar.php?ok=" . urlencode("Libro $codigo actualizado"));
        exit();
    }
    $libro = compact('titulo', 'autor', 'editorial', 'precio');
} else {
    // Cargar los datos actuales (null si el libro no existe)
    $libro = mysqli_execute_query($conexion,
            "SELECT titulo, autor, editorial, precio FROM libros WHERE codigo = ?", [$codigo])
        |> mysqli_fetch_assoc(...);
}
mysqli_close($conexion);

cabecera("Actualizar libro $codigo");
if (!$libro) {
    echo "<p class='error'>No existe ningún libro con el código $codigo.</p>";
    pie();
    exit();
}
foreach ($errores as $error) echo "<p class='error'>" . e($error) . "</p>";
?>
<form method="post" action="actualizar.php?codigo=<?= $codigo ?>">
  <label>Título: <input type="text" name="titulo" maxlength="40" value="<?= e($libro['titulo']) ?>" required></label>
  <label>Autor: <input type="text" name="autor" maxlength="30" value="<?= e($libro['autor']) ?>" required></label>
  <label>Editorial: <input type="text" name="editorial" maxlength="20" value="<?= e($libro['editorial']) ?>" required></label>
  <label>Precio: <input type="number" step="0.01" min="0" max="999.99" name="precio" value="<?= e($libro['precio']) ?>" required></label>
  <button type="submit">Guardar cambios</button> <a href="listar.php">Cancelar</a>
</form>
<?php pie(); ?>
