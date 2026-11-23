<?php
require_once "conexion.php";

$resultados = null;
$mensaje = "";
$min = "";
$max = "";

if (isset($_GET["min"]) && isset($_GET["max"])) {
    $min = $_GET["min"];
    $max = $_GET["max"];

    if ($min === "" || $max === "") {
        $mensaje = "Debes rellenar ambos campos.";
    } elseif ($min > $max) {
        $mensaje = "El mínimo no puede ser mayor que el máximo.";
    } else {
        $con = conectar();
        $sql = "SELECT * FROM vehiculos WHERE kms BETWEEN ? AND ?";
        $resultados = mysqli_execute_query($con, $sql, [$min, $max]);

        if ($resultados === false) {
            $mensaje = "Error en la búsqueda: " . mysqli_error($con);
        }
        mysqli_close($con);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar por Kilómetros</title>
</head>
<body>
    <h1>Buscar Vehículos por Kilómetros</h1>
    <p><a href="listar.php">Volver al listado</a></p>

    <form method="GET" action="busca_kms.php">
        <p>Kms mínimo: <input type="number" name="min" value="<?php echo htmlspecialchars($min); ?>" min="0" required></p>
        <p>Kms máximo: <input type="number" name="max" value="<?php echo htmlspecialchars($max); ?>" min="0" required></p>
        <p><button type="submit">Buscar</button></p>
    </form>

    <?php if ($mensaje != ""): ?>
        <p><strong><?php echo htmlspecialchars($mensaje); ?></strong></p>
    <?php endif; ?>

    <?php if ($resultados !== null && $resultados !== false): ?>
        <h2>Resultados (<?php echo mysqli_num_rows($resultados); ?> encontrados)</h2>
        
        <?php if (mysqli_num_rows($resultados) > 0): ?>
            <table border="1" cellpadding="5">
                <tr>
                    <th>Matrícula</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Fecha</th>
                    <th>Kms</th>
                </tr>
                <?php while ($fila = mysqli_fetch_assoc($resultados)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($fila['matricula']); ?></td>
                    <td><?php echo htmlspecialchars($fila['marca']); ?></td>
                    <td><?php echo htmlspecialchars($fila['modelo']); ?></td>
                    <td><?php echo htmlspecialchars($fila['fecha']); ?></td>
                    <td><?php echo htmlspecialchars($fila['kms']); ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No hay vehículos en ese rango de kilómetros.</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>