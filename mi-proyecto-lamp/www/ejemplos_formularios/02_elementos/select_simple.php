<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Elemento SELECT simple</title>
  <style>
    body { font-family: sans-serif; margin: 30px; }
    .resultado { background: #e3f4ec; padding: 10px 15px; border-radius: 6px; margin-top: 20px; }
    .error { color: #d64550; font-size: 0.9em; }
  </style>
</head>
<body>
<h2>Elemento SELECT simple</h2>
<form action="" method="POST">
  Color:
  <select name="color">
    <option value="rojo" selected>Rojo</option>
    <option value="verde">Verde</option>
    <option value="azul">Azul</option>
  </select>
  <input type="submit" value="Enviar">
</form>

<?php
// Procesamiento: solo si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<div class='resultado'>";
    $color = $_REQUEST['color'];
    print(htmlspecialchars($color));
    echo "</div>";
}
?>
</body>
</html>
