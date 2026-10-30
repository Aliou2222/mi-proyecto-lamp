<?php
$edad = 20;
    if ($edad < 0) {
        echo "No es posible esa edad";
    } elseif ($edad < 18) {
        echo "Eres un niño";
    } elseif ($edad < 25) {
        echo "Eres un adolescente";
    } elseif ($edad < 65) {
        echo "Eres un adulto";
    }else {
        echo "Eres un senior";
}

?>
