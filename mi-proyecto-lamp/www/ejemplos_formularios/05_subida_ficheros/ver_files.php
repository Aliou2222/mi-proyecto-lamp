<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Contenido de $_FILES</title>
  <style>
    body { font-family: sans-serif; margin: 30px; }
    .resultado { background: #e3f4ec; padding: 10px 15px; border-radius: 6px; margin-top: 20px; }
    .error { color: #d64550; font-size: 0.9em; }
  </style>
</head>
<body>
<h2>Contenido de $_FILES</h2>
<form action="" method="POST" enctype="multipart/form-data">
  <input type="file" name="fichero">
  <input type="submit" value="Subir">
</form>

<?php
echo "<pre>";
print_r($_FILES);
echo "</pre>";
?>
</body>
</html>
