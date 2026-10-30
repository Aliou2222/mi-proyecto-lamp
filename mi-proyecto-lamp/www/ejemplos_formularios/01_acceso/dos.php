<html>
<body>
<?php
// Versión antigua (necesitaba register_globals, eliminado en PHP 5.4):
//     print("La edad es: $edad");
// Versión actual:
$edad = $_POST['edad'];

$nombre = $_POST['nombre'];

$contrasenia = $_POST['contra'];

$sexo = $_POST['sexo'];

$extras = $_POST['extras'] ?? [];
foreach ($extras as $extra)
    print("$extra<br>\n");

$color = $_POST['color'];

$idiomas = $_REQUEST['idiomas'] ?? [];
foreach ($idiomas as $idioma)

$comentario = $_REQUEST['comentario'];


print("$nombre");
print(" tu edad es: $edad");
print(" $contrasenia");
print($sexo); 
print(" $color"); 
print("<br>$idioma<br>\n");
print(nl2br(htmlspecialchars($comentario)));

// if (isset($_POST['edad'])) {
// $edad = $_POST['edad'];
// } else {
// $edad = "NO HAY EDAD O NOMBRE";
// }
?>
</body>
</html>
