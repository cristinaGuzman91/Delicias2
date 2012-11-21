<? 
 include('conecta.php');

/*if (isset($_SESSION['s_username'])) { */

if (!isset($_POST['send'])) {

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registro de usuarios</title>
<style type="text/css"> 
<!-- 
body  {
	font: 100% Verdana, Arial, Helvetica, sans-serif;
	background: #FFFFFF;
	margin: 0; /* it's good practice to zero the margin and padding of the body element to account for differing browser defaults */
	padding: 0;
	text-align: center; /* this centers the container in IE 5* browsers. The text is then set to the left aligned default in the #container selector */
	color: #000000;
}

/* Tips for Elastic layouts */
.twoColElsLtHdr #container { 
	width: 46em;  /* this width will create a container that will fit in an 800px browser window if text is left at browser default font sizes */
	background: #FFFFFF;
	margin: 0 auto; /* the auto margins (in conjunction with a width) center the page */
	border: 1px solid #000000;
	text-align: left; /* this overrides the text-align: center on the body element. */
} 


.twoColElsLtHdr #header { 
	background: #DDDDDD; 
	padding: 0 10px;  /* this padding matches the left alignment of the elements in the divs that appear beneath it. If an image is used in the #header instead of text, you may want to remove the padding. */
} 
.twoColElsLtHdr #header h1 {
	margin: 0; /* zeroing the margin of the last element in the #header div will avoid margin collapse - an unexplainable space between divs. If the div has a border around it, this is not necessary as that also avoids the margin collapse */
	padding: 10px 0; /* using padding instead of margin will allow you to keep the element away from the edges of the div */
}

/* Tips for sidebar1:*/
.twoColElsLtHdr #sidebar1 {
	float: left; 
	width: 12em; /* since this element is floated, a width must be given */
	background: #EBEBEB; /* the background color will be displayed for the length of the content in the column, but no further */
	padding: 15px 0; /* top and bottom padding create visual space within this div */
}
.twoColElsLtHdr #sidebar1 h3, .twoColElsLtHdr #sidebar1 p {
	margin-left: 10px; /* the left and right margin should be given to every element that will be placed in the side columns */
	margin-right: 10px;
}

/* Tips for mainContent:*/
.twoColElsLtHdr #mainContent {
	margin: 0 1em 0 1em; /* the right margin can be given in ems or pixels. It creates the space down the right side of the page. */
} 
.twoColElsLtHdr #footer { 
	padding: 0 10px; /* this padding matches the left alignment of the elements in the divs that appear above it. */
	background:#DDDDDD;
} 
.twoColElsLtHdr #footer p {
	margin: 0; /* zeroing the margins of the first element in the footer will avoid the possibility of margin collapse - a space between divs */
	padding: 10px 0; /* padding on this element will create space, just as the the margin would have, without the margin collapse issue */
}

/* Miscellaneous classes for reuse */
.fltrt { /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
	float: right;
	margin-left: 8px;
}
.fltlft { /* this class can be used to float an element left in your page */
	float: left;
	margin-right: 8px;
}
.clearfloat { /* this class should be placed on a div or break element and should be the final element before the close of a container that should fully contain a float */
	clear:both;
    height:0;
    font-size: 1px;
    line-height: 0px;
}
#apDiv1 {
	position:absolute;
	left:210px;
	top:36px;
	width:360px;
	height:49px;
	z-index:1;
}
#apDiv2 {
	position:absolute;
	left:750px;
	top:19px;
	width:244px;
	height:96px;
	z-index:2;
}
#apDiv3 {
	position:absolute;
	left:614px;
	top:170px;
	width:147px;
	height:20px;
	z-index:3;
}
#apDiv4 {
	position:absolute;
	left:613px;
	top:29px;
	width:179px;
	height:23px;
	z-index:3;
}
--> 
</style>
<!--[if IE]>
<style type="text/css"> 
/* place css fixes for all versions of IE in this conditional comment */
.twoColElsLtHdr #sidebar1 { padding-top: 30px; }
.twoColElsLtHdr #mainContent { zoom: 1; padding-top: 15px; }
/* the above proprietary zoom property gives IE the hasLayout it needs to avoid several bugs */
</style>
<![endif]-->

