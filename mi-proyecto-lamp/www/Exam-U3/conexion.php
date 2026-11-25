<?php
mysqli_report(MYSQLI_REPORT_OFF);

const DB_HOST = 'mysql'; 
const DB_USER = 'formula1';
const DB_PASS = 'comomola';
const DB_NAME = 'formula1';

function conectar()
{
    $conexion = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if (!$conexion) {
        cabecera('Error de conexión');
        mensaje('No se pudo conectar con la base de datos: ' . mysqli_connect_error(), 'error');
        pie();
        exit;
    }

    mysqli_set_charset($conexion, 'utf8mb4');
    return $conexion;
}

function e($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

function mensaje($texto, $tipo = 'info')
{
    if (!in_array($tipo, ['ok', 'error', 'info'], true)) {
        $tipo = 'info';
    }
    echo '<div class="mensaje ' . $tipo . '">' . e($texto) . '</div>';
}

function fecha_es($fecha)
{
    return date('d/m/Y', strtotime($fecha));
}

function cabecera($titulo)
{
    $actual = basename($_SERVER['PHP_SELF']);
    
    $menu = [
        'listar.php'       => 'Listado',
        'insertar.php'     => 'Nuevo piloto',
        'update.php' => 'Modificacion',
    ];

    echo '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . e($titulo) . ' · Pilotos de formula1</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<header>
    <div class="contenido">
        <div class="logo">Pilotos de formula1</div>
        <nav>';

    foreach ($menu as $pagina => $texto) {
        $clase = $pagina === $actual ? ' class="activo"' : '';
        echo "<a href=\"{$pagina}\"{$clase}>{$texto}</a>";
    }

    echo '</nav>
    </div>
</header>
<main>
    <h1>' . e($titulo) . '</h1>
';
}

function pie()
{
    echo '</main>
<footer>Ejercicio PHP + MySQLi · Consultas preparadas con mysqli_execute_query()</footer>
</body>
</html>
';
}