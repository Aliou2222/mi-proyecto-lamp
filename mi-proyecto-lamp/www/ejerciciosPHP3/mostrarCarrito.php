<?php
session_start();
$total = 0;

if (isset($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $item) {
    echo $item['nombre'] . " - $" . $item['precio']."<br>";
    $total += $item['precio'];
    }
    echo "<br>Total: $" . $total;

} else {
    echo "<br>El carrito está vacío";
}
?>