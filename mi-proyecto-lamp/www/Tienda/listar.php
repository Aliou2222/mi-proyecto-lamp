<?php
// Importa conexion.php para tener disponibles conectar(), cabecera(), pie(), e(), mensaje(), etc.
require __DIR__ . '/conexion.php';

$conexion = conectar();

// CAMBIAR EN EL EXAMEN: Nombre de las columnas, nombre de la tabla (productos) y columnas de ordenación (ORDER BY)
// Ejecuta consulta preparada sin parámetros
$resultado = mysqli_execute_query($conexion,
    'SELECT id, nombre, categoria, precio, stock, fecha_alta FROM productos ORDER BY categoria, nombre'
);

// CAMBIAR EN EL EXAMEN: Título principal H1 de la página
cabecera('Listado de productos');

// Si venimos redirigidos desde insertar, update o eliminar, $_GET['msg'] trae el aviso de éxito o error
if (isset($_GET['msg'])) {
    mensaje($_GET['msg'], $_GET['tipo'] ?? 'ok');
}

if ($resultado === false) {
    mensaje('Error en la consulta: ' . mysqli_error($conexion), 'error');
} elseif (mysqli_num_rows($resultado) === 0) {
    mensaje('No hay productos registrados en la tienda.', 'info');
} else {
    echo '<div class="tabla-scroll"><table>';
    // CAMBIAR EN EL EXAMEN: Nombres de las columnas en la cabecera de la tabla.
    // OJO: Pon tantos <th></th> vacíos al final como botones de acción tengas (aquí hay 2: Modificar y Eliminar)
    echo '<thead><tr><th>ID</th><th>Nombre</th><th>Categoría</th><th>Precio</th><th>Stock</th><th>Fecha alta</th><th></th><th></th></tr></thead>';
    echo '<tbody>';

    // mysqli_fetch_assoc() saca una fila en cada vuelta del bucle como un array asociativo ($fila['columna'])
    while ($fila = mysqli_fetch_assoc($resultado)) {
       // CAMBIAR EN EL EXAMEN: Cambia 'id' por la clave primaria de la tabla del examen.
        // urlencode() prepara el valor para viajar seguro dentro de la URL (?id=...)
    
        $idUrl = urlencode($fila['id']);

        echo '<tr>';
        // CAMBIAR EN EL EXAMEN: Pinta cada celda <td> con los nombres exactos de las columnas de tu SELECT
        echo '<td><span class="matricula">' . e($fila['id']) . '</span></td>';
        echo '<td>' . e($fila['nombre']) . '</td>';
        echo '<td>' . e($fila['categoria']) . '</td>';
        echo '<td class="numero">' . e(precio_es($fila['precio'])) . '</td>';
        echo '<td class="numero">' . e($fila['stock']) . ' uds.</td>';
        echo '<td>' . e(fecha_es($fila['fecha_alta'])) . '</td>';
        echo "<td class=\"acciones\"><a class=\"boton pequeno\" href=\"update.php?id={$idUrl}\">✏️ Modificar</a></td>";
        echo "<td class=\"acciones\"><a class=\"boton pequeno peligro\" href=\"eliminar_conf.php?id={$idUrl}\">🗑️ Eliminar</a></td>";
        echo '</tr>';
    }

    echo '</tbody></table></div>';
    echo '<p style="color:var(--texto-suave)">Total: ' . mysqli_num_rows($resultado) . ' producto(s)</p>';
}

mysqli_close($conexion);
pie();