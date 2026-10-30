<?php
$precio = 100;
$tipo = "vip";
$descuento = 0;

switch ($tipo) {
    case "premium":
        $descuento = 10;
        break;
    case "vip":
        $descuento = 30;
        break;
    case "normal":
        $descuento = 5;
        break;
}

$precioFinal = $precio - ($precio * $descuento / 100);

echo "Precio original: $precio <br>";
echo "Descuento: $descuento% <br>";
echo "Precio final: **$precioFinal**";
?>
