<?php
require __DIR__ . '/conexion.php';

$conexion = conectar();

// Consulta preparada (sin parámetros, pero con mysqli_execute_query igualmente)
$resultado = mysqli_execute_query($conexion,
    'SELECT matricula, marca, modelo, fecha, kms FROM vehiculos ORDER BY marca, modelo'
);

cabecera('Listado de vehículos'); //cambia el titulo de la pagina (es una funcion en conexion.php)

if (isset($_GET['msg'])) {
    mensaje($_GET['msg'], $_GET['tipo'] ?? 'ok');
}

if ($resultado === false) {
    mensaje('Error en la consulta: ' . mysqli_error($conexion), 'error');
} elseif (mysqli_num_rows($resultado) === 0) {
    mensaje('No hay vehículos registrados.', 'info');
} else {
    echo '<div class="tabla-scroll"><table>';
    echo '<thead><tr><th>Matrícula</th><th>Marca</th><th>Modelo</th><th>Fecha</th><th>Kms</th><th></th><th></th></tr></thead>';
    echo '<tbody>';

    while ($fila = mysqli_fetch_assoc($resultado)) {
        $mat = urlencode($fila['matricula']);

        echo '<tr>';
        echo '<td><span class="matricula">' . e($fila['matricula']) . '</span></td>';
        echo '<td>' . e($fila['marca']) . '</td>';
        echo '<td>' . e($fila['modelo']) . '</td>';
        echo '<td>' . e(fecha_es($fila['fecha'])) . '</td>';
        echo '<td class="numero">' . e(kms_es($fila['kms'])) . '</td>';
        echo "<td class=\"acciones\"><a class=\"boton pequeno\" href=\"update.php?matricula={$mat}\">✏️ Modificar</a></td>";
        echo "<td class=\"acciones\"><a class=\"boton pequeno peligro\" href=\"eliminar_conf.php?matricula={$mat}\">🗑️ Eliminar</a></td>";
        echo '</tr>';
    }

    echo '</tbody></table></div>';
    echo '<p style="color:var(--texto-suave)">Total: ' . mysqli_num_rows($resultado) . ' vehículo(s)</p>';
}

mysqli_close($conexion);
pie();
