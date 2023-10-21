<?php 
	require_once("connexion.php");


	if(isset($_POST['mot_cle_service'])){


	try{
		$req2=$pdo->prepare("SELECT nom_registre FROM registre WHERE mot_cle_service=".$_POST['mot_cle_service']);
		$req2->execute();
		$registre = $req2->fetchAll();
		echo json_encode($registre);

	}
	catch (exception $ex){
		echo ($ex->getmessage());
	}

	}
	function loadservice (){
		$req1="SELECT mot_cle_service FROM service";
	try{
		$req1=$pdo->prepare ("SELECT mot_cle_service FROM service");
		$req1->execute();
		$service=$req1->fetchAll();
		return $service;

	}
	catch (exception $ex){
		echo ($ex->getmessage());
	}
}



?>