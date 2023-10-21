<?php
	require_once("security.php");
?>
<?php
/*
	mysql_connect ( "localhost", "root", "") or die (mysql_error());
	mysql_select_db (ged)  or die (mysql_error());
*/
	try {
		$strConnection = "mysql: host=localhost; dbname=ged; charset=utf8";
		$pdo= new pdo ($strConnection, "root", "");}
	catch  (pdoException $e) {
		$msg= "ERREUR DANS PDO".$e->getmessage();
		die ($msg);
	}
?>