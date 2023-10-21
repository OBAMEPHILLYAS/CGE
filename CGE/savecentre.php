<?php
	$nom_centre = $_POST['nom_centre'];
	$adresse_centre=$_POST['adresse_centre'];
	$province_centre = $_POST['province_centre'];
	$responsable_centre=$_POST['responsable_centre'];
	$id_election = $_POST['id_election'];

	require_once("connexion.php");
	if (!empty($_POST['nom_centre']) && !empty($_POST['adresse_centre'])  && !empty($_POST['province_centre']) && !empty($_POST['responsable_centre']) && !empty($_POST['id_election'])) {
			$ps= $pdo->prepare("INSERT INTO centre(nom_centre, adresse_centre, province_centre, responsable_centre, id_election) VALUES (?,?,?,?,?)");
			$params=array($nom_centre, $adresse_centre, $province_centre, $responsable_centre, $id_election);
			$ps->execute($params);
			header("location:centre.php");
	}
	else {
		echo "remplir tous les champs";
		header("location:formaddcentre.php");
	}
?>