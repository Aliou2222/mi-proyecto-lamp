<html>
<body>
<?php

$nombre = $_POST['nombre'];

$apellidos = $_POST['apellidos'];


$nacionalidad = $_POST['nacionalidad'];

$horario = $_POST['horario'];

$idiomas = $_POST['idiomas'] ?? [];
foreach ($idiomas as $idioma)
    print("$idioma<br>\n");


$observacion = $_REQUEST['observacion'];


print("$nombre");
print(" $apellidos");
print(" $nacionalidad");
print($horario);
print(nl2br(htmlspecialchars($observacion)));

?>
</body>
</html>
