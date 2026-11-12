<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Insertar Libro</title>
</head>
<body>

    <form action="insertar2.php" method="POST">
      <table border="0" style="background-color: peru; border: 5px solid brown;">

        <!-- Título -->
        <tr>
          <td><b>Título</b></td>
          <td><input type="text" name="titulo" size="30" required></td>
        </tr>

        <!-- Autor -->
        <tr>
          <td><b>Autor</b></td>
          <td><input type="text" name="autor" size="30" required></td>
        </tr>

        <!-- Editorial -->
        <tr>
          <td><b>Editorial</b></td>
          <td><input type="text" name="editorial" size="30" required></td>
        </tr>

        <!-- Precio -->
        <tr>
          <td><b>Precio</b></td>
          <td><input type="number" name="precio" step="0.01" min="0" required></td>
        </tr>

        <!-- Botones -->
        <tr>
          <td colspan="2" align="center">
            <input type="submit" name="insertar" value="Insertar">
            <input type="reset" value="Borrar Formulario">
          </td>
        </tr>

      </table>
    </form>

    <br>

    <?php
    if (isset($_POST['insertar'])) {
        mysqli_report(MYSQLI_REPORT_OFF);

        $conexion = mysqli_connect("mysql", "biblioteca", "comomola", "biblioteca");

        if (!$conexion) {
            die("<p style='color:red'>Error de conexión: " . mysqli_connect_error() . "</p>");
        }

        // Recoger datos del formulario
        $titulo = htmlspecialchars($_POST['titulo'] ?? '');
        $autor = htmlspecialchars($_POST['autor'] ?? '');
        $editorial = htmlspecialchars($_POST['editorial'] ?? '');
        $precio = $_POST['precio'];

        // Consulta preparada para insertar el libro de forma segura
        $consulta = "INSERT INTO libros (titulo, autor, editorial, precio) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $consulta);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssd", $titulo, $autor, $editorial, $precio);

            if (mysqli_stmt_execute($stmt)) {
                $id_insertado = mysqli_insert_id($conexion);

                echo "<h3 style='color:green'>Libro insertado correctamente.</h3>";
                echo "<p><strong>ID asignado:</strong> $id_insertado</p>";
                echo "<p>Título: " . htmlspecialchars($titulo) . "<br>" .
                     "Autor: " . htmlspecialchars($autor) . "<br>" .
                     "Editorial: " . htmlspecialchars($editorial) . "<br>" .
                     "Precio: " . htmlspecialchars($precio) . " €</p>";
            } else {
                echo "<h3>Error al insertar el libro:</h3>";
                echo "<p>" . mysqli_stmt_error($stmt) . "</p>";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "<h3>Error al preparar la consulta:</h3>";
            echo "<p>" . mysqli_error($conexion) . "</p>";
        }

        // Cerrar conexión
        mysqli_close($conexion);
    }
    ?>

</body>
</html>