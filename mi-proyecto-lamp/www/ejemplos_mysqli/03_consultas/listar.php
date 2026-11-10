<?php
// Material: «Ejemplo: listar todos los libros» (página 20 del PDF)
// Conectar a la base de datos
$conexion = mysqli_connect("mysql", "biblioteca", "comomola", "biblioteca");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consulta SQL para obtener todos los libros
$consulta = "SELECT codigo, titulo, autor, editorial, precio FROM libros WHERE editorial='Paidos'";

// Ejecutar la consulta
$resultado = mysqli_query($conexion, $consulta);

// Verificar si la consulta fue exitosa
if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

// Mostrar los resultados
echo "<h2>Listado de libros disponibles</h2>";
echo "<p>Total de librosde Paidos: " . mysqli_num_rows($resultado) . "</p>";

// Recorrer cada fila del resultado

//$suma=0;

while ($fila = mysqli_fetch_assoc($resultado)) {
    echo "<hr>";
    //echo "<b>Código:</b> " . $fila['codigo'] . "<br>";
    echo "<b>Título:</b> " . $fila['titulo'] . "<br>";
    //echo "<b>Autor:</b> " . $fila['autor'] . "<br>";
    //echo "<b>Editorial:</b> " . $fila['editorial'] . "<br>";
    echo "<b>Precio:</b> " . $fila['precio'] . " €<br>";
    //$suma=$suma+$fila['precio'];
}
//echo "<br>Total libros de Emece: $suma €";


// Liberar resultado y cerrar conexión
mysqli_free_result($resultado);
mysqli_close($conexion);
?>
