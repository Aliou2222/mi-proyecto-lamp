<?php
session_start();
if (isset($_SESSION['usuario'])) {
$_SESSION['contador']++;
echo "<FONT color ='".$_SESSION['color']."'>" ;
echo "Bienvenido " . $_SESSION['usuario'];
echo "</FONT>";
}
?>