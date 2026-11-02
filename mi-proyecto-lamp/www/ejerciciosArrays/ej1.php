 <?php
$numeros = array(2, 5, 8, 3, 10);
$suma = 0;
for ($i = 0; $i < count($numeros); $i++) {
    $suma += $numeros[$i];
}
echo "La suma total es: " . $suma;
?>