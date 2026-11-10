<?php
// Material: «Ejemplo: verificar versión de PHP y MySQL» (página 9 del PDF)
// Mostrar la versión de PHP instalada
echo "<h3>Información del servidor</h3>";
echo "Versión de PHP: " . phpversion() . "<br>";

// Los ejemplos están escritos para PHP 8.5 (el de Ubuntu 26.04 LTS)
if (PHP_VERSION_ID < 80500) {
    echo "<p style='color:orange'>Aviso: algunos ejemplos necesitan PHP 8.5</p>";
}

// Conectar para obtener versión de MySQL
$conexion = mysqli_connect("mysql", "biblioteca", "comomola");

if ($conexion) {
    // Obtener versión del servidor MySQL/MariaDB
    $version = mysqli_get_server_info($conexion);
    echo "Versión de MySQL/MariaDB: " . $version . "<br>";

    mysqli_close($conexion);
} else {
    echo "No se pudo conectar para verificar MySQL";
}
?>
