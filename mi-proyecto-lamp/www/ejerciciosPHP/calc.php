<?php
$num1 = 10;
$num2 = 5;
$operacion = "+";

switch ($operacion) {
    case "+":
        echo "Resultado: " . ($num1 + $num2);
        break;
    case "-":
        echo "Resultado: " . ($num1 - $num2);
        break;
    case "*":
        echo "Resultado: " . ($num1 * $num2);
        break;
    case "/":
        echo "Resultado: " . ($num1 / $num2);
        break;
    default:
        echo "Operación no válida.";
}
?>
