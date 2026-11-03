<?php

$numeros = array(3, 8, 2, 5, 4, 1);
$sumaCuadrados = 0;
$pares = 0;
$posicionMayor = 0;



for ($i =0; $i <count($numeros);$i++){
    $sumaCuadrados += $numeros[$i] * $numeros[$i];
    if ($numeros[$i] % 2 == 0) {
        $pares++;
    }
}

for ($i = 0; $i < count($numeros); $i++) {
    if ($numeros[$i] > $numeros[$posicionMayor]) {
        $numeroMayor = $numeros[$i];
        $posicionMayor = $i;
    }
}


echo "SumaCuadrados= $sumaCuadrados , pares = $pares, posicionMayor = $posicionMayor<br>";






?>
 