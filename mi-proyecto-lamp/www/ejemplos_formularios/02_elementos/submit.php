<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>INPUT TYPE: SUBMIT</title>
  <style>
    body { font-family: sans-serif; margin: 30px; }
    .resultado { background: #e3f4ec; padding: 10px 15px; border-radius: 6px; margin-top: 20px; }
    .error { color: #d64550; font-size: 0.9em; }
  </style>
</head>
<body>
<h2>INPUT TYPE: SUBMIT</h2>
<form action="" method="POST">
  <input type="submit" name="enviar"
         value="Enviar datos">
</form>

<?php
// Procesamiento: solo si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<div class='resultado'>";
    if (isset($_REQUEST['enviar']))
        print("Se ha pulsado el botón de enviar");
    echo "</div>";
}
?>
</body>
</html>
