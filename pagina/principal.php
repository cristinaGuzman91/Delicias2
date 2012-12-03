<?php

//Inicializar una sesion de PHP
session_start();

//Validar que el usuario este logueado y exista un UID
if ( ! ($_SESSION['autenticado'] == 'SI' && isset($_SESSION['uid'])) )
{
    //En caso de que el usuario no este autenticado, crear un formulario y redireccionar a la
    //pantalla de login, enviando un codigo de error
?>
        <form name="formulario" method="post" action="login.php">
           <input type="hidden" name="msg_error" value="2"> 
        </form>
        <script type="text/javascript">
            document.formulario.submit();
        </script>
<?php
}

    //Conectar BD
    include("conecta.php");
    conecta();
    //Sacar datos del usuario que ha iniciado sesion
    $sql = "SELECT nombre FROM usuario WHERE id = '".$_SESSION['uid']."'";
    $result =mysql_query($sql);

    $nombreUsuario = "";

    //Formar el nombre completo del usuario
    if( $fila = mysql_fetch_array($result) )
        $nombreUsuario = $fila['nombre'];

//Cerrrar conexion a la BD
mysql_close($conexio);
?>
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>
 <title>.:: Panel de Control Administrador ::.</title>
 <body>
    <meta http-equiv="refresh" content="0;URL=../admin.html"> 
</body>  
</html>
