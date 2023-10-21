<?php
// Récupération de l'ID du candidat à partir des données POST
$numero = isset($_POST['id_bureau']) ? $_POST['id_bureau'] : null;

	$nom_bureau=$_POST['nom_bureau'];
	$responsable_bureau = $_POST['responsable_bureau'];
	$id_centre = $_POST['id_centre'];

	require_once("connexion.php");

	if (!empty($_POST['nom_bureau']) && !empty($_POST['responsable_bureau']) && !empty($_POST['id_centre']) ){
		$ps= $pdo->prepare("UPDATE bureau SET nom_bureau = ?, responsable_bureau = ?, id_centre = ? WHERE id_bureau =?");
	$params=array($nom_bureau, $responsable_bureau, $id_centre, $numero);
	$ps->execute($params);
	header("location:bureau.php");
	}
	else{

			echo  "Vérifier extension du fichier";
			header("location:bureau.php");
		}

?>