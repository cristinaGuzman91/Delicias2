<?php	include('conecta.php');	$liga=conecta();		if(!$liga)	{		die("No se pudo conectar al servidor :p");	}	mysql_select_db("delicias",$liga);		$Nombre = $_POST['Nombre'];	$Telefono  = $_POST['Telefono'];	$Correo = $_POST['Correo'];	$Direccion = $_POST['Direccion'];	$Modelo = $_POST['Modelo'];	$Cantidad = $_POST['Cantidad'];	$Entrega = $_POST['Entrega'];	$Fecha = $_POST['Fecha'];	$Informacion = $_POST['Informacion'];	}			$sql="insert into Servicios values (' ".$Nombre." ',' ".$Telefono." ',' ".$Correo." ',' ".$Direccion." ',' ".$Modelo." ',' ".$Cantidad." ',' ".$Entrega." ' ,' ".$Fecha." ' ,' ".$Informacion." ');";	echo $sql;	mysql_query($sql, $liga);//se ejecuta la consulta :D				?>