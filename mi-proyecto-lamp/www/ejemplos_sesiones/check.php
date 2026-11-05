<?php

//comprobamos si los datos son correctos
if ($_POST["usuario"]=="padrino" && $_POST["pass"]=="password"){
//Si son validos... creo una sesion
//creando sesion y guardando datos
session_start();
$_SESSION["autentificado"]= "SI";
header ("Location: protegida.php");
}else {
//si no existe le mando otra vez a la portada
header("Location: index.php?error=data");
}
?>
