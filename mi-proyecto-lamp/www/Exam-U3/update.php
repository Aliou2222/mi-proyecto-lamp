<?php
require __DIR__ . '/conexion.php';

$conexion = conectar();
$errores  = [];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // ---------- Guardar cambios ----------
    $datos = [
        'codigo' => trim($_POST['codigo'] ?? ''),
        'nombre'     => trim($_POST['nombre'] ?? ''),
        'fecha_nacimiento'    => trim($POST['fecha_nacimiento'] ?? ''),
        'escuderia'     => trim($_POST['escuderia'] ?? ''),
        'victorias'       => trim($_POST['victorias'] ?? ''),
    ];

    //validaciones
    if ($datos['nombre'] === '' || mb_strlen($datos['nombre']) > 60) {
        $errores[] = 'El nombre es obligatoria (máx. 30 caracteres).';
    }
    $f = date_create_from_format('Y-m-d', $datos['fecha_nacimiento']);
    if (!$f || date_format($f, 'Y-m-d') !== $datos['fecha_nacimiento']) {
        $errores[] = 'La fecha no es válida.';
    }
    if ($datos['escuderia'] === '' || mb_strlen($datos['escuderia']) > 50) {
        $errores[] = 'La escuderia es obligatorio (máx. 40 caracteres).';
    }
     if (filter_var($datos['victorias'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) === false) {
        $errores[] = 'Las victorias deben ser un entero mayor o igual que 0.';
    }

    if (!$errores) {
        $ok = mysqli_execute_query($conexion,
            'UPDATE pilotos SET nombre = ?, fecha_nacimiento = ?, escuderia = ?, victorias = ? WHERE codigo = ?',
            [$datos['nombre'], $datos['fecha_nacimiento'], $datos['escuderia'], (int) $datos['victorias'], $datos['codigo']]
        );

        if ($ok) {
            mysqli_close($conexion);
            header('Location: listar.php?msg=' . urlencode("Piloto {$datos['codigo']} actualizado correctamente."));
            exit;
        }
        $errores[] = 'Error al actualizar: ' . mysqli_error($conexion);
    }
}  else {
    // ---------- Cargar datos actuales ----------
    $codigo = $_GET['codigo'] ?? '';
    $resultado = mysqli_execute_query($conexion,
        'SELECT codigo, nombre, fecha_nacimiento, escuderia, victorias FROM pilotos WHERE codigo = ?',
        [$codigo]
    );
    $datos = $resultado ? mysqli_fetch_assoc($resultado) : null;

    if (!$datos) {
        mysqli_close($conexion);
        cabecera('Modificar piloto');
        mensaje('No existe ningún piloto con ese codigo.', 'error');
        echo '<a class="boton secundario" href="listar.php">← Volver al listado</a>';
        pie();
        exit;
    }
}

mysqli_close($conexion);
cabecera('Modificar piloto ' . $datos['codigo']);

foreach ($errores as $error) {
    mensaje($error, 'error');
}
?>
<form class="formulario" method="get" action="update.php">
    <label>codigo
        <input type="text" name="codigo" maxlength="3" required placeholder="ABC" value="<?= e($datos['codigo']) ?>">
    </label>
    <label>nombre
        <input type="text" name="nombre" maxlength="60" required value="<?= e($datos['nombre']) ?>">
    </label>
    <label>fecha_nacimiento
        <input type="date" name="fecha_nacimiento" required value="<?= e($datos['fecha_nacimiento']) ?>">
    </label>
    <label>escuderia
        <input type="text" name="escuderia" maxlength="40" required value="<?= e($datos['escuderia']) ?>">
    </label>
    <label>victorias
        <input type="number" name="victorias" min="0" step="1" required value="<?= e($datos['victorias']) ?>">
    </label>
    <div class="botones">
        <button type="submit">💾 Guardar</button>
        <a class="boton secundario" href="listar.php">Cancelar</a>
    </div>
</form>
<?php
pie();
