<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>.:: Iniciar Sesi&oacute;n ::.</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="estilos.css" type="text/css">
    <script src="jquery171.js" type="text/javascript"></script>
    <script src="jquery.validate.js" type="text/javascript"></script>
    <script type="text/javascript" src="jquery.alerts.js"></script>
    <link href="jquery.alerts.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript">
    <!--
        $().ready(function() {
            $("#frmlogin").validate();
            $("#usuario").focus();
        });
    // -->
    </script>
</head>
<body>
<br /><br />
<form id="frmlogin" name="frmlogin"  method="POST" action="validarUsuario.php">
<table align="center" width="200px">
<tr>
    <td colspan="3" align="center"><font face="arial" size="10">Iniciar sesi&oacute;n</font></td>
</tr>
<tr>
    <td rowspan="5"><img src="../Imagenes/imagenesDelicias/logo2.jpg" width="230" height="170"></td>
    <td></td>
    <td align="center"><font face="arial" size="4">Usuario: </font><br/>
        <input type="text" name="usuario" id="user"  onkeyup = "this.value = this.value.toLowerCase()" onKeyPress="return No_enter(this, event)" maxlength="90" size="30" /></td>
</tr>

<tr>
    <td></td>
    <td align="center"><font face="arial" size="4">Contrase&ntilde;a: </font><br/>
        <input type="password" name="password" id="password" onKeyPress="return No_enter(this, event)" maxlength="90" size="30" /></td>
</tr>
<tr >
    <td></td>
    <td colspan="2" ><a href="recuperarPassword.php"> <font face="arial">Olvide mi contrase&ntilde;a</font> </a></td>
</tr>

<tr>
    <td></td>
    <td colspan="2" align="right"><input type="submit" name="enviar" value="Enviar"></td>
</tr>

<tr>
    <td colspan="3" align="right" ><br/>
        <a href="../pagina/config.php"><font face="arial">Reg&iacute;strate aqu&iacute;</font></a></td>
</tr>
    <?php
    //Mostrar errores de validacion de usuario, en caso de que lleguen

        if( isset( $_POST['msg_error'] ) )
        {
            switch( $_POST['msg_error'] )
            {
                case 1:
            ?>
            <script type="text/javascript">
                jAlert("El usuario o password son incorrectos.", "Seguridad");
                $("#password").focus();
            </script>
            <?php
                break;
                case 2:
            ?>
            <script type="text/javascript">
                jAlert("La seccion a la que intentaste entrar esta restringida.\n Solo permitida para usuarios registrados.", "Seguridad");
            </script>
            <?php
                break;
            }       //Fin switch
        }

        //Mostrar mensajes del estado del registro
        if( isset( $_POST['status_registro'] ) )
        {
            switch( $_POST['status_registro'] )
            {
                case 1:
                if( $_POST['i_EmailEnviado'] ==1) {
                ?>
                    <script type="text/javascript">
                        jAlert("Gracias, ha sido registrado exitosamente.\n Se le ha enviado un correo electronico de bienvenida, \npor favor, NO LO CONTESTE pues solo es informativo.", 'Registro');
                    </script>
                    <?php
                } else {
                    ?>
                    <script type="text/javascript">
                        jAlert("Gracias, ha sido registrado exitosamente.\n No se le ha podido enviar correo electronico de bienvenida, \nsin embargo, ya puede utilizar su datos de acceso para registrarse..", 'Registro');
                    </script>
                <?php
                }
                    break;
                default:
            ?>
                <script type="text/javascript">
                    jAlert("Temporalmente NO se ha podido registrar, intente de nuevo mas tarde.", "Registro");
                </script>
            <?php       
            }       //Fin switch
        }
    ?>

</table>
</form>
</body>
</html>
