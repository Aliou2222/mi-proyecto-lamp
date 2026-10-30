<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>INPUT TYPE: FILE</title>
  <style>
    body { font-family: sans-serif; margin: 30px; }
    .resultado { background: #e3f4ec; padding: 10px 15px; border-radius: 6px; margin-top: 20px; }
    .error { color: #d64550; font-size: 0.9em; }
  </style>
</head>
<body>
<h2>INPUT TYPE: FILE</h2>
<!-- Es fundamental incluir enctype="multipart/form-data" -->
<form action="../05_subida_ficheros/ver_files.php" method="post"
      enctype="multipart/form-data">
  <input type="file" name="fichero">
  <input type="submit" value="Subir">
</form>
<p>Este formulario envía el fichero a 05_subida_ficheros/ver_files.php, que muestra el contenido de $_FILES.</p>
</body>
</html>
