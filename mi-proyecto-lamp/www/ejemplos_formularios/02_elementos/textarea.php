<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Elemento TEXTAREA</title>
  <style>
    body { font-family: sans-serif; margin: 30px; }
    .resultado { background: #e3f4ec; padding: 10px 15px; border-radius: 6px; margin-top: 20px; }
    .error { color: #d64550; font-size: 0.9em; }
  </style>
</head>
<body>
<h2>Elemento TEXTAREA</h2>
<form action="" method="POST">
  Comentario:<br>
  <textarea cols="50" rows="4" name="comentario">
Este libro me parece ...
</textarea><br>
  <input type="submit" value="Enviar">
</form>

<?php
// Procesamiento: solo si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<div class='resultado'>";
    $comentario = $_REQUEST['comentario'];
    print(nl2br(htmlspecialchars($comentario)));
    echo "</div>";
}
?>
</body>
</html>
