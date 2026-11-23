<?php
require_once "conexion.php";
$con = conectar();

$mensaje = "";
$vehiculo = null;

// Si pulsan "Sí, eliminar" (POST), borramos el registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricula = $_POST["matricula"];

    $sql = "DELETE FROM vehiculos WHERE matricula = ?";
    $res = mysqli_execute_query($con, $sql, [$matricula]);

    if ($res === false) {
        $mensaje = "Error al borrar: " . mysqli_error($con);
    } else {
        mysqli_close($con);
        // Redirigimos al listado tras borrar
        header("Location: listar.php");
        exit;
    }
} else {
    // Si entramos por enlace (GET), buscamos el coche para pedir confirmación
    $matricula = $_GET["matricula"] ?? "";

    if ($matricula != "") {
        $sql = "SELECT * FROM vehiculos WHERE matricula = ?";
        $res = mysqli_execute_query($con, $sql, [$matricula]);

        if ($res !== false && mysqli_num_rows($res) > 0) {
            $vehiculo = mysqli_fetch_assoc($res);
        } else {
            $mensaje = "No se ha encontrado el vehículo.";
        }
    } else {
        $mensaje = "Falta la matrícula.";
    }
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Vehículo</title>
</head>
<body>
    <h1>Confirmar Eliminación</h1>
    <p><a href="listar.php">Volver al listado</a></p>

    <?php if ($mensaje != ""): ?>
        <p><strong><?php echo htmlspecialchars($mensaje); ?></strong></p>
    <?php endif; ?>

    <?php if ($vehiculo != null): ?>
        <p>¿Seguro que quieres borrar este vehículo?</p>
        <ul>
            <li><strong>Matrícula:</strong> <?php echo htmlspecialchars($vehiculo['matricula']); ?></li>
            <li><strong>Marca:</strong> <?php echo htmlspecialchars($vehiculo['marca']); ?></li>
            <li><strong>Modelo:</strong> <?php echo htmlspecialchars($vehiculo['modelo']); ?></li>
            <li><strong>Fecha:</strong> <?php echo htmlspecialchars($vehiculo['fecha']); ?></li>
            <li><strong>Kms:</strong> <?php echo htmlspecialchars($vehiculo['kms']); ?></li>
        </ul>

        <form method="POST" action="eliminar_conf.php">
            <input type="hidden" name="matricula" value="<?php echo htmlspecialchars($vehiculo['matricula']); ?>">
            <button type="submit">Sí, eliminar</button>
            <a href="listar.php">Cancelar</a>
        </form>
    <?php endif; ?>
</body>
</html>