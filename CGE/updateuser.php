<?php
	require_once("security.php");
	require_once("roleadmin.php");
?>
<?php
	$login = $_POST['login'];
	
	$password = $_POST['password'];
	$role = $_POST['role'];
	$nomphoto=$_FILES['photo']['name'];
	require_once("connexion.php");
	
	if ($nomphoto=="") {
		$ps=$pdo->prepare("UPDATE user SET login=?, password=?, role=? WHERE login=?");
	$params=array($login, $password, $role, $login);
	$ps->execute($params);
	echo "Modifier avec succès";
	}
	else{
		$file_extension=strrchr($nomphoto, ".");
		$file_tmp_name=$_FILES['photo']['tmp_name'];
		$file_dest= '/photo'.$nomphoto;
		$extensions_autorisees=array('.jpeg', '.png', '.jpg', '.PNG', '.JPEG', '.JPEG');

		if (in_array($file_extension, $extensions_autorisees)){

			if (move_uploaded_file($file_tmp_name, './photo/'.$nomphoto )){

				$ps = $pdo->prepare("UPDATE user SET login=?, password=?, role=?, photo=? WHERE login=?");
				$params=array($login, $password, $role, $nomphoto, $login);
				$ps->execute($params);
				echo "Modifier avec succès";
			}else {echo"une erreur est survenue lors du téléchargement du fichier";}
		}else{
			echo "Revoir extension du fichier";
		}
		
	}
	
	header("location:utilisateurs.php");
?>