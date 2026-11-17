<?php
// Material: «El problema: Inyección SQL» (página 36 del PDF)
// DEMOSTRACIÓN DIDÁCTICA: compara la consulta vulnerable del material con la
// versión segura con consulta preparada. No uses nunca la versión vulnerable.
$conexion = mysqli_connect("mysql", "biblioteca", "comomola", "biblioteca");

$autor = $_POST['autor'] ?? '';

// Muestra los títulos de un resultado en una lista
function mostrar_libros(mysqli_result $resultado): void
{
    echo "<p>Filas devueltas: <b>" . mysqli_num_rows($resultado) . "</b></p><ul>";
    while ($libro = mysqli_fetch_assoc($resultado)) {
        echo "<li>" . htmlspecialchars($libro['titulo']) . " · " . htmlspecialchars($libro['autor']) . "</li>";
    }
    echo "</ul>";
}
?>
<h2>Inyección SQL: consulta vulnerable frente a consulta preparada</h2>
<form method="post">
    Autor: <input type="text" name="autor" size="30" value="<?= htmlspecialchars($autor) ?>">
    <button type="submit">Buscar</button>
</form>
<p>Prueba primero con <code>Borges</code> y después con el ataque del material:
   <code>' OR '1'='1</code>. Prueba también con <code>O'Brien</code>.</p>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ✗ CÓDIGO VULNERABLE (el del material): el dato se pega dentro de la consulta
    $consulta = "SELECT * FROM libros
                 WHERE autor = '$autor'";
    echo "<h3>✗ Código vulnerable</h3>";
    echo "<p>Consulta que llega a MySQL: <code>" . htmlspecialchars($consulta) . "</code></p>";
    // Desde PHP 8.1, si la consulta queda mal formada mysqli lanza una excepción
    try {
        $resultado = mysqli_query($conexion, $consulta);
        mostrar_libros($resultado);
    } catch (mysqli_sql_exception $e) {
        echo "<p style='color:red'>Error " . $e->getCode() . ": " . htmlspecialchars($e->getMessage()) . "</p>";
    }

    // ✓ CÓDIGO SEGURO: consulta preparada. El dato nunca se interpreta como SQL
    $stmt = mysqli_prepare($conexion, "SELECT * FROM libros WHERE autor = ?");
    mysqli_stmt_bind_param($stmt, "s", $autor);
    mysqli_stmt_execute($stmt);
    echo "<h3>✓ Código seguro (consulta preparada)</h3>";
    echo "<p>Consulta que llega a MySQL: <code>SELECT * FROM libros WHERE autor = ?</code>
          y, por separado, el dato <code>" . htmlspecialchars($autor) . "</code></p>";
    mostrar_libros(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
}

mysqli_close($conexion);
?>
