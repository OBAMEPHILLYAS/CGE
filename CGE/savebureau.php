<?php
	$nom_bureau=$_POST['nom_bureau'];
	$responsable_bureau = $_POST['responsable_bureau'];
	$id_centre = $_POST['id_centre'];

	require_once("connexion.php");

	if (!empty($_POST['nom_bureau']) && !empty($_POST['responsable_bureau']) && !empty($_POST['id_centre']) ){
		$ps= $pdo->prepare("INSERT INTO bureau (nom_bureau, responsable_bureau, id_centre) VALUES (?,?,?)");
	$params=array($nom_bureau, $responsable_bureau, $id_centre);
	$ps->execute($params);
	header("location:bureau.php");
	}
	else{

			echo  "Vérifier extension du fichier";
			header("location:formnaddbureau.php");
		}

?>