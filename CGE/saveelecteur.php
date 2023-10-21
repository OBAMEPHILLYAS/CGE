 <?php
 	$cni_electeur=$_POST['cni_electeur'];
	$nom_electeur=$_POST['nom_electeur'];
	$prenom_electeur = $_POST['prenom_electeur'];
	$adresse_electeur = $_POST['adresse_electeur'];
	$date_electeur=$_POST['date_electeur'];
	$lieu_electeur=$_POST['lieu_electeur'];
	$id_bureau=$_POST['id_bureau'];
	$photo_electeur = isset($_FILES['photo_electeur']['name']) ? $_FILES['photo_electeur']['name'] : ""; 

	require_once("connexion.php");

	if (!empty ($_POST['cni_electeur']) && ($_POST['nom_electeur']) && !empty($_POST['prenom_electeur']) && !empty($_POST['adresse_electeur']) && !empty($_POST['date_electeur']) && !empty($_POST['lieu_electeur']) && !empty($_POST['id_bureau']) && !empty($_POST['photo_electeur'])){
		$ps= $pdo->prepare("INSERT INTO electeur (nom_electeur, prenom_electeur, adresse_electeur, date_electeur, lieu_electeur, cni_electeur, id_bureau, photo_electeur) VALUES (?,?,?,?,?,?,?,?)");
	$params=array($nom_electeur, $prenom_electeur, $adresse_electeur, $date_electeur, $lieu_electeur, $cni_electeur, $id_bureau, $photo_electeur);
	$ps->execute($params);
	header("location:electeur.php");
	}
	else{
		
		} 

?>