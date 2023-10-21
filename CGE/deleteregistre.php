<?php
	require_once("security.php");
	require_once("roleadmin.php");
	
	$mot_cle_registre=$_GET['mot_clé_registre'];
	require_once("connexion.php");
	$ps=$pdo->prepare("DELETE FROM registre WHERE mot_clé_registre=?");
	$params=array($mot_cle_registre);
	$ps->execute($params);
	header("location:registre.php");
?>
