<?php
	require_once("security.php");
	require_once("roleadmin.php");
	
	$numéro_document=$_GET['numéro_document'];
	require_once("connexion.php");
	$ps=$pdo->prepare("DELETE FROM document WHERE numéro_document=?");
	$params=array($numéro_document);
	$ps->execute($params);
	header("location:document.php");
?>
