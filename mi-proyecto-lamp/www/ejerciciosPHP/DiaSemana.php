<?php

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

echo "$dia = $dia_texto";
?>
