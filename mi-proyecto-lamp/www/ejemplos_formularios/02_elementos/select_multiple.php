<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Elemento SELECT múltiple</title>
  <style>
    body { font-family: sans-serif; margin: 30px; }
    .resultado { background: #e3f4ec; padding: 10px 15px; border-radius: 6px; margin-top: 20px; }
    .error { color: #d64550; font-size: 0.9em; }
  </style>
</head>
<body>
<h2>Elemento SELECT múltiple</h2>
<form action="" method="POST">
  Idiomas:
  <select multiple size="3" name="idiomas[]">
    <option value="ingles" selected>Inglés</option>
    <option value="frances">Francés</option>
    <option value="aleman">Alemán</option>
    <option value="holandes">Holandés</option>
  </select>
  <input type="submit" value="Enviar">
</form>

<?php
// Procesamiento: solo si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<div class='resultado'>";
    $idiomas = $_REQUEST['idiomas'] ?? [];
    foreach ($idiomas as $idioma)
        print(htmlspecialchars($idioma) . "<br>\n");
    echo "</div>";
}
?>
</body>
</html>
