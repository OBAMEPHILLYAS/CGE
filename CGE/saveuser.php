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
	if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['role']) && ($nomphoto=="")){
		$ps= $pdo->prepare("INSERT INTO user(login, password, role, photo) VALUES (?,?,?,?)");
	$params=array($login, $password, $role, $nomphoto);
	$ps->execute($params);
	header("location:utilisateurs.php");
	}
	else{
		$file_extension=strrchr($nomphoto, ".");
		$file_tmp_name=$_FILES['photo']['tmp_name'];
		$file_dest= '/photo'.$nomphoto;
		$extensions_autorisees=array('.jpeg', '.png', '.jpg');

		if (in_array($file_extension, $extensions_autorisees)){

			if (move_uploaded_file($file_tmp_name, './photo/'.$nomphoto )){

				$ps=$pdo->prepare("INSERT INTO user(login, password, role, photo) VALUES (?,?,?,?)");
				$params=array($login, $password, $role, $nomphoto);
				$ps->execute($params);
				echo "Ajouté avec succès";
				header("location:utilisateurs.php");
			}else {echo"une erreur est survenue lors du téléchargement du fichier";
				header("location:newuser.php");
		}
		}else{
			echo  "Vérifier extension du fichier";
			header("location:newuser.php");
		}
		
	}


	
?>