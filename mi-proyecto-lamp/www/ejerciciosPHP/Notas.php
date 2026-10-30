 <?php

$nota = 8;
    if ($nota < 5) {
        echo "Suspenso";
    } elseif ($nota < 7) {
        echo "Aprobado";
    } elseif ($nota < 9) {
        echo "Notable";
    } elseif ($nota >= 9) {
        echo "Sobresaliente";
    } else {
        echo "No es posible sacar la nota";
}

?>