<style type="text/css">
<!--
#apDiv5 {
	position:absolute;
	left:686px;
	top:128px;
	width:146px;
	height:69px;
	z-index:4;
}
#apDiv6 {
	position:absolute;
	left:730px;
	top:337px;
	width:94px;
	height:53px;
	z-index:4;
}
#apDiv7 {
	position:absolute;
	left:743px;
	top:410px;
	width:80px;
	height:51px;
	z-index:4;
}
#apDiv8 {
	position:absolute;
	left:384px;
	top:151px;
	width:508px;
	height:210px;
	z-index:4;
}
#apDiv9 {
	position:absolute;
	left:545px;
	top:476px;
	width:270px;
	height:37px;
	z-index:5;
}

#campo input {
background:#E8E8E8;
border: 3px double #CCCCCC;
font-size:14px;
height:26px;
}

#campor input {
background:#1c3a6e;
border: 3px double #CCCCCC;
font-size:14px;
height:26px;
color:#FFFFFF;
}

#nulo input {
background:#E8E8E8;
border: 3px double #CCCCCC;
font-size:14px;
color:#666666;
height:26px;
}

#reg input.env {
display:block;
width:94px;
height:24px;
background:url(/images/bt_register.png) no-repeat;
border:none;
cursor:pointer;
float:none;
color:#FFFFFF;
}

#sel select {
background:#1c3a6e;
border: 3px double #CCCCCC;
font-size:14px;
color:#FFFFFF;
height:auto;
}

#text textarea {
background:#E8E8E8;
border: 3px double #CCCCCC;
font-size:14px;
color:#000000;
height:auto;
font-family:Calibri;
}

#text textarea:focus {
background:#FFFFFF;
color:#000000;
font-family:Calibri;
}

#campo input:focus {
background:#FFFFFF;
}

#campor input:focus {
background:#FFFFFF;
color:#000000;
}
-->
</style>
</head>
<script type="text/javascript">
function No_enter (field, event) {
var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
if (keyCode == 13) {
var i;
for (i = 0; i < field.form.elements.length; i++)
if (field == field.form.elements[i])
break;
i = (i + 1) % field.form.elements.length;
field.form.elements[i].focus();
return false;
}
else
return true;
}

