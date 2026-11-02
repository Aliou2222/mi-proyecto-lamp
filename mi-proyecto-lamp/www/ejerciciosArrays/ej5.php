<?php
$numeros = [5, 10, 15, 20];
$suma = 0;
$contador = 0;

foreach ($numeros as $num) {
    $suma += $num;
    $contador++;
}

$promedio = $suma / $contador;

echo "El promedio es de: " . $promedio;
?>