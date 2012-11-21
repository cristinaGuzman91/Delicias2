<?php
	function conecta(){
		$link = mysql_connect('localhost', 'admin', 'admin');
			if($link){
				echo "";
			}
		return $link;
	}
	$liga=conecta();
	
	if(!$liga){
		die("No se pudo conectar al servidor :P");
	}
	mysql_select_db("proyecto",$liga);
?>