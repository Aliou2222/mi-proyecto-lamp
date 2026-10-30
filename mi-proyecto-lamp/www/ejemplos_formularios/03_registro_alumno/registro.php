<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro Alumno</title>
  <style>
    table {
      border-collapse: collapse;
      width: 60%;
      margin: 30px auto;
      background: #f5f5f5;
    }
    th, td {
      border: 1px solid #999;
      padding: 10px;
      text-align: left;
    }
    th {
      background: #4CAF50;
      color: white;
    }
    tr:nth-child(even) {background-color: #fafafa;}
  </style>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre      = htmlspecialchars($_POST['nombre'] ?? '');
    $apellidos   = htmlspecialchars($_POST['apellidos'] ?? '');
    $curso       = $_POST['curso'] ?? [];
    $curso_str = implode(', ', array_map('htmlspecialchars', $cursos));

    
    $clave       = htmlspecialchars($_POST['clave'] ?? '');
    $sexo        = htmlspecialchars($_POST['sexo'] ?? '');
    $idiomas     = $_POST['idiomas'] ?? [];
    $idiomas_str = implode(', ', array_map('htmlspecialchars', $idiomas));
    $comentarios = nl2br(htmlspecialchars($_POST['comentarios'] ?? ''));
    $telefono = nl2br(htmlspecialchars($_POST['telefono'] ?? ''));

    echo "<h2>Datos Recibidos del Alumno</h2>";
    echo "<table>
      <tr><th>Nombre</th><td>$nombre</td></tr>
      <tr><th>Apellidos</th><td>$apellidos</td></tr>
      <tr><th>Curso académico</th><td>$curso_str</td></tr>
      <tr><th>Contraseña</th><td>$clave</td></tr>
      <tr><th>Sexo</th><td>$sexo</td></tr>
      <tr><th>Idiomas</th><td>$idiomas_str</td></tr>
      <tr><th>Comentarios</th><td>$comentarios</td></tr>
      <tr><th>Teléfono</th><td>$telefono</td></tr>

    </table>";
    // Mostrar la contraseña es solo didáctico: nunca se hace en una aplicación real
} else {
    echo "<p>No se han enviado datos.</p>";
}
?>
</body>
</html>
