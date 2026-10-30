<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>INPUT TYPE: RADIO</title>
  <style>
    body { font-family: sans-serif; margin: 30px; }
    .resultado { background: #e3f4ec; padding: 10px 15px; border-radius: 6px; margin-top: 20px; }
    .error { color: #d64550; font-size: 0.9em; }
  </style>
</head>
<body>
<h2>INPUT TYPE: RADIO</h2>
<form action="" method="POST">
  Sexo:
  <input type="radio" name="sexo"
         value="M" checked> Mujer
  <input type="radio" name="sexo"
         value="H"> Hombre
  <input type="submit" value="Enviar">
</form>

<?php
// Procesamiento: solo si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<div class='resultado'>";
    $sexo = $_REQUEST['sexo'];
    print($sexo);    // M o H
    echo "</div>";
}
?>
</body>
</html>
