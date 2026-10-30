<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>INPUT TYPE: CHECKBOX</title>
  <style>
    body { font-family: sans-serif; margin: 30px; }
    .resultado { background: #e3f4ec; padding: 10px 15px; border-radius: 6px; margin-top: 20px; }
    .error { color: #d64550; font-size: 0.9em; }
  </style>
</head>
<body>
<h2>INPUT TYPE: CHECKBOX</h2>
<form action="" method="POST">
  <input type="checkbox" name="extras[]"
         value="garaje" checked> Garaje
  <input type="checkbox" name="extras[]"
         value="piscina"> Piscina
  <input type="checkbox" name="extras[]"
         value="jardin"> Jardín
  <input type="submit" value="Enviar">
</form>

<?php
// Procesamiento: solo si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<div class='resultado'>";
    $extras = $_REQUEST['extras'] ?? [];   // sin marcar no llega nada
    foreach ($extras as $extra)
        print("$extra<br>\n");
    echo "</div>";
}
?>
</body>
</html>
