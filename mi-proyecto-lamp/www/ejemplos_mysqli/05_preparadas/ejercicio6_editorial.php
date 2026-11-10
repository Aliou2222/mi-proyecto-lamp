<?php // Material: «Solución del ejercicio 6: búsqueda por editorial» (página 42 del PDF) ?>
<!-- Formulario HTML -->
<form method="POST" action="">
 <h3>Buscar libros por editorial</h3>
 <label>Editorial: <input type="text" name="editorial" required></label>
 <button type="submit">Buscar</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conexion = mysqli_connect("mysql", "biblioteca", "comomola", "biblioteca");

    if (!$conexion) {
        die("Error de conexión");
    }

    // Validar entrada
    if (empty($_POST['editorial'])) {
        echo "<p style='color:red'>Por favor, introduce una editorial</p>";
        exit();
    }

    $editorial = $_POST['editorial'];

    // Preparar consulta
    $stmt = mysqli_prepare($conexion,
        "SELECT codigo, titulo, autor, precio FROM libros WHERE editorial = ?");

    mysqli_stmt_bind_param($stmt, "s", $editorial);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $codigo, $titulo, $autor, $precio);

    // Cambio respecto al material: htmlspecialchars() al mostrar lo que escribió el usuario
    echo "<h3>Resultados para la editorial: <b>" . htmlspecialchars($editorial) . "</b></h3>";

    $contador = 0;
    while (mysqli_stmt_fetch($stmt)) {
        $contador++;
        echo "<p>$contador. <b>$titulo</b> por $autor - $precio €</p>";
    }

    if ($contador == 0) {
        echo "<p>No se encontraron libros de esta editorial.</p>";
    } else {
        echo "<p>Total encontrados: $contador</p>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}
?>
