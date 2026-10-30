<?php
$mysqli = new mysqli("mysql", getenv("MYSQL_USER") ?: "mi_usuario", getenv("MYSQL_PASSWORD") ?: "mi_password", getenv("MYSQL_DATABASE") ?: "mi_base");

if ($mysqli->connect_errno) {
    die("Fallo de conexión: " . $mysqli->connect_error);
}

echo "Conexión a MySQL correcta desde PHP.";
?>