<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>INPUT TYPE: HIDDEN</title>
  <style>
    body { font-family: sans-serif; margin: 30px; }
    .resultado { background: #e3f4ec; padding: 10px 15px; border-radius: 6px; margin-top: 20px; }
    .error { color: #d64550; font-size: 0.9em; }
  </style>
</head>
<body>
<h2>INPUT TYPE: HIDDEN</h2>
<form action="" method="POST">
<?php
  $usuario = "rafa";
  print("  <input type='hidden' name='username'
         value='$usuario'>\n");
?>
  <p>Hay un campo oculto: mira el código fuente con Ctrl + U.</p>
  <input type="submit" value="Enviar">
</form>

<?php
// Procesamiento: solo si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<div class='resultado'>";
    $username = $_REQUEST['username'];
    print(htmlspecialchars($username));    // rafa
    echo "</div>";
}
?>
</body>
</html>
