<?
include('conecta.php');  $query="SELECT id FROM noticias ORDER BY id DESC LIMIT 1"; $mas=@mysql_query($query); $num=@mysql_fetch_array($mas); $num=$num["id"] + 1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> DELICIAS Generador de Noticias </title>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/mootools/1.2.1/mootools-yui-compressed.js"></script>
<link rel="stylesheet" href="../mootools/sexyalertbox.css" type="text/css" media="all" />
<script type="text/javascript" src="../mootools/sexyalertbox.v1.2.moo.js"></script>

<script type="text/javascript">
window.addEvent('domready', function() {
    Sexy = new SexyAlertBox();
});
</script>
<script>
function insfot(){ 
var num = '<? echo $num; ?>';
var input = document.form1.conte;
input.value = "<iframe align='middle' allowtransparency='allowtransparency' frameborder='0' scrolling='no' src='carrusel/" + num + ".html' width='1020' height='170'></iframe>";
input.focus();
}

function instag(tag){
var input = document.form1.conte;
if(typeof document.selection != 'undefined' && document.selection) {
var str = document.selection.createRange().text;
input.focus();
var sel = document.selection.createRange();
sel.text = "<" + tag + ">" + str + "</" +tag+ ">";
sel.select();
return;
}
else if(typeof input.selectionStart != 'undefined'){
var start = input.selectionStart;
var end = input.selectionEnd;
var insText = input.value.substring(start, end);
input.value = input.value.substr(0, start) + '<'+tag+'>' + insText + '</'+tag+'>'+ input.value.substr(end);
input.focus();
input.setSelectionRange(start+2+tag.length+insText.length+3+tag.length,start+2+tag.length+insText.length+3+tag.length);
return;
}
else{
input.value+=' <'+tag+'>Reemplace este texto</'+tag+'>';
return;
}
}
function inslink(){
var input = document.form1.conte;
if(typeof document.selection != 'undefined' && document.selection) {
var str = document.selection.createRange().text;
input.focus();
var my_link = prompt("Escribe URL:","http://");
if (my_link != null) {
if(str.length==0){
str=my_link;
}
var sel = document.selection.createRange();
sel.text = "<a href=" + my_link + ">" + str + "</a>";
sel.select();
}
return;
}else if(typeof input.selectionStart != 'undefined'){
var start = input.selectionStart;
var end = input.selectionEnd;
var insText = input.value.substring(start, end);
var my_link = prompt("Escribe URL:","http://");
if (my_link != null) {
if(insText.length==0){
insText=my_link;
}
input.value = input.value.substr(0, start) +"<a href=" + my_link +">" + insText + "</a>"+ input.value.substr(end);
input.focus();
input.setSelectionRange(start+11+my_link.length+insText.length+4,start+11+my_link.length+insText.length+4);
}
return;
}else{
var my_link = prompt("Ingresar URL:","http://");
var my_text = prompt("Ingresar el texto del link:","");
input.value+=" <a href=" + my_link + ">" + my_text + "</a>";
return;
}
}
</script>

<style type="text/css">
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


html, body {
font-family:Calibri;
border:0 ; margin: 0; padding:0;
overflow:auto;
}

#cabeza {
height:152px;
width:1271px;
background:url(../images/noti.png) no-repeat;
font:100% Corbel;
}

#cabeza .usu {
float:left;
margin-left:230px;
margin-top:120px;
color:#FFFFFF;
font-size:20px;
font-family:Calibri;
}

#contenido { 
float:none;
width:auto;
height:430px;
margin-left:15px;
margin-top:50px;
}

#contenido input.campo {
background-color:#01A955;
border: 1px solid #666666;
}

#sel select {
background-color:#01A955;
font-size:14px;
color:#FFFFFF;
height:auto;
font-weight:bold;
}

#sel select:focus {
background-color:#EBEBEB;
font-size:14px;
color:#000000;
height:auto;
}

#contenido input:focus.campo {
background-color:#B70101;
border: 1px solid #880000;
color:#FFFFFF;
}

