<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Calculadora</title></head>
<body>
<?php
if (isset($_POST['Calcular'])) {
    // 2ª carga: procesar formulario
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero1      = htmlspecialchars($_POST['numero1'] ?? '');
    $operador  = htmlspecialchars($_POST['oprador'] ?? '');
    $numero2       =  htmlspecialchars($_POST['numero2'] ?? '');
   


    echo "<h2>Solucion del Calculo</h2>";
    echo 
       "<p>$numero1 $operador $numero2 = $solucion.</p>";
      
    // Mostrar la contraseña es solo didáctico: nunca se hace en una aplicación real
} else {
    echo "<p>No se han enviado datos.</p>";
}
} else {
    // 1ª carga: mostrar formulario
?>
     <form action="Calculadora.php" method="POST">
      <table border="0"  style="background-color: peru; border: 5px solid brown;">

        <!-- Numero -->
        <tr>
          <td><b>Numero</b></td>
          <td><input type="number" name="numero1" size="5"></td>
        </tr>

      
        <!-- Operador -->
        <td>
          <b>Operador</b><br>
          <select multiple size="1" name="operador[]">
            <option value="suma" selected>+</option>
            <option value="resta">-</option>
            <option value="multiplicacion">*</option>
            <option value="division">/</option>
            </select>
        </td>


        <!-- Numero -->
        <tr>
          <td><b>Numero</b></td>
          <td><input type="number" name="numero2" size="5"></td>
        </tr>


        <!-- Botones -->
        <tr>
          <td colspan="3" align="center">
            <input type="submit" name="Calcular" value="Calcular">
            <input type="reset" value="Borrar Operación">
          </td>
        </tr>

      </table>
    </form>
<?php
}
?>
</body>
</html>