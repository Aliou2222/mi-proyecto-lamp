<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>GET y POST</title>
  <style>
    body { font-family: sans-serif; margin: 30px; }
    .resultado { background: #e3f4ec; padding: 10px 15px; border-radius: 6px; margin-top: 20px; }
    .error { color: #d64550; font-size: 0.9em; }
  </style>
</head>
<body>
<h2>GET y POST</h2>
<form action="get_post.php" method="GET">
  Edad (GET): <input type="text" name="edad">
  <input type="submit" value="Enviar por GET">
</form>
<br>
<form action="get_post.php" method="POST">
  Edad (POST): <input type="text" name="edad">
  <input type="submit" value="Enviar por POST">
</form>

<?php
// Observa la barra de direcciones tras enviar cada formulario
echo "<pre>";
echo "\$_GET:     "; print_r($_GET);
echo "\$_POST:    "; print_r($_POST);
echo "\$_REQUEST: "; print_r($_REQUEST);
echo "</pre>";
?>
</body>
</html>
