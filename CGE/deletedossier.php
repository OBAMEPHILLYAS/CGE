<?php
	require_once("security.php");
	require_once("roleadmin.php");
	
	$mot_cle_dossier=$_GET['mot_clé_dossier'];
	require_once("connexion.php");
	$ps=$pdo->prepare("DELETE FROM dossier WHERE mot_clé_dossier=?");
	$params=array($mot_cle_dossier);
	$ps->execute($params);
	header("location:dossier.php");
?>
