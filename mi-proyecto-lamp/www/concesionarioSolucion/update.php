<?php
require __DIR__ . '/conexion.php';

$conexion = conectar();
$errores  = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ---------- Guardar cambios ----------
    $datos = [
        'matricula' => trim($_POST['matricula'] ?? ''),
        'marca'     => trim($_POST['marca'] ?? ''),
        'modelo'    => trim($_POST['modelo'] ?? ''),
        'fecha'     => trim($_POST['fecha'] ?? ''),
        'kms'       => trim($_POST['kms'] ?? ''),
    ];

    //validaciones
    if ($datos['marca'] === '' || mb_strlen($datos['marca']) > 30) {
        $errores[] = 'La marca es obligatoria (máx. 30 caracteres).';
    }
    if ($datos['modelo'] === '' || mb_strlen($datos['modelo']) > 50) {
        $errores[] = 'El modelo es obligatorio (máx. 50 caracteres).';
    }
    $f = date_create_from_format('Y-m-d', $datos['fecha']);
    if (!$f || date_format($f, 'Y-m-d') !== $datos['fecha']) {
        $errores[] = 'La fecha no es válida.';
    }
    if (filter_var($datos['kms'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) === false) {
        $errores[] = 'Los kilómetros deben ser un entero mayor o igual que 0.';
    }

    if (!$errores) {
        $ok = mysqli_execute_query($conexion,
            'UPDATE vehiculos SET marca = ?, modelo = ?, fecha = ?, kms = ? WHERE matricula = ?',
            [$datos['marca'], $datos['modelo'], $datos['fecha'], (int) $datos['kms'], $datos['matricula']]
        );

        if ($ok) {
            mysqli_close($conexion);
            header('Location: listar.php?msg=' . urlencode("Vehículo {$datos['matricula']} actualizado correctamente."));
            exit;
        }
        $errores[] = 'Error al actualizar: ' . mysqli_error($conexion);
    }
} else {
    // ---------- Cargar datos actuales ----------
    $matricula = $_GET['matricula'] ?? '';
    $resultado = mysqli_execute_query($conexion,
        'SELECT matricula, marca, modelo, fecha, kms FROM vehiculos WHERE matricula = ?',
        [$matricula]
    );
    $datos = $resultado ? mysqli_fetch_assoc($resultado) : null;

    if (!$datos) {
        mysqli_close($conexion);
        cabecera('Modificar vehículo');
        mensaje('No existe ningún vehículo con esa matrícula.', 'error');
        echo '<a class="boton secundario" href="listar.php">← Volver al listado</a>';
        pie();
        exit;
    }
}

mysqli_close($conexion);
cabecera('Modificar vehículo ' . $datos['matricula']);

foreach ($errores as $error) {
    mensaje($error, 'error');
}
?>
<form class="formulario" method="post" action="update.php">
    <label>Matrícula (no editable)
        <input type="text" name="matricula" readonly value="<?= e($datos['matricula']) ?>">
    </label>
    <label>Marca
        <input type="text" name="marca" maxlength="30" required value="<?= e($datos['marca']) ?>">
    </label>
    <label>Modelo
        <input type="text" name="modelo" maxlength="50" required value="<?= e($datos['modelo']) ?>">
    </label>
    <label>Fecha
        <input type="date" name="fecha" required value="<?= e($datos['fecha']) ?>">
    </label>
    <label>Kms
        <input type="number" name="kms" min="0" step="1" required value="<?= e($datos['kms']) ?>">
    </label>
    <div class="botones">
        <button type="submit">💾 Guardar cambios</button>
        <a class="boton secundario" href="listar.php">Cancelar</a>
    </div>
</form>
<?php
pie();
