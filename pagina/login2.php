<?php
	// Configura los datos de tu cuenta
	$dbhost='localhost';
	$dbusername='admin';
	$dbuserpass='admin';
	$dbname='proyecto';
	
	session_start();
	
	// Conectar a la base de datos
	mysql_connect ($dbhost, $dbusername, $dbuserpass);
	mysql_select_db($dbname) or die('No se puede conectar a la base de datos');
	
	if ($_POST['usuario']) {
	//Comprobacion del envio del nombre de usuario y password
	$username=$_POST['usuario'];
	$password=$_POST['clave'];
	$password2 = md5(crypt($password,"delicias"));
		if ($password==NULL) {
		echo "La la contraseña no fue enviada";
		}else{
			$query = mysql_query("SELECT usuario,clave FROM usuarios WHERE usuario = '$username'") or die(mysql_error());
			$data = mysql_fetch_array($query);
			if($data['clave'] != $password2) {
			echo "Login incorrecto";
			}else{
			$query = mysql_query("SELECT usuario,clave FROM usuarios WHERE usuario = '$username'") or die(mysql_error());
			$row = mysql_fetch_array($query);
			$_SESSION["s_usuario"] = $row['usuario'];
			header("Location: ../admin.html");
			}
		}
	}
?>
