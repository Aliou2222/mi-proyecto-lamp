<?php
session_start();
$_SESSION['usuario'] = 'Aliou';
$_SESSION['contador'] = 1;
$_SESSION['color'] = 'blue';
echo "Sesión iniciada. Usuario: " . $_SESSION['usuario'];
?>