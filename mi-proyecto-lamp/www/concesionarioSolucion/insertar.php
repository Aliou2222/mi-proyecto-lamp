<?php
require __DIR__ . '/conexion.php'; //busca en el mismo directorio el archivo, y puede sacar informacion de ella

$errores = [];
$datos = ['matricula' => '', 'marca' => '', 'modelo' => '', 'fecha' => '', 'kms' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($datos as $campo => $valor) {
        $datos[$campo] = trim($_POST[$campo] ?? ''); // trim quita espacios por delante y por detras de los datos, y ?? si no hay dato pone '' y si hay, el valor
    }
    $datos['matricula'] = strtoupper($datos['matricula']); // strtoupper pasa a mayusculas lo que pongas en los []

    // Validaciones errores al poner o al haber errores en los datos en la parte del cliente/navegador
    if ($datos['matricula'] === '' || mb_strlen($datos['matricula']) > 10) {
        $errores[] = 'La matrícula es obligatoria (máx. 10 caracteres).';
    }
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
        $conexion = conectar();

        $ok = mysqli_execute_query($conexion,
            'INSERT INTO vehiculos (matricula, marca, modelo, fecha, kms) VALUES (?, ?, ?, ?, ?)',
            [$datos['matricula'], $datos['marca'], $datos['modelo'], $datos['fecha'], (int) $datos['kms']] //los datos en insert siguen el mismo orden al crear el array con los datos
        );                                                                                                 // (int), (float)... convertir el dato al tipo de valor que necesitas si viene en numero, los valores vienen en formato (string)

        if ($ok) {
            mysqli_close($conexion);
            header('Location: listar.php?msg=' . urlencode("Vehículo {$datos['matricula']} insertado correctamente.")); //header redirige a la pagina que le pongas y le envia un mensaje (msg) con los datos del coche insertado
            exit;
        }

        // 1062 = clave primaria duplicada
        $errores[] = mysqli_errno($conexion) === 1062
            ? 'Ya existe un vehículo con esa matrícula.'
            : 'Error al insertar: ' . mysqli_error($conexion);

        mysqli_close($conexion);
    }
}

cabecera('Nuevo vehículo');

foreach ($errores as $error) {
    mensaje($error, 'error');
}
?>
<form class="formulario" method="post" action="insertar.php">
    <label>Matrícula
        <input type="text" name="matricula" maxlength="10" required placeholder="1234ABC" value="<?= e($datos['matricula']) ?>">
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
        <button type="submit">💾 Guardar</button>
        <a class="boton secundario" href="listar.php">Cancelar</a>
    </div>
</form>
<?php
pie();
