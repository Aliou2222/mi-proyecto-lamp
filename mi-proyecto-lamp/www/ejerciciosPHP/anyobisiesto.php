<?php
$anyo = 2024;

if (($anyo % 4 === 0 && $anyo % 100 !== 0) || ($anyo % 400 === 0)) {
    echo " $anyo es bisiesto.";
} else {
    echo " $anyo NO es bisiesto.";
}
?>
