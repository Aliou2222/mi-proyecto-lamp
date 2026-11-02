<?php
$tabla = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];

for ($c = 0; $c < 3; $c++) {
    $sumaColumna = 0;
    for ($f = 0; $f < 3; $f++) {
        $sumaColumna += $tabla[$f][$c];
    }
    echo "Suma de la columna " . ($c + 1) . ": " . $sumaColumna . "<br>";
}
?>