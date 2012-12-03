<?php

$conexio;
function conecta()
{
    global $conexio;
    //Definir datos de conexion con el servidor MySQL
    $elUsr = "admin";
    $elPw  = "itesm";
    $elServer ="localhost";
    $laBd = "proyecto";

    //Conectar
    $conexio = mysql_connect($elServer, $elUsr , $elPw) or die (mysql_error());

    //Seleccionar la BD a utilizar
    mysql_select_db($laBd, $conexio ) or die (mysql_error());
}
?>
