<?php
require_once "conexion.php";

$mensaje = "";

// Si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricula = trim($_POST["matricula"]);
    $marca     = trim($_POST["marca"]);
    $modelo    = trim($_POST["modelo"]);
    $fecha     = $_POST["fecha"];
    $kms       = $_POST["kms"];

    // Validación básica: comprobar que no hay campos vacíos y kms >= 0
    if ($matricula == "" || $marca == "" || $modelo == "" || $fecha == "" || $kms === "") {
        $mensaje = "Error: Todos los campos son obligatorios.";
    } elseif ($kms < 0) {
        $mensaje = "Error: Los kilómetros no pueden ser negativos.";
    } else {
        $con = conectar();
        $sql = "INSERT INTO vehiculos (matricula, marca, modelo, fecha, kms) VALUES (?, ?, ?, ?, ?)";
        $res = mysqli_execute_query($con, $sql, [$matricula, $marca, $modelo, $fecha, $kms]);

        if ($res === false) {
            // El código 1062 significa clave primaria duplicada (matrícula repetida)
            if (mysqli_errno($con) == 1062) {
                $mensaje = "Error: Ya existe un vehículo con la matrícula $matricula.";
            } else {
                $mensaje = "Error al insertar: " . mysqli_error($con);
            }
        } else {
            $mensaje = "Vehículo insertado correctamente.";
        }
        mysqli_close($con);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Insertar Vehículo</title>
</head>
<body>
    <h1>Nuevo Vehículo</h1>
    <p><a href="listar.php">Volver al listado</a></p>

    <?php if ($mensaje != ""): ?>
        <p><strong><?php echo htmlspecialchars($mensaje); ?></strong></p>
    <?php endif; ?>

    <form method="POST" action="insertar.php">
        <p>Matrícula: <input type="text" name="matricula" maxlength="10" required></p>
        <p>Marca: <input type="text" name="marca" maxlength="30" required></p>
        <p>Modelo: <input type="text" name="modelo" maxlength="50" required></p>
        <p>Fecha: <input type="date" name="fecha" required></p>
        <p>Kilómetros: <input type="number" name="kms" min="0" required></p>
        <p><button type="submit">Guardar</button></p>
    </form>
</body>
</html>