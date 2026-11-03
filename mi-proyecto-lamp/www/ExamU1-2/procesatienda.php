<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre  = htmlspecialchars($_POST['nombre'] ?? '');
    $apellidos  = htmlspecialchars($_POST['apellidos'] ?? '');
    $direccion  = htmlspecialchars($_POST['direccion'] ?? '');

    $provincia = ($_POST['provincia'] ?? '');
    $provincia_str = htmlspecialchars($provincia);

    $televisores = ($_POST['televisores'] ?? '');
    $televisores_str = htmlspecialchars($televisores);

    $ordenadores = ($_POST['ordenadores'] ?? '');
    $ordenadores_str = htmlspecialchars($ordenadores);

    $consolas = ($_POST['consolas'] ?? '');
    $consolas_str = htmlspecialchars($consolas);

    $urgente = ($_POST['urgente'] ?? '');
    $urgente_str = htmlspecialchars($urgente);




}






echo "<h2>La dirección del envío es:</h2>";
echo "<p>$nombre $apellidos</p>";
echo "<p>$direccion</p>";
echo "<p>$provincia_str</p>";

echo "<h2>Los datos del pedido son:</h2>";
echo "<p>$televisores_str televisores</p>";
echo "<p>$ordenadores_str ordenadores</p>";
echo "<p>$consolas_str consolas</p>";

echo "<p> Importe total: $importetotal</p>";

?>