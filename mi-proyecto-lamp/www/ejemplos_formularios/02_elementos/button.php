<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>INPUT TYPE: BUTTON</title>
  <style>
    body { font-family: sans-serif; margin: 30px; }
    .resultado { background: #e3f4ec; padding: 10px 15px; border-radius: 6px; margin-top: 20px; }
    .error { color: #d64550; font-size: 0.9em; }
  </style>
</head>
<body>
<h2>INPUT TYPE: BUTTON</h2>
<form action="" method="POST">
  <input type="button" name="actualizar"
         value="Actualizar datos (no envía)">
  <!-- ¡No envía el formulario! Se usa con JavaScript -->

  <!-- Si debe llegar a PHP, usa un botón de envío: -->
  <button type="submit" name="accion"
          value="actualizar">Actualizar datos</button>
  <button type="submit" name="accion"
          value="borrar">Borrar datos</button>
</form>

<?php
// Procesamiento: solo si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<div class='resultado'>";
    $accion = $_REQUEST['accion'] ?? '';
    if ($accion == "actualizar")
        print("Se han actualizado los datos");
    elseif ($accion == "borrar")
        print("Se han borrado los datos");
    echo "</div>";
}
?>
</body>
</html>
