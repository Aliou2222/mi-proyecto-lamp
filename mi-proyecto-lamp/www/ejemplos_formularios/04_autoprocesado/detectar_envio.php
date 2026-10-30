<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Detectar el envío del formulario</title>
  <style>
    body { font-family: sans-serif; margin: 30px; }
    .resultado { background: #e3f4ec; padding: 10px 15px; border-radius: 6px; margin-top: 20px; }
    .error { color: #d64550; font-size: 0.9em; }
  </style>
</head>
<body>
<h2>Detectar el envío del formulario</h2>
<form action="" method="POST">
  Nombre: <input type="text" name="nombre">
  <input type="submit" name="enviar" value="procesar">
  <input type="submit" name="enviar" value="cancelar">
</form>

<?php
// A) ¿Existe la variable del botón?
if (isset($_POST['enviar'])) {
    echo "<p>A) Se ha enviado el formulario.</p>";
}

// B) ¿El botón tiene ese valor? (útil con varios botones)
if (($_POST['enviar'] ?? '') == "procesar") {
    echo "<p>B) Se ha pulsado el botón «procesar».</p>";
}

// C) ¿Se pidió la página por POST?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<p>C) La página se ha pedido por POST.</p>";
} else {
    echo "<p>Primera carga (GET): todavía no se ha enviado nada.</p>";
}
?>
</body>
</html>
