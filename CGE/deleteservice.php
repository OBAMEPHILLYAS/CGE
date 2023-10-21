<?php
	require_once("security.php");
	require_once("roleadmin.php");
	
	$mot_cle=$_GET['mot_cle'];
	require_once("connexion.php");
	$ps=$pdo->prepare("DELETE FROM service WHERE mot_cle_service=?");
	$params=array($mot_cle);
	$ps->execute($params);
	header("location:service.php");
?>
