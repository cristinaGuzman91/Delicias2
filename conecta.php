<?php
	function conecta()
	{
		$link = mysql_connect('localhost','Karen','');
				if($link){
					echo "Conectado";
				}
		return $link;
	}

?>