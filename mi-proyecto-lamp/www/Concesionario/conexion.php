<?php
mysqli_report(MYSQLI_REPORT_OFF);

function conectar() {
    $host = "mysql";
    $user = "root";
    $pass = "root_seguro";
    $bd   = "concesionario";

    $con = @mysqli_connect($host, $user, $pass, $bd);

    if ($con === false) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }  

    mysqli_set_charset($con, "utf8mb4");
    return $con;
}

if (basename($_SERVER['PHP_SELF']) == 'conexion.php') {
    $prueba = conectar();
    echo "¡Conexión exitosa!";
    mysqli_close($prueba);
}
?>