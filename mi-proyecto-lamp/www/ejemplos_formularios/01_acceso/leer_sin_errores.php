<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Leer datos sin errores</title>
  <style>
    body { font-family: sans-serif; margin: 30px; }
    .resultado { background: #e3f4ec; padding: 10px 15px; border-radius: 6px; margin-top: 20px; }
    .error { color: #d64550; font-size: 0.9em; }
  </style>
</head>
<body>
<h2>Leer datos sin errores</h2>
<form action="" method="POST">
  Edad: <input type="text" name="edad">
  <input type="submit" value="Enviar">
</form>

<?php
// Abre esta página sin enviar: no aparece ningún aviso

// 1) isset(): ¿existe la clave?
if (isset($_POST['edad'])) {
    $edad = $_POST['edad'];
} else {
    $edad = "";
}

// 2) ?? : valor por defecto (PHP 7+)
$edad2 = $_POST['edad'] ?? '';

// 3) empty(): ¿está vacío?  ¡Ojo! empty("0") es true
if (empty($_POST['edad'])) {
    echo "<p>Falta la edad</p>";
} else {
    echo "<p>Edad recibida: " . htmlspecialchars($edad2) . "</p>";
}
?>
</body>
</html>
