<html>
<body>
<form action="dos.php" method="POST">
  Nombre: <input type="text" name="nombre">

  Edad: <input type="text" name="edad">

  Contrasenia: <input type="password" name="contra">
  <input type="submit" value="aceptar">
  
  Sexo:
  <input type="radio" name="sexo"
  value="M" checked> Mujer
  <input type="radio" name="sexo"
  value="H"> Hombre

  <input type="checkbox" name="extras[]"
  value="garaje" checked> Garaje
  <input type="checkbox" name="extras[]"
  value="piscina"> Piscina
  <input type="checkbox" name="extras[]"
  value="jardin"> Jardín

  Color:
  <select name="color">
  <option value="rojo" selected>Rojo</option>
  <option value="verde">Verde</option>
  <option value="azul">Azul</option>
  </select>

  Idiomas:
  <select multiple size="3" name="idiomas[]">
  <option value="ingles" selected>Inglés</option>
  <option value="frances">Francés</option>
  <option value="aleman">Alemán</option>
  <option value="holandes">Holandés</option>
  </select>

  Comentario:
  <textarea cols="50" rows="4" name="comentario">
  Este libro me parece ...
  </textarea>
</form>
</body>
</html>
