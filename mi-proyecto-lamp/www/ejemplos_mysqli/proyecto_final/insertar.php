<?php
require "config.php";
cabecera("Añadir libro");

$titulo = $autor = $editorial = $precio = "";
$errores = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // PHP 8.5 (|>) y 8.4 (mb_trim): leer el campo y quitar espacios
    $titulo    = ($_POST['titulo'] ?? '')    |> mb_trim(...);
    $autor     = ($_POST['autor'] ?? '')     |> mb_trim(...);
    $editorial = ($_POST['editorial'] ?? '') |> mb_trim(...);
    $precio    = ($_POST['precio'] ?? '')    |> mb_trim(...);

    $errores = validar_libro($titulo, $autor, $editorial, $precio);

    if (empty($errores)) {
        $conexion = conectar();
        try {
            mysqli_execute_query($conexion,
                "INSERT INTO libros (titulo, autor, editorial, precio) VALUES (?, ?, ?, ?)",
                [$titulo, $autor, $editorial, $precio]);
            $id = mysqli_insert_id($conexion);
            mysqli_close($conexion);
            header("Location: listar.php?ok=" . urlencode("Libro $id añadido correctamente"));
            exit();
        } catch (mysqli_sql_exception $e) {
            error_log("Error al insertar [" . $e->getCode() . "]: " . $e->getMessage());
            $errores[] = "No se ha podido guardar el libro";
        }
    }
}

foreach ($errores as $error) echo "<p class='error'>" . e($error) . "</p>";
?>
<form method="post">
  <label>Título: <input type="text" name="titulo" maxlength="40" value="<?= e($titulo) ?>" required></label>
  <label>Autor: <input type="text" name="autor" maxlength="30" value="<?= e($autor) ?>" required></label>
  <label>Editorial: <input type="text" name="editorial" maxlength="20" value="<?= e($editorial) ?>" required></label>
  <label>Precio: <input type="number" step="0.01" min="0" max="999.99" name="precio" value="<?= e($precio) ?>" required></label>
  <button type="submit">Añadir libro</button>
</form>
<?php pie(); ?>
