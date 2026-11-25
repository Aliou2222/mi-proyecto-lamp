<?php
require __DIR__ . '/conexion.php';

$conexion = conectar();


$resultado = mysqli_execute_query($conexion,
    'SELECT codigo, nombre, fecha_nacimiento, escuderia, victorias FROM pilotos ORDER BY escuderia, nombre'
);

cabecera('Listado de pilotos');

if (isset($_GET['msg'])) {
    mensaje($_GET['msg'], $_GET['tipo'] ?? 'ok');
}

if ($resultado === false) {
    mensaje('Error en la consulta: ' . mysqli_error($conexion), 'error');
} elseif (mysqli_num_rows($resultado) === 0) {
    mensaje('No hay pilotos en la lista.', 'info');
} else {
    echo '<div class="tabla-scroll"><table>';

    echo '<thead><tr><th>Codigo</th><th>Nombre</th><th>Fecha_nacimiento</th><th>escuderia</th><th>Victorias</th><th></th><th></th></tr></thead>';
    echo '<tbody>';

    while ($fila = mysqli_fetch_assoc($resultado)) {
       
    
        $idUrl = urlencode($fila['codigo']);

        echo '<tr>';
        echo '<td><span class="codigo">' . e($fila['codigo']) . '</span></td>';
        echo '<td>' . e($fila['nombre']) . '</td>';
        echo '<td>' . e(fecha_es($fila['fecha_nacimiento'])) . '</td>';
        echo '<td>' . e($fila['escuderia']) . '</td>';
        echo '<td class="numero">' . e($fila['victorias']) . ' VICTORY/s</td>';
        echo "<td class=\"acciones\"><a class=\"boton pequeno\" href=\"update.php?id={$idUrl}\">✏️ Modificar</a></td>";
        echo "<td class=\"acciones\"><a class=\"boton pequeno peligro\" href=\"eliminar_conf.php?id={$idUrl}\">🗑️ Eliminar</a></td>";
        echo '</tr>';
    }

    echo '</tbody></table></div>';
    echo '<p style="color:var(--texto-suave)">Total: ' . mysqli_num_rows($resultado) . ' producto(s)</p>';
}

mysqli_close($conexion);
pie();