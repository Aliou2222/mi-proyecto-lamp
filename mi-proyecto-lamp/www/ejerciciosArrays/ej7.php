<?php
$matriz = [
    [5, 12, 7],
    [8, 15, 3],
    [11, 2, 9]
];
$contador = 0;

foreach ($matriz as $fila) {
    foreach ($fila as $num) {
        if ($num > 10) {
            $contador++;
        }
    }
}

echo "Los elementos mayores que 10 son: " . $contador;
?>