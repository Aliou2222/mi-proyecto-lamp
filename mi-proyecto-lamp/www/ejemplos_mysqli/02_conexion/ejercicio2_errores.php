<?php
// Material: «Solución del ejercicio 2: manejo de errores de conexión» (página 17 del PDF)
// Necesario en PHP 8.1+ para que mysqli_connect devuelva false en vez de lanzar una excepción
mysqli_report(MYSQLI_REPORT_OFF);

$servidor = "mysql";
$usuario = "biblioteca";
$password = "comomola";
$bd = "biblioteca_inexistente"; // Base de datos que NO existe

// Intentar conectar
$conexion = mysqli_connect($servidor, $usuario, $password, $bd);

// Verificar conexión
if (!$conexion) {
    // Obtener el código y mensaje de error
    $codigo_error = mysqli_connect_errno();
    $mensaje_error = mysqli_connect_error();

    // Mensaje genérico para el usuario
    echo "<h3 style='color:red'>La base de datos no está disponible. Por favor, contacta al administrador.</h3>";

    // Mensaje técnico (solo para desarrolladores)
    echo "<p><strong>Detalles técnicos:</strong><br>";
    echo "Código de error: " . $codigo_error . "<br>";
    echo "Mensaje: " . $mensaje_error . "</p>";

    // Salir del script para evitar más errores
    exit();
}

// Si la conexión es exitosa
echo "<h3 style='color:green'>Conexión establecida correctamente con la base de datos.</h3>";

// Cerrar conexión
mysqli_close($conexion);
?>
