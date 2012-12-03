<?php
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>.:: Recuperar Password ::. </title>

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" href="estilos.css" type="text/css">
    <script src="jquery171.js" type="text/javascript"></script>
    <script src="jquery.validate.js" type="text/javascript"></script>
    <script type="text/javascript" src="jquery.alerts.js"></script>
    <link href="jquery.alerts.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript">
    <!--
        $().ready(function() {
        $("#recPassword").validate({
        rules: {
        /*A continuacion los nombres de los campos y sus reglas a cumplir */
            correo2: {
            required: true,
            email: true,
            equalTo: "#correo"
            },
            correo: {
            required: true,
            email: true
            }

        }
        });
        $("#correo").focus();
        });
    // -->
    </script>
</head>
<body>
<br /><br/>

<form id="recPassword" name="recPassword"  method="POST" action="recuperarPassword.php">
<table align="center" width="400px">
<tr>
    <td colspan="2" align="center"><h3><b>Recuperar Password</b></h3></td>
</tr>

<?php
//Si llega el parametro correo y no viene vacio
if( isset( $_POST['correo'] ) && $_POST['correo'] != '' )
{
    //Conectar la BD
    include("conecta.php");
    conecta();

    //Recuperar la direccion de email que llega
    $elcorreo   = $_POST['correo'];

    //Verificar si existe el correo en la BD
    $sql = "SELECT  id,usuario,nombre FROM usuario WHERE correo = '".$elcorreo."'";
    $rs_sql = mysql_query($sql);

    //Si no existe el correo...
    if ( !( $fila   = mysql_fetch_object($rs_sql) )  )
    {
    //Mostrar msg de error al usuario (en esta misma pagina)
?>
    <input type="hidden" id="error" value="1">
    <script type="text/javascript">
    location.href="recuperarPassword.php?error="+document.getElementById('error').value;
    </script>
<?php
    }

    //En caso de que si exista un email como el k llega, leer de la BD los datos del usuario
    $idusr  = $fila->id;     //Servira para actualizar el pw
    $nombre = $fila->nombre;
    $nick   = $fila->usuario;

    // Generacion de un nuevo Password
    $pasw = "";
    $abecedario = array("A","B","C","D","E","F","G","H","J","K","L","M","N","O","P","Q","R","S","T",
"U","V","W","a","b","c","d","e","f","g","h","j","k","l","m","n","o","p","q","r","s","t","u","v","w");
    $simbolos   = array(",","}","{","-","|","!","#","$","%","&","/","(",")","=","?","¡",
"*","]","[","_",":",";","+");
    for($i=0;$i<3; $i++)
    {
        $md     = rand(1,2);
        $pasw   .=  (($md%2)==0) ? $abecedario[rand(0,43)] : rand(0,9);
        $md     = rand(1,2);
        $pasw   .=  (($md%2)==0) ? rand(0,9) :  $simbolos[rand(0,23)];
        $md     = rand(1,2);
        $pasw   .=  (($md%2)==0) ?   $simbolos[rand(0,23)] : $abecedario[rand(0,43)] ;
    }      

    // Le  Envio  por correo electronico  su nuevo password
     $seEnvio;          //Para determinar si se envio o no el correo
     $destinatario = $elcorreo;             //A quien se envia
     $nomAdmin          = 'Delicias';       //Quien envia
     $mailAdmin         = 'delicias_eldorado@hotmail.com';   //Mail de quien envia
     $urlAccessLogin = 'http://localhost/Delicias2/pagina'; //Url de la pantalla de login

     $elmensaje = "";
     $asunto = "Nueva contraseña para ".$nick;

     $cuerpomsg ='
        <h3>.::Recuperar Password::.</h3>
        <p>A peticion de usted; se le ha asignado un nuevo password, utilice los siguientes datos para acceder al panel de administracion</p>
          <table border="0" >
            <tr>
              <td colspan="2" align="center" ><br> Nuevos datos de acceso para <a href="'.$urlAccessLogin.'">'.$urlAccessLogin.'</a><br></td>
            </tr>
            <tr>
              <td> Nombre </td>
              <td> '.$nombre.' </td>
            </tr>
            <tr>
              <td> Usuario </td>
              <td> '.$nick.' </td>
            </tr>
            <tr>
              <td> Contraseña </td>
              <td> '.$pasw.' </td>
            </tr>
          </table> ';

    date_default_timezone_set('America/Mexico_City');

    //Establecer cabeceras para la funcion mail()
    //version MIME
    $cabeceras = "MIME-Version: 1.0\r\n";
    //Tipo de info
    $cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
    //direccion del remitente
    $cabeceras .= "From: ".$nomAdmin." <".$mailAdmin.">";
    $resEnvio = 0;
    //Si se envio el email
    if(mail($destinatario,$asunto,$cuerpomsg,$cabeceras))
    {
        //Actualizar el pwd en la BD
        $sql_updt = "UPDATE tbl_users SET tx_password = '".md5($pasw)."'
        WHERE (id_usuario = ".$idusr.")
        AND (tx_correo = '".$elcorreo."')";
        $res_updt = mysql_query($sql_updt);
        $resEnvio = 1;
    }

    //Cerrrar conexion a la BD
    mysql_close($conexio);

    // Mostrar resultado de envio (en esta misma pagina)
    ?>
        <input type="hidden" id="enviado" value="<?php echo $resEnvio ?>">
        <input type="hidden" id="elcorreo" value="<?php echo $elcorreo ?>">
        <script type="text/javascript">
            //location.href="recuperarPassword.php?enviado="+document.getElementById('enviado').value+"&elcorreo="+document.getElementById('elcorreo').value;
        </script>
    <?php
}
else
{
?>
<tr>
    <td colspan="2">Escriba su correo electr&oacute;nico con el que se ha registrado,
        se le enviar&aactue; una nueva contraseña a su correo electr&oacute;nico:<br /><br />
    </td>
</tr>
<tr>
    <td>Correo electr&oacute;nico:</td>
    <td><input type="text" name="correo" id="correo"  maxlength="50" /></td>
</tr>
<tr>
    <td>Confirme Correo electr&oacute;nico:</td>
    <td><input type="text" name="correo2" id="correo2" maxlength="50" /></td>
</tr>
<?php
    //Si llega un codigo de error
    if( isset($_GET['error']) && $_GET['error']==1 )
    {
        echo "<tr><td colspan='2'><br><font color='red'>El correo electr&oacute;nico no pertenece a ningun usuario registrado.</font><br></td></tr>";
    }
    else if( isset($_GET['enviado']) && isset($_GET['elcorreo'])  )
    {
        //Si se envio correctamente el nuevo password
        if( $_GET['enviado']==1 )
            echo "<tr><td colspan='2'><br><font color='green'>Su nueva contrase&ntilde;a ha sido enviada a <strong>".$_GET['elcorreo']."</strong>.</font><br></td></tr>";
        else if( $_GET['enviado']==0 )
            echo "<tr><td colspan='2'><br><font color='red'>Por el momento la nueva contrase&ntilde;a no pudo ser enviada a <strong>".$_GET['elcorreo']."</strong>.<br>
            Intente de nuevo mas tarde.</font></td></tr>";
    }
?>
<tr>
    <td align="center" colspan="2">
        <br /><br />
        <input type="button" onClick="javascript: location.href='login.php'" name="cancelar" value="Cancelar" >
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" name="enviar" value="Enviar" >
    </td>
</tr>
<?php
}
?>
</table>
</form>
</body>
</html>
