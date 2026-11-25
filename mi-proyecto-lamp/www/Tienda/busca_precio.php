<?php
require __DIR__ . '/conexion.php';

// Recoge los valores de la URL (GET) si ya se buscó algo, o los deja vacíos la primera vez
$min = $_GET['min'] ?? '';
$max = $_GET['max'] ?? '';
$errores = [];
// null significa que aún no se ha pulsado el botón Buscar (para no mostrar "0 resultados" nada más entrar)
$productos = null;

// Entra solo si el usuario pulsó el botón <button name="buscar">
if (isset($_GET['buscar'])) {
    // CAMBIAR EN EL EXAMEN: Usa FILTER_VALIDATE_INT si buscas enteros (ej. stock, años, kms)
    // o FILTER_VALIDATE_FLOAT si buscas decimales (ej. precios)
    $minFloat = filter_var($min, FILTER_VALIDATE_FLOAT);
    $maxFloat = filter_var($max, FILTER_VALIDATE_FLOAT);

    if ($minFloat === false || $maxFloat === false || $minFloat < 0 || $maxFloat < 0) {
        $errores[] = 'El precio mínimo y máximo deben ser números mayores o iguales que 0.';
    } elseif ($minFloat > $maxFloat) {
        $errores[] = 'El precio mínimo no puede ser mayor que el máximo.';
    } else {
        $conexion = conectar();
        // CAMBIAR EN EL EXAMEN: Columnas, tabla y columna del WHERE ... BETWEEN ? AND ?
        $resultado = mysqli_execute_query($conexion,
            'SELECT id, nombre, categoria, precio, stock, fecha_alta
               FROM productos
              WHERE precio BETWEEN ? AND ?
              ORDER BY precio',
            [$minFloat, $maxFloat]
        );

        if ($resultado === false) {
            $errores[] = 'Error en la consulta: ' . mysqli_error($conexion);
        } else {
            // Guarda todas las filas encontradas en el array $productos
            $productos = [];
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $productos[] = $fila;
            }
        }
        mysqli_close($conexion);
    }
}

cabecera('Buscar productos por precio');
?>
<!-- Formulario GET (los filtros de búsqueda siempre van por GET para poder compartir/recargar la URL) -->
<form class="busqueda" method="get" action="busca_precio.php">
    <label>Precio mínimo (€)
        <input type="number" name="min" min="0" step="0.01" required value="<?= e($min) ?>">
    </label>
    <label>Precio máximo (€)
        <input type="number" name="max" min="0" step="0.01" required value="<?= e($max) ?>">
    </label>
    <button type="submit" name="buscar" value="1">🔍 Buscar</button>
</form>
<?php
foreach ($errores as $error) {
    mensaje($error, 'error');
}

// Si $productos ya no es null, significa que se ejecutó una búsqueda válida
if ($productos !== null) {
    if (count($productos) === 0) {
        mensaje('No hay productos en ese rango de precios.', 'info');
    } else {
        mensaje(count($productos) . ' producto(s) entre ' . precio_es($minFloat) . ' y ' . precio_es($maxFloat) . '.', 'ok');

        // CAMBIAR EN EL EXAMEN: Tabla de resultados con las columnas de la nueva BD
        echo '<div class="tabla-scroll"><table>';
        echo '<thead><tr><th>ID</th><th>Nombre</th><th>Categoría</th><th>Precio</th><th>Stock</th><th>Fecha alta</th></tr></thead><tbody>';
        foreach ($productos as $fila) {
            echo '<tr>';
            echo '<td><span class="matricula">' . e($fila['id']) . '</span></td>';
            echo '<td>' . e($fila['nombre']) . '</td>';
            echo '<td>' . e($fila['categoria']) . '</td>';
            echo '<td class="numero">' . e(precio_es($fila['precio'])) . '</td>';
            echo '<td class="numero">' . e($fila['stock']) . ' uds.</td>';
            echo '<td>' . e(fecha_es($fila['fecha_alta'])) . '</td>';
            echo '</tr>';
        }
        echo '</tbody></table></div>';
    }
}

pie();