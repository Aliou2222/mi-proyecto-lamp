<?php
// Material: «Ejemplo: insertar un nuevo libro» (página 31 del PDF)
$conexion = mysqli_connect("mysql", "biblioteca", "comomola", "biblioteca");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Datos del nuevo libro
$titulo = "Cien años de soledad";
$autor = "Gabriel García Márquez";
$editorial = "Sudamericana";
$precio = 28.50;

// Construir la consulta INSERT
// ¡Cuidado! Pegar variables en la consulta solo es aceptable con datos fijos
// como estos. Con datos de un formulario hay que usar consultas preparadas.
$consulta = "INSERT INTO libros (titulo, autor, editorial, precio)
             VALUES ('$titulo', '$autor', '$editorial', $precio)";

// Ejecutar la consulta
if (mysqli_query($conexion, $consulta)) {
    // Obtener el ID del registro insertado
    $id_insertado = mysqli_insert_id($conexion);

    echo "<h3 style='color:green'>Libro insertado correctamente.</h3>";
    echo "<p><strong>ID asignado:</strong> $id_insertado</p>";
    echo "<p>Título: $titulo<br>Autor: $autor<br>Editorial: $editorial<br>Precio: $precio €</p>";
} else {
    echo "<h3 style='color:red'>Error al insertar el libro:</h3>";
    echo "<p>" . mysqli_error($conexion) . "</p>";
}

// Cerrar conexión
mysqli_close($conexion);
?>
