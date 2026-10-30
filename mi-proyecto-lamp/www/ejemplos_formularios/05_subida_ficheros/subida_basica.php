<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Subida básica</title>
  <style>
    body { font-family: sans-serif; margin: 30px; }
    .resultado { background: #e3f4ec; padding: 10px 15px; border-radius: 6px; margin-top: 20px; }
    .error { color: #d64550; font-size: 0.9em; }
  </style>
</head>
<body>
<h2>Subida básica</h2>
<form action="" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
  Imagen: <input type="file" name="imagen">
  <input type="submit" name="subir" value="Subir">
</form>

<?php
if (isset($_POST['subir'])) {
    if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
        $nombreDirectorio = "img/";
        $idUnico = time();
        $nombreFichero = $idUnico . "-" . $_FILES['imagen']['name'];
        move_uploaded_file($_FILES['imagen']['tmp_name'],
                           $nombreDirectorio . $nombreFichero);
        print("Fichero guardado como: " . htmlspecialchars($nombreFichero));
    } else {
        print("No se ha podido subir el fichero\n");
    }
}
?>
</body>
</html>
