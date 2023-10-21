<?php

	require_once("connexion.php");
	if (isset($_POST["formlogin"])){
	$login=$_POST["username"];
	$password=md5($_POST["password"]);
	$ps=$pdo->prepare("SELECT * FROM user WHERE login=? AND password=?");
	$params=array($login, $password);
	$ps->execute($params);

		if ($user=$ps->fetch()) {?>
			<div class="alert alert-success alert-admissible" role="alert">
				<button type="button" class="close" data-dimiss="alert" aria-label="close"></button>
				<strong>Succès!</strong> Authentification valide.
			</div>
		<?php
			header("location:election.php");
			session_start();
			$_SESSION['PROFILE']=$user; ?>
			
		<?php
		}
		else { ?>
			<div class="alert alert-danger alert-admissible" role="alert">
				<button type="button" class="close" data-dimiss="alert" aria-label="close"><span aria-hidden="true"></span></button>
				<strong>Erreur!</strong> Authentification invalide.
			</div>
		<?php
			
			header("location:login.php");?>
			
		<?php
		}
	}
?>