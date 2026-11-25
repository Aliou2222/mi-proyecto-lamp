<?php
require __DIR__ . '/conexion.php';

$conexion = conectar();
$errores  = [];

// RAMA 1 (POST): El usuario ya editó los campos y pulsó "Guardar cambios"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CAMBIAR EN EL EXAMEN: Recoge todos los campos del formulario, INCLUIDA la clave primaria (que viene en readonly)
    $datos = [
        'id'         => trim($_POST['id'] ?? ''),
        'nombre'     => trim($_POST['nombre'] ?? ''),
        'categoria'  => trim($_POST['categoria'] ?? ''),
        'precio'     => trim($_POST['precio'] ?? ''),
        'stock'      => trim($_POST['stock'] ?? ''),
        'fecha_alta' => trim($_POST['fecha_alta'] ?? ''),
    ];

    // Mismas validaciones que en insertar.php
    if ($datos['nombre'] === '' || mb_strlen($datos['nombre']) > 45) {
        $errores[] = 'El nombre es obligatorio (máx. 45 caracteres).';
    }
    if ($datos['categoria'] === '' || mb_strlen($datos['categoria']) > 25) {
        $errores[] = 'La categoría es obligatoria (máx. 25 caracteres).';
    }
    $precioFloat = filter_var($datos['precio'], FILTER_VALIDATE_FLOAT);
    if ($precioFloat === false || $precioFloat < 0 || $precioFloat > 9999.99) {
        $errores[] = 'El precio debe ser un número válido entre 0 y 9999.99.';
    }
    if (filter_var($datos['stock'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) === false) {
        $errores[] = 'El stock debe ser un entero mayor o igual que 0.';
    }
    $f = date_create_from_format('Y-m-d', $datos['fecha_alta']);
    if (!$f || date_format($f, 'Y-m-d') !== $datos['fecha_alta']) {
        $errores[] = 'La fecha de alta no es válida.';
    }

    if (!$errores) {
        // CAMBIAR EN EL EXAMEN: Consulta UPDATE.
        // ¡OJO AL ORDEN! Primero van las columnas del SET y AL FINAL va la clave primaria del WHERE.
        $ok = mysqli_execute_query($conexion,
            'UPDATE productos SET nombre = ?, categoria = ?, precio = ?, stock = ?, fecha_alta = ? WHERE id = ?',
            [$datos['nombre'], $datos['categoria'], (float) $datos['precio'], (int) $datos['stock'], $datos['fecha_alta'], (int) $datos['id']]
        );

        if ($ok) {
            mysqli_close($conexion);
            header('Location: listar.php?msg=' . urlencode("Producto #{$datos['id']} actualizado correctamente."));
            exit;
        }
        $errores[] = 'Error al actualizar: ' . mysqli_error($conexion);
    }
} else {
    // RAMA 2 (GET): Acabamos de entrar desde listar.php (?id=...). Hay que buscar el registro para rellenar el formulario.
    // CAMBIAR EN EL EXAMEN: Nombre del parámetro GET de la clave primaria
    $id = $_GET['id'] ?? '';
    $resultado = mysqli_execute_query($conexion,
        'SELECT id, nombre, categoria, precio, stock, fecha_alta FROM productos WHERE id = ?',
        [$id]
    );
    // Saca el único registro encontrado (sin bucle while porque buscamos por clave primaria)
    $datos = $resultado ? mysqli_fetch_assoc($resultado) : null;

    // Si alguien puso un ID inventado en la URL, avisa y corta
    if (!$datos) {
        mysqli_close($conexion);
        cabecera('Modificar producto');
        mensaje('No existe ningún producto con ese ID.', 'error');
        echo '<a class="boton secundario" href="listar.php">← Volver al listado</a>';
        pie();
        exit;
    }
}

mysqli_close($conexion);
cabecera('Modificar producto #' . $datos['id']);

foreach ($errores as $error) {
    mensaje($error, 'error');
}
?>
<!-- CAMBIAR EN EL EXAMEN: Formulario precargado con los datos actuales ($datos['...']).
     La clave primaria lleva 'readonly' para que se vea pero no se pueda alterar. -->
<form class="formulario" method="post" action="update.php">
    <label>ID (no editable)
        <input type="text" name="id" readonly value="<?= e($datos['id']) ?>">
    </label>
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
        <button type="submit">💾 Guardar cambios</button>
        <a class="boton secundario" href="listar.php">Cancelar</a>
    </div>
</form>
<?php
pie();