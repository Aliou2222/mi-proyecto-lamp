<?php
// Material: «Página actualizar.php (partes 1 y 2)» (página 58-59 del PDF)
// actualizar.php?codigo=N  (partes 1 y 2 del material en un único archivo)
$conexion = mysqli_connect("mysql", "biblioteca", "comomola", "biblioteca");

// ---------- Parte 1: cargar los datos ----------
// 1. Recibir parámetro GET (cambio: se convierte a entero)
$codigo = (int) ($_GET['codigo'] ?? 0);

if (!$codigo) {
    die("Código no especificado. Ejemplo: <a href='?codigo=1'>actualizar.php?codigo=1</a>");
}

// ---------- Parte 2b: procesar la actualización ----------
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editorial = $_POST['editorial'];
    $precio = $_POST['precio'];

    $sql = "UPDATE libros SET titulo=?, autor=?, editorial=?, precio=?
            WHERE codigo=?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sssdi", $titulo, $autor, $editorial,
                           $precio, $codigo);

    if (mysqli_stmt_execute($stmt)) {
        echo "<p style='color:green'>Libro actualizado correctamente</p>";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
}

// 2. Preparar consulta SELECT
$sql = "SELECT * FROM libros
        WHERE codigo = ?";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $codigo);

// 3. Ejecutar y obtener resultado
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$libro = mysqli_fetch_assoc($resultado);

if (!$libro) {
    die("Libro no encontrado");
}
?>
<!-- ---------- Parte 2a: formulario con datos precargados ---------- -->
<form method="POST" action="actualizar.php?codigo=<?= $codigo ?>">
  <label>Título:</label>
  <input type="text" name="titulo" value="<?= htmlspecialchars($libro['titulo']) ?>" required>

  <label>Autor:</label>
  <input type="text" name="autor" value="<?= htmlspecialchars($libro['autor']) ?>" required>

  <label>Editorial:</label>
  <input type="text" name="editorial" value="<?= htmlspecialchars($libro['editorial']) ?>" required>

  <label>Precio:</label>
  <input type="number" step="0.01" name="precio" value="<?= $libro['precio'] ?>" required>

  <button type="submit">Actualizar</button>
</form>
<?php
mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>
