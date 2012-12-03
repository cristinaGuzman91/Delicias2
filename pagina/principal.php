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
<title>.:: Panel de Control Administrador ::.</title>  
<head>
	<link  rel="stylesheet" type="text/css" href="style.css">
</head>  
<body>  

<div id="Superior">  
	<ul><center>Panel de control del Administrador</center></ul>  
</div>  
  
<div id="Izquierda"> 
	<ul>
		<a href="principal.php">Inicio</a></br>
	</ul>
	<ul>
		<a href="" target="con2">Usuarios</a></br>
	</ul>
	<ul>
		<a href=""target="con2">Registros</a></br>
	</ul>
	<ul>
		<a href="../pagina/gen-noticia.php" target="con2">Noticias</a></br>
	</ul>
	<ul>
		<a href= "../productos.html" target="con2" >Productos</a></br>
	</ul>
	<ul>
		<a href=""target="con2">Historial</a></br>
	</ul>
	<ul>
		<a href="" target="con2con2">Ip</a></br>
	</ul>
	<ul>
		<a href=""target="">Informacion</a></br>
	</ul> 
	<ul>
		<a href="../index.html">Delicias</a></br>
	</ul> 
</div>

<iframe id="Centro" name="con2" > </iframe>  
  
<div id="Derecha">  
 	 <div id="pie"> 
  	<center><a href="cerrarSesion.php"><img src="../Imagenes/apagar.png"   	  	 WIDTH=40% HEIGHT=90%/></a></center>
</div> 
</div>  
</body>  
</html>
