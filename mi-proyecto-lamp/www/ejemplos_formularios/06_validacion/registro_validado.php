<?php
$errores = [];
$nombre = $email = $edad = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre'] ?? '');
    $email  = trim($_POST['email'] ?? '');
    $edad   = trim($_POST['edad'] ?? '');

    if ($nombre === "")
        $errores['nombre'] = "El nombre es obligatorio";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $errores['email'] = "El email no es válido";
    if (filter_var($edad, FILTER_VALIDATE_INT,
            ["options" => ["min_range" => 18, "max_range" => 99]]) === false)
        $errores['edad'] = "La edad debe estar entre 18 y 99";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro validado</title>
  <style>
    body { font-family: sans-serif; margin: 30px; }
    .error { color: #d64550; font-size: 0.9em; }
  </style>
</head>
<body>
<h2>Registro</h2>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errores)) {
    // c) Sin errores: procesar formulario
    echo "<p>Registro correcto. ¡Bienvenido, "
         . htmlspecialchars($nombre) . "!</p>";
    echo "<a href=''>Volver</a>";
} else {
    // a) Primera carga  o  b) con errores: mostrar formulario
?>
<form action="" method="POST">
  Nombre:
  <input type="text" name="nombre"
         value="<?= htmlspecialchars($nombre) ?>">
  <span class="error"><?= $errores['nombre'] ?? '' ?></span><br><br>

  Email:
  <input type="text" name="email"
         value="<?= htmlspecialchars($email) ?>">
  <span class="error"><?= $errores['email'] ?? '' ?></span><br><br>

  Edad:
  <input type="text" name="edad"
         value="<?= htmlspecialchars($edad) ?>">
  <span class="error"><?= $errores['edad'] ?? '' ?></span><br><br>

  <input type="submit" value="Registrarse">
</form>
<?php
}
?>
</body>
</html>
