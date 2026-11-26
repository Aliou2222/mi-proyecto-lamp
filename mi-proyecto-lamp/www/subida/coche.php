<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marca      = htmlspecialchars($_POST['marca'] ?? '');
    $modelo      = htmlspecialchars($_POST['modelo'] ?? '');

}



// Verificar que se subió un archivo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marca  = htmlspecialchars($_POST['marca'] ?? '');
    $modelo = htmlspecialchars($_POST['modelo'] ?? '');

    if (isset($_FILES['archivo'])) {
        $archivo = $_FILES['archivo'];
        $nombre  = $archivo['name'];
        $tamano  = $archivo['size'];
        $temp    = $archivo['tmp_name'];
        $error   = $archivo['error'];

        if ($error === 0) {
            // Máximo 1MB (1048576 bytes)
            if ($tamano <= 1048576) {
                $ext_permitidas = ['jpg'];
                $ext = strtolower(pathinfo($nombre, PATHINFO_EXTENSION));

                if (in_array($ext, $ext_permitidas)) {
                    $nuevo_nombre = uniqid('', true) . "." . $ext;
                    $destino = 'uploads/' . $nuevo_nombre;

                    if (move_uploaded_file($temp, $destino)) {
                        $imagen = $destino;
                    } else {
                        echo "<p>Error al mover el archivo (revisa que exista la carpeta 'uploads').</p>";
                    }
                } else {
                    echo "<p>Tipo no permitido. Solo se aceptan archivos JPG.</p>";
                }
            } else {
                echo "<p>Archivo muy grande. El máximo permitido es 1MB.</p>";
            }
        } else {
            echo "<p>Error al subir archivo: código " . $error . "</p>";
        }
    } else {
        echo "<p>No se recibió archivo.</p>";
    }
}

echo "<h2>Datos del Pedido</h2>";
echo "<table border='1'>
  <tr><th>MARCA</th><td>$marca</td></tr>
  <tr><th>MODELO</th><td>$modelo</td></tr>";

if ($imagen !== '') {
    echo "<tr><th>IMAGEN</th><td><img src='$imagen' alt='Imagen de $marca $modelo' width='200'></td></tr>";
} else {
    echo "<tr><th>IMAGEN</th><td>Sin imagen</td></tr>";
}

echo "</table>";
?>