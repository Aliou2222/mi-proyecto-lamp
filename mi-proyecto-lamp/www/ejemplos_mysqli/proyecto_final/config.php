<?php
// Credenciales de conexión centralizadas
// En producción, este archivo debería estar fuera de /var/www/html.
define("DB_HOST", "mysql");
define("DB_USER", "biblioteca");
define("DB_PASS", "comomola");
define("DB_NAME", "biblioteca");

function conectar(): mysqli {
    try {
        $conexion = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        mysqli_set_charset($conexion, "utf8mb4");
        return $conexion;
    } catch (mysqli_sql_exception $e) {
        error_log("Error de conexión [" . $e->getCode() . "]: " . $e->getMessage());
        die("<p class='error'>No se puede conectar a la base de datos. Inténtalo más tarde.</p>");
    }
}

// Manejo de errores robusto: cualquier excepción que no se capture (por ejemplo,
// un fallo de MariaDB a mitad de una consulta) se registra en el log y el usuario
// ve un mensaje genérico en lugar de los detalles técnicos.
set_exception_handler(function (Throwable $e): void {
    error_log("Error no capturado [" . $e->getCode() . "]: " . $e->getMessage());
    http_response_code(500);
    echo "<p class='error'>Se ha producido un error. Inténtalo más tarde.</p>";
});

// Escapar texto para mostrarlo en HTML
function e(?string $texto): string {
    return htmlspecialchars($texto ?? '', ENT_QUOTES, 'UTF-8');
}

function cabecera(string $titulo): void {
    echo "<!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'>";
    echo "<title>" . e($titulo) . " · Biblioteca</title>";
    echo "<link rel='stylesheet' href='estilos.css'></head><body>";
    echo "<nav><a href='index.php'>Inicio</a><a href='listar.php'>Listado</a>";
    echo "<a href='buscar.php'>Buscar</a><a href='insertar.php'>Añadir libro</a>";
    echo "<a href='actualizar.php'>Actualizar</a></nav>";
    echo "<h1>" . e($titulo) . "</h1>";
}

function pie(): void {
    echo "</body></html>";
}

// Valida los datos de un libro. Devuelve un array de errores (vacío si todo es correcto).
function validar_libro(string $titulo, string $autor, string $editorial, string $precio): array {
    $errores = [];
    if ($titulo === "") $errores[] = "El título es obligatorio";
    elseif (mb_strlen($titulo) > 40) $errores[] = "El título no puede superar 40 caracteres";
    if ($autor === "") $errores[] = "El autor es obligatorio";
    elseif (mb_strlen($autor) > 30) $errores[] = "El autor no puede superar 30 caracteres";
    if ($editorial === "") $errores[] = "La editorial es obligatoria";
    elseif (mb_strlen($editorial) > 20) $errores[] = "La editorial no puede superar 20 caracteres";
    if (!is_numeric($precio)) $errores[] = "El precio debe ser un número";
    elseif ($precio < 0) $errores[] = "El precio no puede ser negativo";
    elseif ($precio > 999.99) $errores[] = "El precio máximo es 999.99 €";
    return $errores;
}
