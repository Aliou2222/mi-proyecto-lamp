<?php
require __DIR__ . '/conexion.php';

$conexion = conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $POST['codigo'] ?? '';
    $tipo = 'ok';

    if (isset($_POST['confirmar'])) {
        $ok = mysqli_execute_query($conexion, 'DELETE FROM pilotos WHERE codigo= ?', [$codigo]);

        if (!$ok) {
            $msg  = 'Error al eliminar: ' . mysqli_error($conexion);
            $tipo = 'error';
        } elseif (mysqli_affected_rows($conexion) > 0) {
            $msg = "Piloto #{$codigo} eliminado correctamente.";
        } else {
            $msg  = "No se encontró el piloto #{$codigo}.";
            $tipo = 'error';
        }
    } else {
        $msg  = 'Eliminación cancelada.';
        $tipo = 'info';
    }

    mysqli_close($conexion);
    header('Location: listar.php?msg=' . urlencode($msg) . '&tipo=' . $tipo);
    exit;
}


$codigo = $_GET['codigo'] ?? '';
$resultado = mysqli_execute_query($conexion,
    'SELECT codigo, nombre, fecha_nacimiento, escuderia, victorias FROM pilotos WHERE codigo = ?',
    [$codigo]
);
$producto = $resultado ? mysqli_fetch_assoc($resultado) : null;
mysqli_close($conexion);

cabecera('Eliminar piloto');

if (!$producto) {
    mensaje('No existe ningún piloto con ese codigo.', 'error');
    echo '<a class="boton secundario" href="listar.php">← Volver al listado</a>';
    pie();
    exit;
}

mensaje('¿Seguro que quieres eliminar este piloto? Esta acción no se puede deshacer.', 'error');
?>
<dl class="ficha">
    <dt>codigo</dt>         <dd><span class="codigo"><?= e($producto['codigo']) ?></span></dd>
    <dt>Nombre</dt>     <dd><?= e($producto['nombre']) ?></dd>
    <dt>Fecha nacimiento</dt> <dd><?= e(fecha_es($producto['fecha_nacimiento'])) ?></dd>
    <dt>escuderia</dt>  <dd><?= e($producto['escuderia']) ?></dd>
    <dt>victorias</dt>      <dd><?= e($producto['victorias']) ?> V.</dd>
</dl>

<form method="get" action="eliminar_conf.php" class="botones">
    <input type="hidden" name="codigo" value="<?= e($producto['codigo']) ?>">
    <button type="submit" name="confirmar" class="peligro">🗑️ Sí, eliminar</button>
    <button type="submit" name="cancelar" class="secundario">No, volver</button>
</form>
<?php
pie();