<?php
#ej8--------------------------------------
$original = [1, 2, 3, 4, 5];
$invertido = array_reverse($original);

print_r($invertido);

#ej8--------------------------------------

#ej9--------------------------------------
$numeros = [3, 6, 9, 12];
$suma = array_sum($numeros);

echo "<br> La suma total es: " . $suma . "<br>";

#ej9--------------------------------------

#ej10--------------------------------------
$frutas = ['manzana', 'pera', 'banana', 'naranja'];

if (in_array('banana', $frutas)) {
    echo "banana está en el array";
} else {
    echo " banana no está en el array";
}

#ej10--------------------------------------
?>