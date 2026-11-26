<?php
// Verificar que se subió un archivo
if (isset($_FILES['archivo'])) {
$archivo = $_FILES['archivo'];
$nombre = $archivo['name'];
$tipo = $archivo['type'];
$tamano = $archivo['size'];
$temp = $archivo['tmp_name'];
$error = $archivo['error'];
// Verificar si hay errores
if ($error === 0) {
// Validar tamaño (max 5MB)
if ($tamano <= 5000000) {
// Extensiones permitidas
$ext_permitidas = ['jpg', 'jpeg',
'png', 'pdf'];
$ext = strtolower(
pathinfo($nombre,
PATHINFO_EXTENSION)
);
if (in_array($ext,
$ext_permitidas)) {
// Crear nombre único
$nuevo_nombre =
uniqid('', true)
. "." . $ext;
// Carpeta destino
$destino =
'uploads/'
. $nuevo_nombre;
// Mover archivo
if (move_uploaded_file(
$temp, $destino)) {
echo "7 Archivo subido: "
. $nuevo_nombre;
} else {
echo " Error al mover";
}
} else {
echo " Tipo no permitido";
}
} else {
echo " Archivo muy grande";
}
} else {
echo " Error: " . $error;
}
} else {
echo " No se recibió archivo";
}
?>