<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Demostración XSS</title>
  <style>
    body { font-family: sans-serif; margin: 30px; }
    .resultado { background: #e3f4ec; padding: 10px 15px; border-radius: 6px; margin-top: 20px; }
    .error { color: #d64550; font-size: 0.9em; }
  </style>
</head>
<body>
<h2>Demostración XSS</h2>
<p>Escribe en el nombre: <code>&lt;script&gt;alert('¡Hackeado!')&lt;/script&gt;</code></p>
<form action="" method="POST">
  Nombre: <input type="text" name="nombre" size="50">
  <button type="submit" name="modo" value="inseguro">Mostrar SIN htmlspecialchars</button>
  <button type="submit" name="modo" value="seguro">Mostrar CON htmlspecialchars</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? '';
    if (($_POST['modo'] ?? '') == "inseguro") {
        // ✗ INSEGURO: el navegador ejecuta lo que escriba el usuario
        echo "Hola, " . $nombre;
    } else {
        // ✓ SEGURO: los caracteres especiales se convierten en texto
        echo "Hola, " . htmlspecialchars($nombre);
    }
}
?>
</body>
</html>
