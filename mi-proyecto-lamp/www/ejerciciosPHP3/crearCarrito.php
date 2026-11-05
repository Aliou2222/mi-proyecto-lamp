<?php
session_start();
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

$producto = array(
    'id' => 1,
    'nombre' => 'Laptop',
    'precio' => 899.99
);

$producto2 = array(
    'id' => 2,
    'nombre' => 'Tablet',
    'precio' => 399.99
);

$_SESSION['carrito'][] = $producto;
$_SESSION['carrito'][] = $producto2;
echo "Productos agregados al carrito";

?>