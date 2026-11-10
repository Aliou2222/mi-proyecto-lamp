<?php
// Material: «Ejemplo: conexión con verificación y cierre» (página 15 del PDF)
// En PHP 8.1+ mysqli lanza excepciones; para que funcione el if (!$conexion)
// del material desactivamos ese comportamiento:
mysqli_report(MYSQLI_REPORT_OFF);

// Configuración de conexión
$servidor = "mysql";
$usuario = "biblioteca";
$password = "comomola";
$bd = "biblioteca";

echo "<h3>Proceso de conexión a MySQL</h3>";

// Intentar conectar
echo "<p>1. Intentando conectar al servidor $servidor...</p>";
$conexion = mysqli_connect($servidor, $usuario, $password, $bd);

// Verificar conexión
if (!$conexion) {
    // Mensaje genérico para el usuario
    echo "<h3 style='color:red'>Error al conectar con la base de datos. Por favor, inténtalo más tarde.</h3>";
} else {
    // Si la conexión es exitosa
    echo "<h3 style='color:green'>Conexión establecida correctamente con la base de datos.</h3>";
    // Cerrar conexión (cambio respecto al material: solo si se abrió;
    // mysqli_close(false) produce un error en PHP 8)
    mysqli_close($conexion);
}
?>
