<?php

$ventas = array(
    2022 => array("regaderas" => 1500, "macetas" => 2500, "herramientas" => 3000),
    2023 => array("regaderas" => 1000, "macetas" => 3000, "herramientas" => 2000),
    2024 => array("regaderas" => 2000, "macetas" => 2000, "herramientas" => 1600),
    2025 => array("regaderas" => 3500, "macetas" => 1700, "herramientas" => 2200),
);


//  Indica el total de ventas de cada producto

$totalRegaderas = 0;
$totalMacetas = 0;
$totalHerramientas = 0;

foreach ($ventas as $anio => $productos) {
    $totalRegaderas += $productos["regaderas"];
    $totalMacetas += $productos["macetas"];
    $totalHerramientas += $productos["herramientas"];
}

echo "regaderas: $totalRegaderas<br>";
echo "macetas: $totalMacetas<br>";
echo "herramientas: $totalHerramientas<br>";




//  El año de mayor facturación en la venta de macetas
$mayorAnio = null;
$mayorCantidad = 0;
foreach ($ventas as $anio => $productos) {
    if ($productos["macetas"] > $mayorCantidad) {
        $mayorCantidad = $productos["macetas"];
        $mayorAnio = $anio;
    }
}
echo "El año de mayor facturación en la venta de macetas: $mayorAnio<br>";




// El total de facturacion de los años pares.
$facturacionTotal = 0;
foreach ($ventas as $anio => $productos) {
    if ($anio %2 == 0){
        $facturacionTotal += $productos["regaderas"] + $productos["macetas"] + $productos["herramientas"];

    }

}
echo "el total de facturacion de los años pares: $facturacionTotal<br>";



?>





