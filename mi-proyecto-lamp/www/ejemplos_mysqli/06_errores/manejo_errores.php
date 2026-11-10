<?php
// Material: «Ejemplo: manejo completo de errores» (página 63 del PDF)
// Configurar para mostrar todos los errores en desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Necesario en PHP 8.1+ para trabajar con los valores devueltos (false)
// en lugar de excepciones. Ver excepciones_try_catch.php para la forma moderna.
mysqli_report(MYSQLI_REPORT_OFF);

$servidor = "mysql";
$usuario = "biblioteca";
$password = "comomola";
$bd = "biblioteca";

// 1. Error de conexión
$conexion = mysqli_connect($servidor, $usuario, $password, $bd);

if (!$conexion) {
    $codigo = mysqli_connect_errno();
    $mensaje = mysqli_connect_error();

    // Registrar en archivo de log
    error_log("Error MySQL [$codigo]: $mensaje");

    // Mensaje para el usuario
    die("<h3>No se puede conectar a la base de datos</h3>
         <p>Por favor, inténtalo más tarde.</p>");
}

// 2. Error en consulta normal
$consulta = "SELECT * FROM libross"; // Tabla mal escrita
$resultado = mysqli_query($conexion, $consulta);

if (!$resultado) {
    $codigo = mysqli_errno($conexion);
    $mensaje = mysqli_error($conexion);

    echo "<h3>Error en la consulta</h3>";
    echo "<p>Código: $codigo</p>";
    echo "<p>Mensaje: $mensaje</p>";

    // Registrar para desarrollo
    error_log("Error SQL [$codigo]: $mensaje - Consulta: $consulta");
}

// 3. Error en prepared statement
// (cambio respecto al material: no se sale en el paso 2, para ver también este error)
$stmt = mysqli_prepare($conexion, "INSERT INTO libros (columnainexistente) VALUES (?)");

if (!$stmt) {
    echo "<p>Error al preparar: " . mysqli_error($conexion) . "</p>";
    mysqli_close($conexion);
    exit();
}

$valor = "prueba";   // cambio: en el material $valor no estaba definida
mysqli_stmt_bind_param($stmt, "s", $valor);

if (!mysqli_stmt_execute($stmt)) {
    echo "<p>Error al ejecutar: " . mysqli_stmt_error($stmt) . "</p>";
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
    exit();
}

mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>
