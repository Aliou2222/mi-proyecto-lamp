<?php
mysqli_report(MYSQLI_REPORT_OFF);
// Material: «Solución del ejercicio 1: primera conexión» (página 11 del PDF)
// Ejercicio 1: Primera conexión
// Datos de conexión
$servidor = "mysql";
$usuario = "biblioteca";
$password = "comomola";
$basedatos = "biblioteca";

// Intentar conectar
$conexion = mysqli_connect($servidor, $usuario, $password, $basedatos);

// Verificar conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

echo "<h2>Conexión exitosa</h2>";
echo "<p>Conectado a la base de datos <b>$basedatos</b> en <b>$servidor</b></p>";

// Cerrar la conexión al finalizar
mysqli_close($conexion);
?>
