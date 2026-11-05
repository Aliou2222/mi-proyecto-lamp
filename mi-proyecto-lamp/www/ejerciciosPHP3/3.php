<?php
session_start();
echo "<br>Tu color favorito es: " . $_SESSION['color'];
unset($_SESSION['color']);
echo "<br>Color favorito eliminado";
?>