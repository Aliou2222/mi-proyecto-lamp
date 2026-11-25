<?php
require __DIR__ . '/conexion.php';

$conexion = conectar();

// PASO 2 (POST): El usuario ya vio la ficha y pulsó "Sí, eliminar" o "No, volver"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CAMBIAR EN EL EXAMEN: Clave primaria recibida desde el <input type="hidden">
    $id = $_POST['id'] ?? '';
    $tipo = 'ok';

    // Solo borra si pulsó el botón con name="confirmar"
    if (isset($_POST['confirmar'])) {
        // CAMBIAR EN EL EXAMEN: Tabla y clave primaria del DELETE
        $ok = mysqli_execute_query($conexion, 'DELETE FROM productos WHERE id = ?', [$id]);

        if (!$ok) {
            $msg  = 'Error al eliminar: ' . mysqli_error($conexion);
            $tipo = 'error';
        // mysqli_affected_rows() comprueba si realmente se borró alguna fila (mayor que 0)
        } elseif (mysqli_affected_rows($conexion) > 0) {
            $msg = "Producto #{$id} eliminado correctamente.";
        } else {
            $msg  = "No se encontró el producto #{$id}.";
            $tipo = 'error';
        }
    } else {
        // Si pulsó "No, volver", no toca la base de datos
        $msg  = 'Eliminación cancelada.';
        $tipo = 'info';
    }

    mysqli_close($conexion);
    // Vuelve siempre al listado mostrando el resultado en la barra superior
    header('Location: listar.php?msg=' . urlencode($msg) . '&tipo=' . $tipo);
    exit;
}

// PASO 1 (GET): Acabamos de entrar desde listar.php (?id=...). Buscamos el registro para enseñarlo antes de borrar.
$id = $_GET['id'] ?? '';
$resultado = mysqli_execute_query($conexion,
    'SELECT id, nombre, categoria, precio, stock, fecha_alta FROM productos WHERE id = ?',
    [$id]
);
$producto = $resultado ? mysqli_fetch_assoc($resultado) : null;
mysqli_close($conexion);

cabecera('Eliminar producto');

if (!$producto) {
    mensaje('No existe ningún producto con ese ID.', 'error');
    echo '<a class="boton secundario" href="listar.php">← Volver al listado</a>';
    pie();
    exit;
}

mensaje('¿Seguro que quieres eliminar este producto? Esta acción no se puede deshacer.', 'error');
?>
<!-- CAMBIAR EN EL EXAMEN: Lista de definición (<dl>) que muestra los datos del registro a eliminar -->
<dl class="ficha">
    <dt>ID</dt>         <dd><span class="matricula"><?= e($producto['id']) ?></span></dd>
    <dt>Nombre</dt>     <dd><?= e($producto['nombre']) ?></dd>
    <dt>Categoría</dt>  <dd><?= e($producto['categoria']) ?></dd>
    <dt>Precio</dt>     <dd><?= e(precio_es($producto['precio'])) ?></dd>
    <dt>Stock</dt>      <dd><?= e($producto['stock']) ?> uds.</dd>
    <dt>Fecha alta</dt> <dd><?= e(fecha_es($producto['fecha_alta'])) ?></dd>
</dl>

<!-- Formulario POST que envía oculta la clave primaria al pulsar cualquiera de los dos botones -->
<form method="post" action="eliminar_conf.php" class="botones">
    <input type="hidden" name="id" value="<?= e($producto['id']) ?>">
    <button type="submit" name="confirmar" class="peligro">🗑️ Sí, eliminar</button>
    <button type="submit" name="cancelar" class="secundario">No, volver</button>
</form>
<?php
pie();