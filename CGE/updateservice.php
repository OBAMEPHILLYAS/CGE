<?php
	require_once("security.php");
	require_once("roleadmin.php");
?>
<?php
	$libelle = $_POST['libelle'];
	$annee = date("Y");
	require_once("connexion.php");
	
	if (!empty($_POST['libelle'])){
		$ps=$pdo->prepare("UPDATE election SET libelle_election=?");
	$params=array($libelle);
	$ps->execute($params);
	echo "Modifier avec succès";
	header("location:election.php");
	}
	else{
		echo "Erreur survenue lors de la mise à jour";	
	}
	
	
?>