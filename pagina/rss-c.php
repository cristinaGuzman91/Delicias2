<?
if (!isset($_POST['cre'])) {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Crear categor&iacute;a</title>
</head>
<body style="font:corbel">
<div align="center" style="font:corbel" >
<form action="" method="post" name="reg">
<table cellpadding="0" cellspacing="5" border="0">
<tr>
<td>
<font face="corbel">Nombre Categor&iacute;a
<input type="hidden" name="anio" value="<? $an=date('Y'); echo $an; ?>" /></font>
</td>
<td>
<input type="text" name="concepto" size="60" />
</td>
</tr>
</table>
<input type="submit" name="cre" value="Crear categor&iacute;a &raquo;"  />
</form>
</div>
</body>
</html>
<?
}
else { 
$concepto=$_POST['concepto']; $anio=$_POST['anio'];
if ($concepto == NULL) { 
echo "<script>alert('Favor de capturar un concepto gracias');</script>";
echo "<script>location.href='rss-c.php';</script>";
 }
else {
$fecha=date("d M Y [h:i  A]");
$log = $_SESSION['s_username'];			
			$qu="INSERT INTO tabla (concepto, anio, fecha, login) VALUES ('$concepto', '$anio', '$fecha', '$log')";
			@mysql_connect("localhost","usuario","clave") or die("No se pudo conectar a la base de datos en rssup");			
			//SELECCIONAMOS LA BASE DE DATOS CON LA CUAL VAMOS A TRABAJAR CAMBIEN EL VALOR POR LA SUYA
			@mysql_select_db("base_de_datos");			
			//EJECUTAMOS LA CONSULTA
			@mysql_query($qu) or die("Query: $qry <br />Error: ".@mysql_error());
echo "<script>alert('Concepto grabado satisfactoriamente!');</script>";
echo "<script>window.close(); window.opener.location.reload(true);</script>";
if (!$qu) { echo ""; }
else { echo "";} 
}
} 
?>