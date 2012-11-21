<?php
	// Configura la información de tu cuenta
	$dbhost='localhost';
	$dbusername='admin';
	$dbuserpass='admin';
	$dbname='proyecto';
	session_start();
	// Conexión a la base de datos
	mysql_connect ($dbhost, $dbusername, $dbuserpass);
	mysql_select_db($dbname) or die('No te puedes conectar a la base de datos');
?> 

<?php
	if (isset($_SESSION['s_usuario'])) {
	echo "Bienvenido a mi sitio has ingresado como ".$_SESSION['s_username'].", gracias por la visita!";
	}else{
	echo "Tu no estas autentificado dirígete a login.php o registrate en register.php";
	echo $_SESSION['s_username'];
	}
?>