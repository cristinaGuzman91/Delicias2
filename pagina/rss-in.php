<?
$MySqlHostname = "localhost"; $MySqlUsername = "usuario"; $MySqlPassword = "clave"; $MySqlDatabase = "base_de_datos";
$dblink=MYSQL_CONNECT($MySqlHostname, $MySqlUsername, $MySqlPassword); @mysql_select_db("$MySqlDatabase");
$sql = "SELECT * FROM tablarss"; $query = @mysql_query($sql, $dblink);
?>