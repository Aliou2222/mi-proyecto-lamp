<?php
// $estaciones = ["otoño", "invierno", "primavera", "verano"];
// echo $estaciones[1];
// --------------------------------------------------------

$dia = 5;
    switch ($dia) {
        case 1:
            $dia_texto= "Lunes";
            break;
        case 2:
            $dia_texto= "Martes";
            break;
        case 3:
            $dia_texto= "Miércoles";
            break;
        case 4:
            $dia_texto= "Jueves";
            break;
        case 5:
            $dia_texto= "Viernes";
            break;
        case 6:
            $dia_texto= "Sábado";
            break;
        case 7:
            $dia_texto= "Domingo";
            break;
        default:
            $dia_texto= "Datos no válidos";

}



$mes = 8;
    switch ($mes) {
        case 1:
            $mes_texto= "Enero";
            break;
        case 2:
            $mes_texto= "Febrero";
            break;
        case 3:
            $mes_texto= "Marzo";
            break;
        case 4:
            $mes_texto= "Abril";
            break;
        case 5:
            $mes_texto= "Mayo";
            break;
        case 6:
            $mes_texto= "Junio";
            break;
        case 7:
            $mes_texto= "Julio";
            break;
        case 8:
            $mes_texto= "Agosto";
            break;
        case 9:
            $mes_texto= "Septiembre";
            break;
        case 10:
            $mes_texto= "Octubre";
            break;
        case 11:
            $mes_texto= "Noviembre";
            break;
        case 12:
            $mes_texto= "Diciembre";
            break;
        default:
            $mes_texto= "Datos no válidos";

}

echo "Es un $dia_texto de $mes_texto";

?>
