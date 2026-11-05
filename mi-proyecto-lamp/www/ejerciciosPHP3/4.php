<?php
session_start();

foreach($_SESSION as $indice =>$valor)
    echo "<br>$indice:$valor";

session_destroy();
echo "<br>Sesión cerrada completamente";
?>