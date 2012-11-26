<? 
 include('conecta.php');

/*if (isset($_SESSION['s_username'])) { */

if (!isset($_POST['send'])) {

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registro de usuarios</title>
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
    <td align="left" id="campor"><input type="text" name="usuario" id="campo" onekeyup="this.value=this.value.toLowerCase()" onKeyPress="return No_enter(this, event)" maxlength="90" size="30" /></td>
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
    <option value="analista">ANALISTA</option>
    <option value="capturista">CAPTURISTA</option>
    <option value="operador">OPERADOR</option>
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
<center><a href="login.html"><img src="../Imagenes/imagenesDelicias/iniciar.png" width="100" heigth="30" onmouseover="this.src='../Imagenes/imagenesDelicias/iniciar1.png';" onmouseout="this.src='../Imagenes/imagenesDelicias/iniciar.png';"></a></center>
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