#contenido textarea.campo {
background-color:#01A955;
border: 1px solid #666666;
font-family:Calibri;
}

#contenido textarea:focus.campo {
background-color:#EFEFEF;
border: 1px solid #666666;
color:#000000;
}

#formato {
font-family:Calibri;
font-size:12px;
background:#FFFFFF;
}

#titulo {
margin-top:10px;
margin-bottom:20px;
margin-left:20px;
position:fixed;
}
</style>
</head>
<? 
//include('login2.php');
	session_start();
	 if (!isset($_SESSION['autenticado'])) { echo '<script type="text/javascript">';  
	echo "window.addEvent('domready', function() { Sexy = new SexyAlertBox(); Sexy.error('<h1>binarytech MX</h1><em>Delicias</em><p>Lo sentimos no tienes ACCESO para crear Noticias.</p> <p>Favor de ACCESAR al Portal para generar Nuevas noticias. (RSS) <br>Gracias!</p>', { onComplete: function(returnvalue){ location.href='../config.php'; } , textBoxBtnOk: 'Regresar' }); });";  echo '</script>'; exit(); } else {
?>

<body>
<div id="titulo"><strong>ESTAS EN &raquo;</strong> Generador de Noticias :: M&Oacute;DULO DE NOTICIAS </div>
<div id="contenido">
<form action="rssup.php" enctype="multipart/form-data" method="post" name="form1" >
<table border="0" cellpadding="0" cellspacing="5">
<tr>
<td width="67" align="right">T&iacute;tulo <font color="#FF0000">*</font>  </td>
<td width="454"><input type="text" class="campo" align="left" name="titulo" size="70" /> </td>
<td width="136" align="left" >Noticia # 
<? echo " <font color='red' size='+2'> ".$num."</font>"; @mysql_close; ?></td>
</tr>
<tr>
<td align="right">Imagen <font color="#FF0000">*</font> </td><td colspan="2"><input type="file" class="campo" align="left" name="archivo" size="30" /> &nbsp; *Imagen ideal 200x200 pixeles </td>
</tr>
<tr>
<td align="right">
Categor&iacute;a
</td>
<td align="left" id="sel" colspan="2"><select name="id"  onchange="return No_enter(this, event)" style="text-align:center" class="campo">
                <option value="0"> -- Selecciona Categor&iacute;a --</option>
				<? include('rss-in.php');
				while ($jala = @mysql_fetch_array($query)) { $con=$jala["concepto"]; ?> <OPTION value="<? echo strtoupper($con); ?>"><? echo strtoupper(trim($con)); ?></option> <? }?> 
                </select> &nbsp; <input type="button" value="Crear categor&iacute;a &raquo;" onclick="javascript:window.open('rss-c.php','rss-c','left=300,top=300,menubar=no,width=500,height=100,toolbar=no,status=no,directories=no,titlebar=no')" />
</td>
</tr>
<tr>
<td></td><td colspan="2">
<input type="button" id="boton" name="Submit1" value="Negrita" onClick="instag('b')">
<input type="button" id="boton" name="Submit2" value="Subrayada" onClick="instag('u')">
<input type="button" id="boton" name="Submit3" value="Cursiva" onClick="instag('i')">
<input type="button" id="boton" name="Submit4" value="LINK" onClick="inslink()">
<input type="button" id="boton" name="Submit5" value="Parrafo" onClick="instag('p')">
<input type="button" id="boton" name="Submit6" value="Centrar" onClick="instag('center')">
<input type="button" id="boton" name="Submit7" value="H1" onClick="instag('h1')">
<input type="button" id="boton" name="Submit8" value="H2" onClick="instag('h2')">
<input type="button" id="boton" name="Submit9" value="Carrusel" onClick="insfot()">
<br>
<textarea id="conte" class="campo" name="texto" cols="80" rows="10"></textarea></td>
</tr>
<tr>
<td></td><td colspan="2"><input type="submit" name="enviar" value="Enviar &raquo;" /> </td>
</tr>
</table>
</form>
</div>
</body>
</html>
<? } ?>
