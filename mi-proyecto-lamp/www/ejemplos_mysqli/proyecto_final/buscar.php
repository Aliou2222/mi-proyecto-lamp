<?php
require "config.php";
cabecera("Buscar libros");

$campos = ["titulo" => "Título", "autor" => "Autor", "editorial" => "Editorial"];
$campo = $_GET['campo'] ?? 'titulo';
$texto = ($_GET['texto'] ?? '') |> mb_trim(...);
if (!isset($campos[$campo])) $campo = 'titulo';   // solo columnas permitidas
?>
<form method="get">
  <select name="campo">
  <?php foreach ($campos as $valor => $nombre): ?>
    <option value="<?= $valor ?>" <?= $valor == $campo ? 'selected' : '' ?>><?= $nombre ?></option>
  <?php endforeach; ?>
  </select>
  <input type="text" name="texto" value="<?= e($texto) ?>" placeholder="Texto a buscar">
  <button type="submit">Buscar</button>
</form>
<?php
if ($texto !== '') {
    $conexion = conectar();
    // El nombre de la columna no puede ir en un "?": por eso se valida con la lista $campos.
    // El texto del usuario sí va siempre como parámetro (mysqli_execute_query, PHP 8.2+).
    $resultado = mysqli_execute_query($conexion,
        "SELECT codigo, titulo, autor, editorial, precio FROM libros WHERE $campo LIKE ? ORDER BY titulo",
        ["%$texto%"]);

    $n = mysqli_num_rows($resultado);
    echo "<p>Resultados para <b>" . e($texto) . "</b> en " . $campos[$campo] . ": $n</p>";
    if ($n > 0) {
        echo "<table><tr><th>Código</th><th>Título</th><th>Autor</th><th>Editorial</th><th>Precio</th></tr>";
        while ($libro = mysqli_fetch_assoc($resultado)) {
            echo "<tr><td>{$libro['codigo']}</td><td>" . e($libro['titulo']) . "</td><td>" . e($libro['autor'])
               . "</td><td>" . e($libro['editorial']) . "</td><td>" . number_format($libro['precio'], 2, ',', '.') . " €</td></tr>";
        }
        echo "</table>";
    }
    mysqli_close($conexion);
}
pie();
?>
