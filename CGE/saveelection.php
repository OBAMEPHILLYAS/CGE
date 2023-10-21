<?php
	$libelle = $_POST['libelle'];
	$annee = date("Y");
	require_once("connexion.php");
		if (!empty($_POST['libelle']) ) {
				$doublon= $pdo->prepare("SELECT COUNT(annee) FROM election");
				if($doublon <> 0){
					header("location:formelection.php");
			}else{
				$ps= $pdo->prepare("INSERT INTO election (libelle_election, annee) VALUES (?,?)");
				$params=array($libelle, $annee);
				$ps->execute($params);
				header("location:election.php");
				
			}
				
		}else{ 
			echo "remplir le champ";
		header("location:formelection.php");
		}
	
?>

