<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Saludo</title></head>
<body>
<?php
if (isset($_POST['enviar'])) {
    // 2ª carga: procesar formulario
    $nombre = htmlspecialchars($_POST['nombre'] ?? '');
    $edad   = (int) ($_POST['edad'] ?? 0);
    echo "<p>Hola, $nombre. Tienes $edad años.</p>";
    echo "<a href='saludo.php'>Volver</a>";
} else {
    // 1ª carga: mostrar formulario
?>
    <form action="saludo.php" method="POST">
      Nombre: <input type="text" name="nombre"><br>
      Edad: <input type="number" name="edad"><br>
      <input type="submit" name="enviar" value="procesar">
    </form>
<?php
}
?>
</body>
</html>
