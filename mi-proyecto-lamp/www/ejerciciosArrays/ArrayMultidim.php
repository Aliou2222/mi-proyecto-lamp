<?php
$clima = [
    "Enero"      => ["temp" => 5.0,  "prec" => 36],
    "Febrero"    => ["temp" => 6.6,  "prec" => 26],
    "Marzo"      => ["temp" => 9.9,  "prec" => 28],
    "Abril"      => ["temp" => 12.2, "prec" => 39],
    "Mayo"       => ["temp" => 15.1, "prec" => 50],
    "Junio"      => ["temp" => 18.9, "prec" => 51],
    "Julio"      => ["temp" => 21.8, "prec" => 25],
    "Agosto"     => ["temp" => 21.7, "prec" => 30],
    "Septiembre" => ["temp" => 19.0, "prec" => 43],
    "Octubre"    => ["temp" => 13.9, "prec" => 44],
    "Noviembre"  => ["temp" => 9.0,  "prec" => 33],
    "Diciembre"  => ["temp" => 6.1,  "prec" => 46]
];

$sumaTemperaturas = 0;
$totalMeses = 0;

$menorPrecipitacion = null;
$mesMenorPrecipitacion = "";

foreach ($clima as $mes => $datos) {
    foreach ($datos as $clave => $valor) {
        if ($clave === "temp") {
            $sumaTemperaturas += $valor;
            $totalMeses++;
        }
        
        if ($clave === "prec") {
            if ($menorPrecipitacion === null || $valor < $menorPrecipitacion) {
                $menorPrecipitacion = $valor;
                $mesMenorPrecipitacion = $mes;
            }
        }
    }
}

$temperaturaMedia = $sumaTemperaturas / $totalMeses;

echo "La temperatura media del año es: " . number_format($temperaturaMedia, 2) . " ºC<br>";
echo "El mes con menor precipitación es: " . $mesMenorPrecipitacion . " (" . $menorPrecipitacion . " mm)<br>";
?>