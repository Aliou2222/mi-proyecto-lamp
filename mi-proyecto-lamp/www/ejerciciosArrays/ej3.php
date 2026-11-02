<?php
$numeros = [12, 45, 7, 23, 56];
$mayor = $numeros[0];

foreach ($numeros as $num) {
    if ($num > $mayor) {
        $mayor = $num;
    }
}

echo "El número mayor es: " . $mayor;
?>