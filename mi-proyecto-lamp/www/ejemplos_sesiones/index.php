<form action="check.php" method="POST">
  <table align="center" width="225" cellspacing="2" cellpadding="2" border="0">
    <tr>
      <td colspan="2" align="center"
<?php if (isset($_GET["error"]) && $_GET["error"]=="data"){?>
bgcolor=red><span style="color:#fffff"><b>Int&eacute;ntalo otra vez!! </b></span>
          <?php }else{?>
      bgcolor=#666666 bordercolor="red"><span class="Estilo3">Introduce tus datos</span>
      <?php }?></td>
    </tr>
    <tr>
      <td align="right" >Usr:</td>
      <td><input name="usuario" type="Text" maxlength="50"></td>
    </tr>
    <tr>
      <td align="right">Pwd:</td>
      <td><input name="pass" type="password"  maxlength="50"></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input name="Submit" type="Submit" value="Enviar"></td>
    </tr>
  </table>
