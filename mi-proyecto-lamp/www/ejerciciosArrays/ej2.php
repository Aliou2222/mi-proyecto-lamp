<?php
$numeros = [4, 7, 10, 15, 20];
$contador = 0;

foreach ($numeros as $num) {
    if ($num % 2 == 0) $contador++;
}

echo "Hay " . $contador . " números pares";
?>