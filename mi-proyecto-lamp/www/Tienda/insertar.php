<?php
require __DIR__ . '/conexion.php';

$errores = [];
// CAMBIAR EN EL EXAMEN: Array inicial vacío con todos los campos que el usuario rellenará en el formulario.
// REGLA: Si la clave primaria es AUTO_INCREMENT (como 'id'), NO se pone aquí. Si es manual (como 'matricula' o 'dni'), SÍ se pone.
$datos = ['nombre' => '', 'categoria' => '', 'precio' => '', 'stock' => '', 'fecha_alta' => ''];

// Solo entra aquí cuando el usuario pulsa el botón "Guardar" (envío por POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoge cada dato de $_POST, le quita espacios sobrantes con trim() y evita errores si falta algún campo con ?? ''
    foreach ($datos as $campo => $valor) {
        $datos[$campo] = trim($_POST[$campo] ?? '');
    }

    // CAMBIAR EN EL EXAMEN: Validaciones según el tipo y tamaño (VARCHAR) de cada columna en el .sql
    if ($datos['nombre'] === '' || mb_strlen($datos['nombre']) > 45) {
        $errores[] = 'El nombre es obligatorio (máx. 45 caracteres).';
    }
    if ($datos['categoria'] === '' || mb_strlen($datos['categoria']) > 25) {
        $errores[] = 'La categoría es obligatoria (máx. 25 caracteres).';
    }
    // Valida número decimal (FLOAT)
    $precioFloat = filter_var($datos['precio'], FILTER_VALIDATE_FLOAT);
    if ($precioFloat === false || $precioFloat < 0 || $precioFloat > 9999.99) {
        $errores[] = 'El precio debe ser un número válido entre 0 y 9999.99.';
    }
    // Valida número entero (INT) mayor o igual que 0
    if (filter_var($datos['stock'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) === false) {
        $errores[] = 'El stock debe ser un entero mayor o igual que 0.';
    }
    // Valida que la fecha tenga formato real AAAA-MM-DD
    $f = date_create_from_format('Y-m-d', $datos['fecha_alta']);
    if (!$f || date_format($f, 'Y-m-d') !== $datos['fecha_alta']) {
        $errores[] = 'La fecha de alta no es válida.';
    }

    // Si el array $errores está vacío, procedemos a guardar en la base de datos
    if (!$errores) {
        $conexion = conectar();

        // CAMBIAR EN EL EXAMEN: Consulta INSERT con tantos '?' como columnas pongas entre paréntesis.
        // En el array de abajo, pon los valores en el MISMO orden exacto que los '?' y conviértelos con (float) o (int) si son números.
        $ok = mysqli_execute_query($conexion,
            'INSERT INTO productos (nombre, categoria, precio, stock, fecha_alta) VALUES (?, ?, ?, ?, ?)',
            [$datos['nombre'], $datos['categoria'], (float) $datos['precio'], (int) $datos['stock'], $datos['fecha_alta']]
        );

        // Si $ok es true, redirige a listar.php con un mensaje verde y corta el script con exit (Patrón PRG)
        if ($ok) {
            mysqli_close($conexion);
            header('Location: listar.php?msg=' . urlencode("Producto '{$datos['nombre']}' insertado correctamente."));
            exit;
        }

        // Si falla el INSERT (por ejemplo, código 1062 = clave primaria manual duplicada), guarda el error
        $errores[] = mysqli_errno($conexion) === 1062
            ? 'Ya existe un registro con esa clave.'
            : 'Error al insertar: ' . mysqli_error($conexion);
        mysqli_close($conexion);
    }
}

cabecera('Nuevo producto');

// Si hubo errores de validación o de BD, los pinta en cajas rojas encima del formulario
foreach ($errores as $error) {
    mensaje($error, 'error');
}
?>
<!-- CAMBIAR EN EL EXAMEN: Inputs del formulario. El atributo name="..." debe coincidir con las claves de $datos.
     value="<?= e(...) ?>" mantiene lo que escribió el usuario si hubo algún error al validar. -->
<form class="formulario" method="post" action="insertar.php">
    <label>Nombre
        <input type="text" name="nombre" maxlength="45" required value="<?= e($datos['nombre']) ?>">
    </label>
    <label>Categoría
        <input type="text" name="categoria" maxlength="25" required value="<?= e($datos['categoria']) ?>">
    </label>
    <label>Precio (€)
        <input type="number" name="precio" min="0" max="9999.99" step="0.01" required value="<?= e($datos['precio']) ?>">
    </label>
    <label>Stock
        <input type="number" name="stock" min="0" step="1" required value="<?= e($datos['stock']) ?>">
    </label>
    <label>Fecha de alta
        <input type="date" name="fecha_alta" required value="<?= e($datos['fecha_alta']) ?>">
    </label>
    <div class="botones">
        <button type="submit">💾 Guardar</button>
        <a class="boton secundario" href="listar.php">Cancelar</a>
    </div>
</form>
<?php
pie();