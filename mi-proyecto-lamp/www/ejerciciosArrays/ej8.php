<?php
$original = [1, 2, 3, 4, 5];
$invertido = [];

for ($i = count($original) - 1; $i >= 0; $i--) {
    $invertido[] = $original[$i];
}

print_r($invertido);
?>