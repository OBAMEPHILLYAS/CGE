<?php
	require_once("security.php");
	require_once("roleadmin.php");


	$image=$_GET['image'];
	require_once("connexion.php");
	$ps=$pdo->prepare("SELECT * FROM document WHERE image=?");
	$params=array($image);
	$ps->execute($params);
	$document=$ps->fetch();


	if(!empty($_GET['image'])){

		$filename = basename($_GET['image']);
		$filepath = 'image/'.$filename;
		if(!empty($filename) && file_exists($filepath)){

			// Define Header
			header("cache-control: public");
			header("content-description: file transfert");
			header("content-disposition: attachment; filename=$filename");
			header("content-type: applicatioin/zip");
			header("content-transfert-emcoding: binary");
			readfile($filepath);
			exit();


		}
	}else{
		echo "this file does not exist";
	}
?>