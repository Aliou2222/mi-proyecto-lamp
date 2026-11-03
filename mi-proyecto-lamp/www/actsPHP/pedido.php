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
<body><!DOCTYPE html>
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
    $direccion  = htmlspecialchars($_POST['direccion'] ?? '');
    $pago       =  htmlspecialchars($_POST['pago'] ?? '');
    $tamano        = htmlspecialchars($_POST['tamano'] ?? '');
    $ingredientes    = $_POST['ingredientes'] ?? [];
    $numing= count($ingredientes);
    $ingredientes_str = implode(', ', array_map('htmlspecialchars', $ingredientes));
    $instrucciones = nl2br(htmlspecialchars($_POST['instrucciones'] ?? ''));
    // $precio = echo "$precio"

switch ($tamano){
    case "pequeña": $precio=6;
    break;
    case "mediana": $precio=9;
    break;
    case "grande": $precio=12;
    break;
    default: $precio=12;
}

$precio_com=$precio + $numing * 1;

if ($pago == "Contado"){
    $precio_com = 0.9 * $precio_com;
}


    echo "<h2>Datos del Pedido</h2>";
    echo "<table>
      <tr><th>Nombre</th><td>$nombre</td></tr>
      <tr><th>Dirección</th><td>$direccion</td></tr>
      <tr><th>Forma de pago</th><td>$pago</td></tr>
      <tr><th>Tamaño</th><td>$tamano</td></tr>
      <tr><th>Nº Ingredientes</th><td>$numing</td></tr>
      <tr><th>Ingredientes</th><td>$ingredientes_str</td></tr>
      <tr><th>Intrucciones especiales</th><td>$instrucciones</td></tr>
      <tr><th>Precio final</th><td>$precio_com</td></tr>
      
    </table>";
    // Mostrar la contraseña es solo didáctico: nunca se hace en una aplicación real
} else {
    echo "<p>No se han enviado datos.</p>";
}


?>