function entername()
{
document.reg.login.value="Anonimo";
}
</script>
<body class="twoColElsLtHdr" onLoad="document.reg.elements[0].focus()" >
<font face="Verdana" size="+1"> <sub><strong>Registro!</strong></sub> </font>
<form name="reg" style="text-align:center" action="config.php" method="POST">
    <table border="0" cellpadding="5" cellspacing="0" align="center"> 
    <tr>
      <td align="center"><sub>Favor de llenar todos los campos requeridos. (<font color="red">*</font>)</sub></td>
    </tr>
    <tr>
    <td align="center">
    <table border="0" cellpadding="5" cellspacing="0">
    <tr>
    <td align="right">Usuario<font color="red">*</font></td>
    <td align="left" id="campor"><input type="text" name="usuario" id="campo" onKeyPress="return No_enter(this, event)" maxlength="90" size="30" /></td>
    </tr>     
    <tr>
    <td align="right">Clave<font color="red">*</font></td>
   <td align="left" id="campor"><input type="password" name="clave" id="campo" onKeyPress="return No_enter(this, event)" maxlength="90" size="30" /></td>
    </tr>
    <tr>
    <td align="right">Clave <font color="red">*</font><br>
      <font size="1px">[CONFIRMAR]</font></td>
    <td align="left" id="campor"><input type="password" name="clave2" onKeyPress="return No_enter(this, event)" maxlength="90" size="30" /></td>
    </tr>    
    <tr>    
    <td align="right">Nombre<font color="red">*</font></td>
    <td align="left" id="campor"><input type="text" name="nombre" onKeyPress="return No_enter(this, event)" maxlength="60" size="60" /></td>
    </tr>
    <tr>    
    <td align="right">Correo<font color="red">*</font></td>
    <td align="left" id="campor"><input type="text" name="email" onKeyPress="return No_enter(this, event)" maxlength="40" size="40" /></td>
    </tr>
    <tr>
    <td align="right">Perfil <font color="red">*</font><br>
      <font size="1px">[SISTEMA]</font>></td>
    <td align="left" id="sel">
	<select class="field" name="ins" id="campo">
    <option class="field" value="0">Selecciona... </option>
    <option value="administrador">ADMINISTRADOR</option>
    </select>
	</td>
    </tr>
	
    <tr>
    <td align="right">Fotografia<font color="red">*</font></td>
    <td align="left" id="sel"><input type="file"name="foto" size="30" /> </td>
    </tr>
		
    <tr>
	<td align="right" >Comentarios <br><font size="1px">[Algo que debamos saber..]</font></td>
    <td align="left" id="text">
    <textarea cols="40" rows="5" name="comentario"  ></textarea>
    </td>
    </tr>
    </table>
    </td>
    </tr>
    <tr>
    <td align="center" id="reg">
      <input type="submit" name="send" id="submit"  value="Registrame! &raquo;" tabindex="10" />
      </tr>
      </tr>
      </table>
</form>
<a href="login.html">Iniciar sesion</a>
</body>
</html>

<?
}
else {

$username = $_POST["usuario"];
$password = $_POST["clave"];
$cpassword = $_POST["clave2"];
$nom = $_POST["nombre"];
$email = $_POST["email"];
$pef = $_POST["ins"];
$car = $_POST["foto"];

// Hay campos en blanco
if(empty($username)) {
echo "<script>alert('Algunos de los campos estan vacios:  Usuario: ".$username." | Contrasena: ".$password." | Re-contrasena: ".$cpassword." | Institucion: ".$pef." | Cargo: ".$car."');</script>"; exit();
header("Location: config.php");
}else{
// ¿Coinciden las contraseñas?
if($password!=$cpassword) {
echo "<script>alert('Las contraseñas no coinciden, verifica que estan escritas correctamente.');</script>"; exit();
header("Location:logeado.php");
}else{
// Comprobamos si el nombre de usuario o la cuenta de correo ya existían
$checkuser = @mysql_query("SELECT usuarios FROM usuarios WHERE usuario='$username'");
$username_exist = @mysql_num_rows($checkuser);

if ($username_exist>0) {
echo "<script>alert('El usuario ya existe en nuestra base de datos');</script>"; exit();
header("Location: config.php");
}else{

$password=md5(crypt($cpassword,"delicias")); 

/* obtener datos del host y navegador del usuario */
$ip = getenv('REMOTE_HOST');
if(!$ip) { $ip = getenv('HTTP_X_FORWARDED_FOR'); }
if(!$ip) { $ip = $HTTP_X_FORWARDED_FOR; }
if(!$ip) { $ip = getenv('REMOTE_ADDR'); }
if(!$ip) { $ip = $REMOTE_ADDR; }
$ip = @GetHostByAddr($ip);

/* fecha y hora del dia */
$fecha = date("d M Y [h:i A]");

$query = "INSERT INTO usuarios (usuario, clave, nombre, correo, perfil, foto, f_acceso, ip ) VALUES('$username','$password','$nom','$email','$pef','$car','$fecha','$ip')";
@mysql_query($query) or die(@mysql_error());
echo "<script>alert('Se ha creado correctamente');</script>"; exit();
echo ("<script>location.href='config.php';</script>");
}
}
}


} // este es del else que nos envia aqui si ya  se ha dado clic en, Registrarme!
?>