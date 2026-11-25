<?php
// Desactiva las excepciones automáticas de PHP 8.1+. Obligatorio según el enunciado:
// hace que las funciones de MySQLi devuelvan 'false' si fallan para controlar el error a mano con if.
mysqli_report(MYSQLI_REPORT_OFF);

// CAMBIAR EN EL EXAMEN: Datos de acceso a la base de datos que crees en phpMyAdmin.
const DB_HOST = 'mysql'; 
const DB_USER = 'tienda';
const DB_PASS = 'comomola';
const DB_NAME = 'tienda';

/** Abre la conexión con MySQL/MariaDB o detiene la página si hay fallo. */
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

/** Escapa cualquier texto antes de imprimirlo en HTML para evitar fallos de seguridad (XSS) o comillas rotas. */
function e($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

/** Pinta una caja de aviso en pantalla. $tipo puede ser 'ok' (verde), 'error' (rojo) o 'info' (azul). */
function mensaje($texto, $tipo = 'info')
{
    if (!in_array($tipo, ['ok', 'error', 'info'], true)) {
        $tipo = 'info';
    }
    echo '<div class="mensaje ' . $tipo . '">' . e($texto) . '</div>';
}

/** Convierte una fecha formato SQL (AAAA-MM-DD) a formato español (DD/MM/AAAA). */
function fecha_es($fecha)
{
    return date('d/m/Y', strtotime($fecha));
}

/** CAMBIAR/ADAPTAR EN EL EXAMEN: Formatea decimales con coma y símbolo €. Si el examen tiene kms, años, etc., adapta esta función. */
function precio_es($precio)
{
    return number_format((float) $precio, 2, ',', '.') . ' €';
}

/** Dibuja toda la parte superior de la web (HTML, CSS y menú) para no repetirlo en cada archivo. */
function cabecera($titulo)
{
    // basename($_SERVER['PHP_SELF']) saca el nombre del archivo actual (ej. 'listar.php') para marcarlo activo en el menú
    $actual = basename($_SERVER['PHP_SELF']);
    
    // CAMBIAR EN EL EXAMEN: Enlaces del menú superior ('nombre_archivo.php' => 'Texto visible')
    $menu = [
        'listar.php'       => 'Listado',
        'insertar.php'     => 'Nuevo producto',
        'busca_precio.php' => 'Buscar por precio',
    ];

    echo '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . e($titulo) . ' · Tienda</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<header>
    <div class="contenido">
        <div class="logo">🛒 Tienda Informática</div>
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