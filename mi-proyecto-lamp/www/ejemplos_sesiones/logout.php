<?php
/*
Si existe la sesion, la destruye! 
*/
session_start();
session_destroy();
?>
<html>
<head>
<title>Cerraste sesion</title>
</head>
<body>
<strong>Has cerrado sesion!</strong>
</body>
</html>
