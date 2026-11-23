<?php
require_once "conexion.php";
$con = conectar();

$mensaje = "";
$vehiculo = null;

// 1. Si pulsan "Guardar cambios" (POST), actualizamos la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricula = $_POST["matricula"];
    $marca     = trim($_POST["marca"]);
    $modelo    = trim($_POST["modelo"]);
    $fecha     = $_POST["fecha"];
    $kms       = $_POST["kms"];

    $sql = "UPDATE vehiculos SET marca = ?, modelo = ?, fecha = ?, kms = ? WHERE matricula = ?";
    $res = mysqli_execute_query($con, $sql, [$marca, $modelo, $fecha, $kms, $matricula]);

    if ($res === false) {
        $mensaje = "Error al actualizar: " . mysqli_error($con);
    } else {
        $mensaje = "Vehículo actualizado correctamente (filas modificadas: " . mysqli_affected_rows($con) . ").";
    }
}

// 2. Cargamos los datos del vehículo (tanto al entrar por GET como tras guardar por POST)
$matricula_buscar = $_POST["matricula"] ?? $_GET["matricula"] ?? "";

if ($matricula_buscar != "") {
    $sql = "SELECT * FROM vehiculos WHERE matricula = ?";
    $res = mysqli_execute_query($con, $sql, [$matricula_buscar]);

    if ($res !== false && mysqli_num_rows($res) > 0) {
        $vehiculo = mysqli_fetch_assoc($res);
    } else {
        $mensaje = "No se ha encontrado el vehículo.";
    }
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Vehículo</title>
</head>
<body>
    <h1>Modificar Vehículo</h1>
    <p><a href="listar.php">Volver al listado</a></p>

    <?php if ($mensaje != ""): ?>
        <p><strong><?php echo htmlspecialchars($mensaje); ?></strong></p>
    <?php endif; ?>

    <?php if ($vehiculo != null): ?>
    <form method="POST" action="update.php">
        <p>Matrícula: <input type="text" name="matricula" value="<?php echo htmlspecialchars($vehiculo['matricula']); ?>" readonly></p>
        <p>Marca: <input type="text" name="marca" value="<?php echo htmlspecialchars($vehiculo['marca']); ?>" required></p>
        <p>Modelo: <input type="text" name="modelo" value="<?php echo htmlspecialchars($vehiculo['modelo']); ?>" required></p>
        <p>Fecha: <input type="date" name="fecha" value="<?php echo htmlspecialchars($vehiculo['fecha']); ?>" required></p>
        <p>Kilómetros: <input type="number" name="kms" value="<?php echo htmlspecialchars($vehiculo['kms']); ?>" min="0" required></p>
        <p><button type="submit">Guardar cambios</button></p>
    </form>
    <?php endif; ?>
</body>
</html>