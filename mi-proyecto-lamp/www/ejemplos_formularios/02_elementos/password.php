<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>INPUT TYPE: PASSWORD</title>
  <style>
    body { font-family: sans-serif; margin: 30px; }
    .resultado { background: #e3f4ec; padding: 10px 15px; border-radius: 6px; margin-top: 20px; }
    .error { color: #d64550; font-size: 0.9em; }
  </style>
</head>
<body>
<h2>INPUT TYPE: PASSWORD</h2>
<form action="" method="POST">
  Contraseña:
  <input type="password" name="clave">
  <input type="submit" value="Enviar">
</form>

<?php
// Procesamiento: solo si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<div class='resultado'>";
    $clave = $_REQUEST['clave'];
    // Solo didáctico: en una aplicación real NUNCA se muestra la contraseña
    print(htmlspecialchars($clave));
    echo "</div>";
}
?>
</body>
</html>
