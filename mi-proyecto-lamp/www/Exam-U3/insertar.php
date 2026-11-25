<?php
require __DIR__ . '/conexion.php';

$errores = [];
$datos = ['codigo' => '', 'nombre' => '', 'fecha_nacimiento' => '', 'escuderia' => '', 'victorias' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($datos as $campo => $valor) {
        $datos[$campo] = trim($_POST[$campo] ?? ''); 
    }
    $datos['codigo'] = strtoupper($datos['codigo']); 

  
    if ($datos['codigo'] === '' || mb_strlen($datos['codigo']) > 3) {
        $errores[] = 'El codigo es obligatoria (máx. 3 caracteres).';
    }
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
        $conexion = conectar();

        $ok = mysqli_execute_query($conexion,
            'INSERT INTO pilotos (codigo, nombre, fecha_nacimiento, escuderia, victorias) VALUES (?, ?, ?, ?, ?)',
            [$datos['codigo'], $datos['nombre'], $datos['fecha_nacimiento'], $datos['escuderia'], (int) $datos['victorias']] 
        );                                                                                                 

        if ($ok) {
            mysqli_close($conexion);
            header('Location: listar.php?msg=' . urlencode("Piloto {$datos['codigo']} insertado correctamente.")); 
            exit;
        }

        $errores[] = mysqli_errno($conexion) === 1062
            ? 'Ya existe un piloto con ese codigo.'
            : 'Error al insertar: ' . mysqli_error($conexion);

        mysqli_close($conexion);
    }
}

cabecera('Nuevo piloto');

foreach ($errores as $error) {
    mensaje($error, 'error');
}
?>
<form class="formulario" method="post" action="insertar.php">
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
