<?php
	require_once("security.php");
	require_once("roleadmin.php");
	
	$login=$_GET['login'];
	require_once("connexion.php");
	$ps=$pdo->prepare("DELETE FROM user WHERE login=?");
	$params=array($login);
	$ps->execute($params);
	header("location:utilisateurs.php");
?>
