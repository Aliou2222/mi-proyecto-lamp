<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Saludo</title></head>
<body>
<?php
if (isset($_POST['Enviar'])) {
    // 2ª carga: procesar formulario
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

$precio=$precio + $numing * 1;

if ($pago == "Contado"){
    $precio = 0.9 * $precio;
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
      <tr><th>Precio final</th><td>$precio</td></tr>
      
    </table>";
    // Mostrar la contraseña es solo didáctico: nunca se hace en una aplicación real
} else {
    echo "<p>No se han enviado datos.</p>";
}
} else {
    // 1ª carga: mostrar formulario
?>
     <form action="CopiaPedido.php" method="POST">
      <table border="0"  style="background-color: peru; border: 5px solid brown;">

        <!-- Nombre -->
        <tr>
          <td><b>Nombre</b></td>
          <td><input type="text" name="nombre" size="30"></td>
        </tr>

        <!-- Dirección -->
        <tr>
          <td><b>Dirección</b></td>
          <td><input type="text" name="direccion" size="30"></td>
        </tr>

        <!-- Ingredientes / Tamaño / Forma de pago -->
        <tr>
          <!-- Ingredientes -->
          <td>
            <b>Ingredientes</b><br>
            <input type="checkbox" name="ingredientes[]" value="queso"> Queso <br>
            <input type="checkbox" name="ingredientes[]" value="pimiento"> Pimiento <br>
            <input type="checkbox" name="ingredientes[]" value="cebolla"> Cebolla
          </td>

          <!-- Tamaño -->
          <td>
            <b>Tamaño</b><br>
            <input type="radio" name="tamano" value="pequena"> Pequeña <br>
            <input type="radio" name="tamano" value="mediana"> Mediana <br>
            <input type="radio" name="tamano" value="grande"> Grande
          </td>

          <!-- Forma de pago -->
          <td>
            <b>Forma de pago</b><br>
            <select name="pago">
              <option value="visa">VISA</option>
              <option value="cheque">Cheque</option>
              <option value="contado">Contado</option>
              <option value="metalico">Metálico</option>
            </select>
          </td>
        </tr>

        <!-- Instrucciones especiales -->
        <tr>
          <td colspan="3">
            <b>Instrucciones Especiales</b><br>
            <textarea name="instrucciones" rows="5" cols="60"></textarea>
          </td>
        </tr>

        <!-- Botones -->
        <tr>
          <td colspan="3" align="center">
            <input type="submit" name="Enviar" value="Enviar Pedido">
            <input type="reset" value="Borrar Formulario">
          </td>
        </tr>

      </table>
    </form>
<?php
}
?>
</body>
</html>