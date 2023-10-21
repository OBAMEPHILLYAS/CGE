<?php
	$nom_candidat=$_POST['nom_candidat'];
	$prenom_candidat = $_POST['prenom_candidat'];
	$parti_candidat = $_POST['parti_candidat'];
	$id_election=$_POST['id_election'];
	$photo_candidat = isset($_FILES['photo_candidat']['name']) ? $_FILES['photo_candidat']['name'] : ""; 

	require_once("connexion.php");

	if (!empty($_POST['nom_candidat']) && !empty($_POST['prenom_candidat']) && !empty($_POST['parti_candidat']) && !empty($_POST['id_election']) && !empty($_POST['photo_candidat'])){
		$ps= $pdo->prepare("INSERT INTO candidat (nom_candidat, prenom_candidat, parti_candidat, id_election, photo_candidat) VALUES (?,?,?,?,?)");
	$params=array($nom_candidat, $prenom_candidat, $parti_candidat, $id_election, $photo_candidat);
	$ps->execute($params);
	header("location:candidat.php");
	}
	else{
		$file_extension=strrchr($photo_candidat, ".");
		$file_tmp_name=$_FILES['photo_candidat']['tmp_name'];
		$file_dest= '/photo'.$photo_candidat;
		$extensions_autorisees=array('.jpeg', '.png', '.jpg');

		if (in_array($file_extension, $extensions_autorisees)){

			if (move_uploaded_file($file_tmp_name, './photo/'.$photo_candidat )){

				$ps= $pdo->prepare("INSERT INTO candidat (nom_candidat, prenom_candidat, parti_candidat, id_election, photo_candidat) VALUES (?,?,?,?,?)");
				$params=array($nom_candidat, $prenom_candidat, $parti_candidat, $id_election, $photo_candidat);
				$ps->execute($params);
				echo "Ajouté avec succès";
				header("location:candidat.php");
			}else {echo"une erreur est survenue lors du téléchargement du fichier";
				header("location:formaddcandidat.php");
		}
		}else{
			echo  "Vérifier extension du fichier";
			header("location:formaddcandidat.php");
		}
		
	} 

?>