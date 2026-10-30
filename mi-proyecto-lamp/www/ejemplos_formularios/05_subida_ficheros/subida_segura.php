<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Subida segura de imágenes</title>
  <style>
    body { font-family: sans-serif; margin: 30px; }
    .resultado { background: #e3f4ec; padding: 10px 15px; border-radius: 6px; margin-top: 20px; }
    .error { color: #d64550; font-size: 0.9em; }
  </style>
</head>
<body>
<h2>Subida segura de imágenes</h2>
<form action="" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
  Imagen: <input type="file" name="imagen">
  <input type="submit" name="subir" value="Subir">
</form>

<?php
$errores = [];
$permitidos = ["jpg", "jpeg", "png", "gif"];
$maxBytes = 2 * 1024 * 1024;   // 2 MB

if (isset($_POST['subir'])) {
    $f = $_FILES['imagen'];
    if ($f['error'] !== UPLOAD_ERR_OK) {
        $errores[] = "Error al subir (código {$f['error']})";
    } else {
        $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $permitidos))
            $errores[] = "Solo se admiten imágenes JPG, PNG o GIF";
        if ($f['size'] > $maxBytes)
            $errores[] = "La imagen supera los 2 MB";
    }
    if (empty($errores)) {
        $nuevo = uniqid() . "." . $ext;
        if (move_uploaded_file($f['tmp_name'], "img/" . $nuevo))
            echo "Subida: <img src='img/$nuevo' width='150'>";
        else
            echo "<p class='error'>No se pudo guardar. ¿Existe la carpeta img/ y puede escribir en ella el usuario www-data?</p>";
    } else {
        foreach ($errores as $e)
            echo "<p class='error'>$e</p>";
    }
}
?>
</body>
</html>
