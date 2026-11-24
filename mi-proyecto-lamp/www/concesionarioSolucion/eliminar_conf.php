<?php
require __DIR__ . '/conexion.php';

$conexion = conectar();

// ---------- Paso 2: el usuario ha respondido (POST) ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matricula = $_POST['matricula'] ?? '';
    $tipo = 'ok';

    if (isset($_POST['confirmar'])) {
        $ok = mysqli_execute_query($conexion, 'DELETE FROM vehiculos WHERE matricula = ?', [$matricula]);

        if (!$ok) {
            $msg  = 'Error al eliminar: ' . mysqli_error($conexion);
            $tipo = 'error';
        } elseif (mysqli_affected_rows($conexion) > 0) {
            $msg = "Vehículo {$matricula} eliminado correctamente.";
        } else {
            $msg  = "No se encontró el vehículo {$matricula}.";
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

// ---------- Paso 1: pedir confirmación (GET) ----------
$matricula = $_GET['matricula'] ?? '';
$resultado = mysqli_execute_query($conexion,
    'SELECT matricula, marca, modelo, fecha, kms FROM vehiculos WHERE matricula = ?',
    [$matricula]
);
$vehiculo = $resultado ? mysqli_fetch_assoc($resultado) : null;
mysqli_close($conexion);

cabecera('Eliminar vehículo');

if (!$vehiculo) {
    mensaje('No existe ningún vehículo con esa matrícula.', 'error');
    echo '<a class="boton secundario" href="listar.php">← Volver al listado</a>';
    pie();
    exit;
}

mensaje('¿Seguro que quieres eliminar este vehículo? Esta acción no se puede deshacer.', 'error');
?>
<dl class="ficha">
    <dt>Matrícula</dt><dd><span class="matricula"><?= e($vehiculo['matricula']) ?></span></dd>
    <dt>Marca</dt>    <dd><?= e($vehiculo['marca']) ?></dd>
    <dt>Modelo</dt>   <dd><?= e($vehiculo['modelo']) ?></dd>
    <dt>Fecha</dt>    <dd><?= e(fecha_es($vehiculo['fecha'])) ?></dd>
    <dt>Kms</dt>      <dd><?= e(kms_es($vehiculo['kms'])) ?></dd>
</dl>
<form method="post" action="eliminar_conf.php" class="botones">
    <input type="hidden" name="matricula" value="<?= e($vehiculo['matricula']) ?>">
    <button type="submit" name="confirmar" class="peligro">🗑️ Sí, eliminar</button>
    <button type="submit" name="cancelar" class="secundario">No, volver</button>
</form>
<?php
pie();
