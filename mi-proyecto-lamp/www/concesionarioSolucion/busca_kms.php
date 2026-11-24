<?php
require __DIR__ . '/conexion.php';

$min = $_GET['min'] ?? '';
$max = $_GET['max'] ?? '';
$errores = [];
$vehiculos = null;   // null = todavía no se ha buscado

if (isset($_GET['buscar'])) {
    $opciones = ['options' => ['min_range' => 0]];
    $minInt = filter_var($min, FILTER_VALIDATE_INT, $opciones);
    $maxInt = filter_var($max, FILTER_VALIDATE_INT, $opciones);

    if ($minInt === false || $maxInt === false) {
        $errores[] = 'El mínimo y el máximo deben ser enteros mayores o iguales que 0.';
    } elseif ($minInt > $maxInt) {
        $errores[] = 'El mínimo no puede ser mayor que el máximo.';
    } else {
        $conexion = conectar();
        $resultado = mysqli_execute_query($conexion,
            'SELECT matricula, marca, modelo, fecha, kms
               FROM vehiculos
              WHERE kms BETWEEN ? AND ?
              ORDER BY kms',
            [$minInt, $maxInt]
        );

        if ($resultado === false) {
            $errores[] = 'Error en la consulta: ' . mysqli_error($conexion);
        } else {
            $vehiculos = [];
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $vehiculos[] = $fila;
            }
        }
        mysqli_close($conexion);
    }
}

cabecera('Buscar vehículos por kilómetros');
?>
<form class="busqueda" method="get" action="busca_kms.php">
    <label>Kms mínimo
        <input type="number" name="min" min="0" step="1" required value="<?= e($min) ?>">
    </label>
    <label>Kms máximo
        <input type="number" name="max" min="0" step="1" required value="<?= e($max) ?>">
    </label>
    <button type="submit" name="buscar" value="1">🔍 Buscar</button>
</form>
<?php
foreach ($errores as $error) {
    mensaje($error, 'error');
}

if ($vehiculos !== null) {
    if (count($vehiculos) === 0) {
        mensaje('No hay vehículos en ese rango de kilómetros.', 'info');
    } else {
        mensaje(count($vehiculos) . ' vehículo(s) entre ' . kms_es($minInt) . ' y ' . kms_es($maxInt) . '.', 'ok');

        echo '<div class="tabla-scroll"><table>';
        echo '<thead><tr><th>Matrícula</th><th>Marca</th><th>Modelo</th><th>Fecha</th><th>Kms</th></tr></thead><tbody>';
        foreach ($vehiculos as $fila) {
            echo '<tr>';
            echo '<td><span class="matricula">' . e($fila['matricula']) . '</span></td>';
            echo '<td>' . e($fila['marca']) . '</td>';
            echo '<td>' . e($fila['modelo']) . '</td>';
            echo '<td>' . e(fecha_es($fila['fecha'])) . '</td>';
            echo '<td class="numero">' . e(kms_es($fila['kms'])) . '</td>';
            echo '</tr>';
        }
        echo '</tbody></table></div>';
    }
}

pie();
