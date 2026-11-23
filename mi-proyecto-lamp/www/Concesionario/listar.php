<?php
require_once "conexion.php";
$con = conectar();

$sql = "SELECT * FROM vehiculos";
$res = mysqli_execute_query($con, $sql, []);

if ($res === false) {
    die("Error en la consulta: " . mysqli_error($con));
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Vehículos</title>
</head>
<body>
    <h1>Listado de Vehículos</h1>
    <p>
        <a href="insertar.php">Añadir vehículo</a> | 
        <a href="busca_kms.php">Buscar por kilómetros</a>
    </p>

    <table border="1" cellpadding="5">
        <tr>
            <th>Matrícula</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Fecha</th>
            <th>Kms</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
        <?php while ($fila = mysqli_fetch_assoc($res)): ?>
        <tr>
            <td><?php echo htmlspecialchars($fila['matricula']); ?></td>
            <td><?php echo htmlspecialchars($fila['marca']); ?></td>
            <td><?php echo htmlspecialchars($fila['modelo']); ?></td>
            <td><?php echo htmlspecialchars($fila['fecha']); ?></td>
            <td><?php echo htmlspecialchars($fila['kms']); ?></td>
            <td><a href="update.php?matricula=<?php echo urlencode($fila['matricula']); ?>">Editar</a></td>
            <td><a href="eliminar_conf.php?matricula=<?php echo urlencode($fila['matricula']); ?>">Eliminar</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
<?php
mysqli_close($con);
?>