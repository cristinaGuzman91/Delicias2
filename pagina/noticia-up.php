<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registrando notica...</title>
<style type="text/css">
<!-- body { background:url() no-repeat top; azimuth:center; } -->

html {
background:url(images/binarytech.jpg) no-repeat top; azimuth:center;
}

#img_container { height:120px; }
  #img_container ul {display:block;padding:0;margin:0;list-style:none;}
  #img_container ul li{float:left;width:100px;margin:10px;}
  #img_container ul li a img {
      width:93px;
      height:93px;
      border:1px solid #574331;
      padding:5px;
      background:#eee;
  }
  #img_container ul li a:hover img { border-color: darkred; }
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/mootools/1.2.1/mootools-yui-compressed.js"></script>
<link rel="stylesheet" href="../mootools/sexyalertbox.css" type="text/css" media="all" />
<script type="text/javascript" src="../mootools/sexyalertbox.v1.2.moo.js"></script>

<script type="text/javascript">
window.addEvent('domready', function() {
    Sexy = new SexyAlertBox();
});
</script>
</head>
<body> 
<?php
include('log.php');
session_start();

//ESTA FUNCION LA USAREMOS PARA OBTENER EL TAMAÑO DE NUESTRO ARCHIVO
function filesize_format($bytes, $format = '', $force = ''){
	$bytes=(float)$bytes;
	if ($bytes <1024){
		$numero=number_format($bytes, 0, '.', ',');
		return array($numero,"B");
	}
	if ($bytes <1048576){
		$numero=number_format($bytes/1024, 2, '.', ',');
		return array($numero,"KBs");
	}
	if ($bytes>= 1048576){
		$numero=number_format($bytes/1048576, 2, '.', ',');
		return array($numero,"MB");
	}
}
//VERIFICAMOS QUE SE SELECCIONO ALGUN ARCHIVO
if(sizeof($_FILES)==0){
	echo "No se puede subir el archivo";
	exit();
}
// EN ESTA VARIABLE ALMACENAMOS EL NOMBRE TEMPORAL QU SE LE ASIGNO ESTE NOMBRE ES GENERADO POR EL SERVIDOR
// ASI QUE SI NUESTRO ARCHIVO SE LLAMA foto.jpg el tmp_name no sera foto.jpg sino un nombre como SI12349712983.tmp por decir un ejemplo
$archivo = $_FILES["archivo"]["tmp_name"];
//Definimos un array para almacenar el tamaño del archivo
$tamanio=array();
//OBTENEMOS EL TAMAÑO DEL ARCHIVO
$tamanio = $_FILES["archivo"]["size"];
//OBTENEMOS EL TIPO MIME DEL ARCHIVO
$tipo = $_FILES["archivo"]["type"];
//OBTENEMOS EL NOMBRE REAL DEL ARCHIVO AQUI SI SERIA foto.jpg
$nombre_archivo = $_FILES["archivo"]["name"];
//PARA HACERNOS LA VIDA MAS FACIL EXTRAEMOS LOS DATOS DEL REQUEST
extract($_REQUEST);
//VERIFICAMOS DE NUEVO QUE SE SELECCIONO ALGUN ARCHIVO
if ( $archivo != "none" ){
	//ABRIMOS EL ARCHIVO EN MODO SOLO LECTURA
	// VERIFICAMOS EL TAÑANO DEL ARCHIVO
	$fp = @fopen($archivo, "rb");
	//LEEMOS EL CONTENIDO DEL ARCHIVO
	$contenido = @fread($fp, $tamanio);
	//CON LA FUNCION addslashes AGREGAMOS UN \ A CADA COMILLA SIMPLE ' PORQUE DE OTRA MANERA
	//NOS MARCARIA ERROR A LA HORA DE REALIZAR EL INSERT EN NUESTRA TABLA
	$contenido = @addslashes($contenido);
	//CERRAMOS EL ARCHIVO
	@fclose($fp);
	// VERIFICAMOS EL TAÑANO DEL ARCHIVO
	if ($tamanio <1048576){
		//HACEMOS LA CONVERSION PARA PODER GUARDAR SI EL TAMAÑO ESTA EN b ó MB
		$tamanio=filesize_format($tamanio);
	}
	
	setlocale(LC_ALL,"es_MX");
	$fecha=strftime("%A, %d de %B de %Y");
	$usu = $_SESSION['s_username'];
	
	$nom = $_SESSION["nom"]; $tit = $_POST["titulo"]; $text = $_POST["texto"]; $cat = $_POST["id"];
	
	
	if ($archivo==NULL) { echo '<script type="text/javascript">';  
	echo "window.addEvent('domready', function() { Sexy = new SexyAlertBox(); Sexy.alert('<h1>IMAGEN REQUERIDA</h1><em>ADVERTENCIA!</em><p>Falta adjuntar imagen, No se puede registrar la notica. Favor de insertarla</p>', { onComplete: function(returnvalue){ location.href='gen.php'; } , textBoxBtnOk: 'Regresar' }); });";  echo '</script>'; exit(); }
	  else {
		 
		  if ($tit==NULL) { echo '<script type="text/javascript">';  
	echo "window.addEvent('domready', function() { Sexy = new SexyAlertBox(); Sexy.alert('<h1>TITULO REQUERIDO</h1><em>ADVERTENCIA!</em><p>No se ha puesto ningún titulo, No se puede registrar la notica. Favor de escribir un titulo</p>', { onComplete: function(returnvalue){ location.href='gen.php'; } , textBoxBtnOk: 'Regresar' }); });";  echo '</script>'; exit(); }
		 	else {
			
				if ($id=="0") { echo '<script type="text/javascript">';  
		echo "window.addEvent('domready', function() { Sexy = new SexyAlertBox(); Sexy.alert('<h1>CATEGORIA REQUERIDA</h1><em>ADVERTENCIA!</em><p>No se ha seleccionado ninguna categoría, No se puede registrar la notica. Favor de seleccionar categoría</p>', { onComplete: function(returnvalue){ location.href='gen.php'; } , textBoxBtnOk: 'Regresar' }); });";  echo '</script>'; exit(); }
				else {						
				
			//CREAMOS NUESTRO INSERT
			$qry = "INSERT INTO info ( nombre_archivo, contenido, tamanio, tamanio_unidad, tipo, usuario, titulo, articulo, categoria, fecha, usu) VALUES
			('$nombre_archivo', '$contenido', '{$tamanio[0]}', '{$tamanio[1]}', '$tipo', '$nom', '$tit', '$text', '$cat', '$fecha', '$usu')";
			
			//NOS CONECAMOS A LA BASE DE DATOS
			//REMPLAZEN SUS VALOS POR LOS MIOS
			@mysql_connect("localhost","badira","usuario123") or die("No se pudo conectar a la base de datos en rssup");
			
			//SELECCIONAMOS LA BASE DE DATOS CON LA CUAL VAMOS A TRABAJAR CAMBIEN EL VALOR POR LA SUYA
			@mysql_select_db("badiraguato");
			
			//EJECUTAMOS LA CONSULTA
			@mysql_query($qry) or die("Query: $qry <br />Error: ".@mysql_error());
			
			//CERRAMOS LA CONEXION
			@mysql_close();
			//NOTIFICAMOS AL USUARIO QUE EL ARCHVO SE HA ENVIADO O REDIRIGIMOS A OTRO LADO ETC.
			echo '<script type="text/javascript">';  
	echo "window.addEvent('domready', function() { Sexy = new SexyAlertBox(); Sexy.info('<h1>¡FELICIDAS!</h1><em>REGISTRO CORRECTAMENTE!</em><p>La noticia se ha creado correctamente!, seguir creando noticias...</p>', { onComplete: function(returnvalue){ location.href='gen.php'; } , textBoxBtnOk: 'Regresar' }); });";  echo '</script>'; exit();
				 }	
			  }
	  	   }
}
else {
	echo "<script>alert('No fue posible subir la noticia');</script>";	
	echo("<script>location.href='gen.php';</script>");
}
?>
</body>
</html>