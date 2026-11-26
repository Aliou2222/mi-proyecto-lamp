<?php
if (is_uploaded_file ($_FILES['imagen']['tmp_name']))
{
	$nombreDirectorio = "img/";
	$nombreFichero = $_FILES['imagen']['name'];
	$nombreCompleto = $nombreDirectorio . $nombreFichero;
	// if (is_file($nombreCompleto))
	// {
	// 	$idUnico = time();
	// 	$nombreFichero = $idUnico . "-" . $nombreFichero;
	// }
	move_uploaded_file ($_FILES['imagen']['tmp_name'],
	$nombreDirectorio . $nombreFichero);
	print ("Fichero $nombreFichero subido.\n");

}
else
	print ("No se ha podido subir el fichero\n");
?>
