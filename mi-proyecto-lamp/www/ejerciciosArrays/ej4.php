<?php
$numeros = [34, 2, 19, 8, 50];
$menor = $numeros[0];

foreach ($numeros as $num) {
    if ($num < $menor) {
        $menor = $num;
    }
}

echo "El número menor es: " . $menor;
?>