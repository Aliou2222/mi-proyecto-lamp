<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Tipos y atributos de HTML5</title>
  <style>
    body { font-family: sans-serif; margin: 30px; }
    .resultado { background: #e3f4ec; padding: 10px 15px; border-radius: 6px; margin-top: 20px; }
    .error { color: #d64550; font-size: 0.9em; }
  </style>
</head>
<body>
<h2>Tipos y atributos de HTML5</h2>
<form action="" method="POST">
  Email: <input type="email" name="email" required
                placeholder="nombre@dominio.es"><br><br>
  Edad: <input type="number" name="edad" min="18" max="99"><br><br>
  Fecha: <input type="date" name="fecha"><br><br>
  Color: <input type="color" name="color" value="#777bb4"><br><br>
  Nivel: <input type="range" name="nivel" min="0" max="10"><br><br>
  Web: <input type="url" name="web"><br><br>
  <input type="submit" value="Enviar">
  <!-- Prueba a enviar con novalidate: el navegador ya no comprueba nada -->
</form>

<?php
// Procesamiento: solo si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<div class='resultado'>";
    echo "<pre>";
    print_r(array_map('htmlspecialchars', $_POST));
    echo "</pre>";
    echo "Recuerda: estos datos hay que validarlos también en PHP.";
    echo "</div>";
}
?>
</body>
</html>
